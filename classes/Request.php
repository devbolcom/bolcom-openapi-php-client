<?php

class Request {
	const SERVER = 'openapi.bol.com';
	private $accessKey;
	const PORT = '443';
	private $secretAccessKey;
	private $sessionId;
	private $httpResponseCode;
	
	public function __construct($accessKeyId, $secretAccessKey) {
		try {
			$this->accessKey = $accessKeyId;
			$this->secretAccessKey = $secretAccessKey;
		} catch(Exception $e) {
			echo "Exception: " . $e->getMessage() . "\n";
		}
	}

	private function getSignature($date, $httpMethod, $url, $contentType, $queryParams) {
		$signature = $httpMethod . "\n\n";
		$signature .= $contentType . "\n";
		$signature .= $date."\n";
		$signature .= "x-openapi-date:" . $date . "\n";
		if(!is_null($this->sessionId)) {
			$signature .= "x-openapi-session-id:" . $this->sessionId . "\n";
		}
		$signature .= $url."\n";

		if($queryParams != "") {
			$parametersArray = explode("&", $queryParams);
			if(count($parametersArray) > 0) {
				$parametersArray[0] = substr($parametersArray[0], 1, strlen($parametersArray[0]));
			}
			sort($parametersArray);

			$arrayLength = count($parametersArray);
			for ($i = 0; $i < $arrayLength; $i++) {
				if($i < $arrayLength-1) {
					$signature .= "&".urldecode($parametersArray[$i])."\n";
				} else {
					$signature .= "&".urldecode($parametersArray[$i]);
				}
			}
		}

		return $this->accessKey . ':' . base64_encode(hash_hmac('SHA256', $signature, $this->secretAccessKey, true));
	}
	
	public function fetch($httpMethod, $url, $parameters='', $content='') {
		$today = gmdate('D, d F Y H:i:s \G\M\T');
		
		switch($httpMethod) {
			default:
			case 'GET':
				$contentType =	'application/xml';
				break;
			case 'POST':
				$contentType =	'application/x-www-form-urlencoded';
				break;
		}

		$headers = $httpMethod . " " . $url . $parameters . " HTTP/1.0\r\nContent-type: " . $contentType . "\r\n";
		$headers .= "Host: " . self::SERVER . "\r\n";
		$headers .= "Content-length: " . strlen($content) . "\r\n";
		$headers .= "Connection: close\r\n";
		$headers .= "X-OpenAPI-Authorization: " . $this->getSignature($today, $httpMethod, $url, $contentType, $parameters) . "\r\n";
		$headers .= "X-OpenAPI-Date: " . $today . "\r\n";
		if(!is_null($this->sessionId)) {
			$headers .= "X-OpenAPI-Session-ID: " . $this->sessionId . "\r\n";
		}
		$headers .= "\r\n";

		$socket = fsockopen('ssl://' . self::SERVER, self::PORT, $errno, $errstr, 30);
		if (!$socket) {
			throw new Exception("{$errstr} ({$errno})");
		}
		
		fputs($socket, $headers);
		fputs($socket, $content);
		
		$result = '';

		while (!feof($socket)) {
			$result .= fgets($socket);
		}
		fclose($socket);
		
		$this->httpResponseCode = intval(substr($result, 9, 3));
		
		$result = strstr($result, '<?xml');
		
		return $result;
	}
	
	public function getHttpResponseCode() {
		return $this->httpResponseCode;
	}
	
	public function getSessionId() {
		return $this->sessionId;
	}
	
	public function setSessionId($sessionId) {
		$this->sessionId = '' . $sessionId;
	}
}

?>