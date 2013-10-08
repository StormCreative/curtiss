<?php
//----------------------------------------
// Load in application configuration file
//----------------------------------------
require('vendor/config.php');
require('vendor/autoloader.php');

Autoloader::autoload($class);

// Put your own code below...

Template::render('/', 'index.php', array('style' => 'index', 'script' => 'main'));	

// Set up the ability to communicate to the competitions API.
API::fetch('/table');

?>