<?php

class Template 
{

    /**
     * Renders the given template by the defined route
     * 
     * @param string $route
     * @param string $view
     * @param optional array $params - parameters to pass into the method
     * @param optional bool $header
     * @param optional bool $footer
     */ 
    public static function render($route, $view, $params=array(), $header=true, $footer=true)
    {
        self::extract_params($params);

        $view = $_SERVER['DOCUMENT_ROOT'].DIRECTORY.'views/'.$view;

        if (Route::match($route)) {
            self::load($view, $header, $footer, $params);    
            $output = true;
        } else {

            // Return false so that other views can continue to render if there are multiples
            // Within the main app script file.
            $output = false;
        }

        return $output;
    }


    /**
     * Requires in the given template
     * 
     * @param string $view
     * @param bool $header
     * @param bool $footer
     */
    protected static function load($view, $header, $footer, $params=array())
    {
        if (file_exists($view)) {

            extract($params, EXTR_PREFIX_SAME, "wddx");

            if ($header) {
                require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY.'views/site/top.php');
            }

            require_once( $view );

            if ($footer) {
                require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY.'views/site/bottom.php');
            }
        } else {
            throw new Exception('View file does not exist');
            return false;
        }
    }


    /**
     * Render the top/bottom site view within views/site folder
     * 
     * @param string $position - options are: top/bottom
     */ 
    protected static function render_site_view($position)
    {
        require_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY.'views/site/'.$position.'.php');
    }


    /**
     * Extact any given parameters into the view
     */
    protected static function extract_params($params)
    {
        if (count($params) > 0) {
            extract( $params, EXTR_PREFIX_SAME, "wddx" );
        }
    }
}

?>