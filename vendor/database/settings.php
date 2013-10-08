<?php


$settings[ 'DB_HOST' ] = 'localhost';
$settings[ 'DB_NAME' ] = 'table';
$settings[ 'DB_USER' ] = 'root';
$settings[ 'DB_PASS' ] = 'root';

$settings[ 'DB_SUFFIX' ] = 'table';

$settings[ 'USE_DB' ] = TRUE;

foreach($settings as $key => $value) {
	define($key, $value);
}

?>