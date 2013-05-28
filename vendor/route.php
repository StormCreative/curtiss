<?php

class Route 
{

    /**
     * Match a given route to the URI
     * 
     * @param string $route
     * @return bool
     */ 
    public static function match($route)
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = explode( '?', $uri );
        
        if( $uri[0] == $route ) {
            return true;
        } else {
            return false;
        }
    }
}
?>