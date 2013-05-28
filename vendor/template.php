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
        if ( count($params) > 0 ) {
            extract( $params, EXTR_PREFIX_SAME, "wddx" );
        }

        $view = $_SERVER['DOCUMENT_ROOT'].'/views/'.$view;

        if( Route::match($route) ) {
            self::load($view, $header, $footer);    
        } else {
            return false;
        }
    }


    /**
     * Requires in the given template
     * 
     * @param string $view
     * @param bool $header
     * @param bool $footer
     */
    protected static function load($view, $header, $footer)
    {
        if( file_exists($view) ) {
            if( $header ) {
                self::render_site_view('top');
            }

            require_once( $view );

            if( $footer ) {
                self::render_site_view('footer');
            }
        } else {
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
        require_once($_SERVER['DOCUMENT_ROOT'].'/views/site/'.$position.'.php');
    }


    /**
     * Extact any given parameters into the view
     */
    protected static function extract_params($params)
    {
        if( count($params) > 0 ) {
            extract( $params, EXTR_PREFIX_SAME, "wddx" );
        }
    }
}

?>