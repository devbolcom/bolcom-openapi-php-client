<?php

namespace BolCom;

class Request
{
    private $apiAccessKeyId;
    private $apiFormat;
    private $apiDebugMode;
    private $sessionId;
    private $httpResponseCode;
    private $httpFullHeader;

    public function __construct($accessKeyId, $responseFormat, $debugMode)
    {
        try {
            $this->apiAccessKeyId = $accessKeyId;
            $this->apiFormat = $responseFormat;
            $this->apiDebugMode = $debugMode;
        } catch (Exception $e) {
            echo "Exception: " . $e->getMessage() . "\n";
        }
    }

    public function fetch($httpMethod, $url, $parameters = '', $content = '')
    {

        $parameters .= ($parameters == '' ? '?' : '&');
        $parameters .= 'format=' . $this->apiFormat;
        $parameters .= '&apikey=' . $this->apiAccessKeyId;

        $today = gmdate('D, d F Y H:i:s \G\M\T');

        switch ($httpMethod) {
            default:
            case 'GET':
                $contentType = ($this->apiFormat == 'xml' ? 'application/xml' : 'application/json');
                break;
            case 'POST':
            case 'PUT':
            case 'DELETE':
                $contentType = 'application/x-www-form-urlencoded';
                break;
        }

        $headers = $httpMethod . " " . $url . $parameters . " HTTP/1.0\r\n";
        $headers .= "Content-type: " . $contentType . "\r\n";
        $headers .= "Host: api.bol.com\r\n";
        $headers .= "Content-length: " . strlen($content) . "\r\n";
        $headers .= "Connection: close\r\n";
        if (!is_null($this->sessionId)) {
            $headers .= "X-OpenAPI-Session-ID: " . $this->sessionId . "\r\n";
        }
        $headers .= "\r\n";

        $socket = @fsockopen('ssl://api.bol.com', '443', $errno, $errstr, 30);
        if (!$socket) {
            throw new \Exception("{$errstr} ({$errno})");
        }

        $opts = array(
            'ssl' => array(
                'verify_peer' => TRUE,        // Override default FALSE for PHP < 5.6.0
                'verify_peer_name' => TRUE,    // Override default FALSE for PHP < 5.6.0
                'allow_self_signed' => FALSE,    // Disallow self signed certificates
                'SNI_enabled' => TRUE,        // Allow for the API server to use SNI
            ),
        );
        stream_context_set_option($socket, $opts);

        fputs($socket, $headers);
        fputs($socket, $content);

        $result = '';

        while (!feof($socket)) {
            $result .= fgets($socket);
        }
        fclose($socket);

        $this->httpResponseCode = intval(substr($result, 9, 3));

        list($header, $body) = explode("\r\n\r\n", $result, 2);

        $this->httpFullHeader = $header;

        $json_request = (json_decode($body) != NULL) ? true : false;

        if (!$json_request) {
            if (strpos($body, "<?xml") === false) $body_return = $body; else $body_return = new \SimpleXMLElement($body);
        } else {
            $body_return = json_decode($body);
        }

        if ($this->apiDebugMode) {
            echo '<pre>Debug info<br><br>----<br><br><strong>http request:</strong><br>https://api.bol.com' . $url . $parameters . '<br><br>';
            echo '<strong>header request:</strong><br>' . print_r($headers, 1) . '<br>';
            if ($content) echo '<strong>content:</strong><br>' . htmlspecialchars($content) . '<br><br>';
            echo '<strong>header response:</strong><br>' . self::getFullHeader();
            echo '----</pre>';
        }

        return $body_return;
    }

    public function getHttpResponseCode()
    {
        return $this->httpResponseCode;
    }

    public function getFullHeader()
    {
        return $this->httpFullHeader;
    }

    public function getSessionId()
    {
        return $this->sessionId;
    }

    public function setSessionId($sessionId)
    {
        $this->sessionId = '' . $sessionId;
    }

}
