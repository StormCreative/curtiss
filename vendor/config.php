<?php
/*
|----------------------------------------------------------------
| Application Configuration settings
|----------------------------------------------------------------
|
| Calls in the neccessary classes and define the global site
| variables to be accessible throughout the application
|
*/


//---------------------------------------------------------------
// Require in the system classes to run the application
//---------------------------------------------------------------
require( 'route.php' );
require( 'template.php' );
require( 'api.php' );
require( 'database/settings.php' );


//---------------------------------------------------------------
// Set the site directory 
//---------------------------------------------------------------
$directory = getcwd();

define( 'DIRECTORY', str_replace( $_SERVER[ 'DOCUMENT_ROOT' ], '', $directory ).'/' );

define( 'PATH', $_SERVER['DOCUMENT_ROOT'].DIRECTORY );

?>