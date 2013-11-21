<?php

class Route 
{

    /**
     * Match a given route to the URI
     * 
     * @param string $route
     *
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
        $uri = $_SERVER['REQUEST_URI'];

        if (!LIVE) {
            $uri = str_replace(DIRECTORY, '', $uri);
        }

        $uri = Route::decipher($uri);

        return $uri;
    }

    /**
     * This method deciphers a given URL into chunks
     * and puts these into an associative array seperating 
     * out the routes from the query strings
     * 
     * @param string $route - the route to decipher
     *
     * @return assoc array 
     */
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

    /**
     * Builds up the array of the query strings by their key => values
     * and sets them as routes within the assoc array
     * 
     * @param array $routes
     * 
     * @return assoc array
     */
    protected static function set_additional_params($routes)
    {
        $result = array();

        for ($i=0; $i<=count($routes); $i++) {
            if( !!$routes[$i] ) {
                $result['route_'.$i] = $routes[$i];
            }
        }

        return $result;
    }
}
?>