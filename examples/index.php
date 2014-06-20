<?php
session_start();

function __autoload($name) {
	require('../src/bolcom/' . $name . '.php');
}
//please fill in your API-key in Example.php before running index.php
require_once 'Example.php';

Example::run();

?>