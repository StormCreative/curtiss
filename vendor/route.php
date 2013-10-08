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
        $uri = Route::get_uri();

        if( '/'.$uri['route'] == $route ) {
            return true;
        } else {
            return false;
        }
    }

    public static function get_uri()
    {
        $uri = str_replace(DIRECTORY, '', $_SERVER['REQUEST_URI']);

        $uri = Route::decipher($uri);

        return $uri;
    }

    public static function decipher($route)
    {   
        $result = array();

        $route = explode('?', $route);

        $routes = explode('/', $route[0]);

        if( $routes[0] == '') {
            $route_target = 1;
        } else {
            $route_target = 0;
        }

        if (!!$routes[$route_target+1]) {
            $additonal_routes = explode('/', $routes[$route_target+1]);
            $result = Route::set_additional_params($additonal_routes);
        }

        $result['route'] = $routes[$route_target];
        
        $result['additions'] = $route[1];
        
        return $result;
    }

    protected static function set_additional_params($routes)
    {
        $result = array();

        for($i=0; $i<=count($routes); $i++) {
            if( !!$routes[$i] ) {
                $result['route_'.$i] = $routes[$i];
            }
        }

        return $result;
    }
}
?>