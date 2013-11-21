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

/*
|----------------------------------------------------------------
| The directory in which the application resides
|----------------------------------------------------------------
|
| This is automatically generated, you can access this
| as a constant anywhere throughout the application
|
*/
define( 'DIRECTORY', str_replace( $_SERVER[ 'DOCUMENT_ROOT' ], '', $directory ).'/' );

/*
|----------------------------------------------------------------
| The root path of the application
|----------------------------------------------------------------
*/
define( 'PATH', $_SERVER['DOCUMENT_ROOT'].DIRECTORY );

/*
|----------------------------------------------------------------
| The environment of the application
|----------------------------------------------------------------
|
| Determines whether the application is local or live
| and sets true or false for the environment type
|
*/
$live = TRUE;

if ($_SERVER['HTTP_HOST'] == 'localhost:8888' || substr($_SERVER['HTTP_HOST'], 0, 7) == '123.168') {
	$live = FALSE;
}

define( 'LIVE', $live );

?>