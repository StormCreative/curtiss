<?php

class autoloader
{
    private static $_instance;

    public static function autoload($class)
    {
        if( !self::$_instance ) {

            $class = strtolower ( $class );
            
            $class_actual = str_replace ( "_model", "", $class );

            if( file_exists(PATH.'vendor/src/' . $class . '.php') ) {

                require_once( PATH.'vendor/src/' . $class . '.php' );

            } elseif( file_exists(PATH.'vendor/database/connection/' . $class . '.php') ) {
              
                require_once( PATH.'vendor/database/connection/' . $class . '.php' ); 

            } elseif( file_exists(PATH.'vendor/database/'.$class.'.php') ) {

                require_once( PATH.'vendor/database/'.$class.'.php' );
                                    
            } elseif( file_exists(PATH.'models/'.$class.'.php') ) {

                require_once( PATH.'models/'.$class.'.php' );

            }

            spl_autoload_extensions('.php');
            spl_autoload_register(array( __CLASS__, 'autoload'));
        }

        return self::$_instance;
    }
}

?>