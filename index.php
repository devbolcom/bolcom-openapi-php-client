<?php

function __autoload($name) {
	require('classes/' . $name . '.php');
}

App::run();

?>