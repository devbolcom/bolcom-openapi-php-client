<?php
session_start();
require_once 'config.php';

function __autoload($name) {
	require('classes/' . $name . '.php');
}

App::run();

?>