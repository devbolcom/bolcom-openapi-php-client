<?php

class XmlToJson {

    public function ParseXML($xmlinput) {

        $xmlinput = str_replace(array("\n", "\r", "\t"), '', $xmlinput);

        $xmlinput = trim(str_replace('"', "'", $xmlinput));

        $simpleXml = simplexml_load_string($xmlinput);

        $json = json_encode($simpleXml);
        
        $response = htmlspecialchars($json);

        return $response;

    }

}
?>