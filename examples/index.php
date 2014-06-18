<?php
session_start();

function __autoload($name) {
	require('../src/bolcom/' . $name . '.php');
}

require_once 'Example.php';

if(isset($_GET['productids'])) 
	$products = $_GET['productids']; else
		$products = array('9200000025729967','9200000010923880','9200000023791396','9200000015346463','9200000009731698','9000000011187767');

Example::run();

?>