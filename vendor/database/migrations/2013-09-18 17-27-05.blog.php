<?php

if ( class_exists ( "query_builder" ) != TRUE )
    include "cmd/query_builder.php";

if ( class_exists ( "base_build" ) != TRUE )
    include "cmd/base_build.php";

class build_blog extends base_build
{
    private $_builder;

    protected $_schema = array ( "id" => array ( "name" => "id",
                                           "type" => "int",
                                           "limit" => "11" ),
                           "create_date" => array ( "name" => "create_date",
                                                    "type" => "timestamp",
                                                    "limit" => "" ),
                           "approved" => array ( "name" => "approved",
                                                 "type" => "int",
                                                 "limit" => "11" ),
                  "title" => array ( "name" => "title",
                    "type" => "varchar",
                    "limit" => "255" ), 
                    "body" => array ( "name" => "body",
                    "type" => "text",
                    "limit" => "" ),
                    "category_id" => array ( "name" => "category_id",
                    "type" => "varchar",
                    "limit" => "255" ), 
                    "sort" => array ( "name" => "sort",
                    "type" => "int",
                    "limit" => "11" ), 
                    "image_id" => array ( "name" => "image_id",
                    "type" => "int",
                    "limit" => "11" ), 
                    "tags" => array ( "name" => "tags",
                    "type" => "varchar",
                    "limit" => "255" ),
                    "author_id" => array ( "name" => "author_id",
                    "type" => "int",
                    "limit" => "11" ),
                    "meta_title" => array ( "name" => "meta_title",
                    "type" => "varchar",
                    "limit" => "255" ),
                    "meta_tags" => array ( "name" => "meta_tags",
                    "type" => "varchar",
                    "limit" => "255" ),
                    "meta_description" => array ( "name" => "meta_description",
                    "type" => "varchar",
                    "limit" => "255" ),
                    "urltitle" => array ( "name" => "urltitle",
                    "type" => "varchar",
                    "limit" => "255" ),
                    "popular" => array ( "name" => "popular",
                    "type" => "int",
                    "limit" => "1" ),
                    "blurb" => array ( "name" => "blurb",
                    "type" => "text",
                    "limit" => "" )
                     );

    public function __Construct ( $db_name, $tablename )
    {
        $this->_tablename = $tablename;
        $this->_db_name = $db_name;

        $this->_build = new query_builder ( $db_name, "blog" );
    }

    public function put ()
    {
        $this->_build->create_table ( "blog" );

        $this->_build->varchar( "title", "255" );
        $this->_build->text( "body" );
        $this->_build->int( "author_id", "11" );
        $this->_build->int( "category_id", "11" );
        $this->_build->int( "sort", "11" );
        $this->_build->int( "image_id", "11" );
        $this->_build->varchar( "tags", "255" );
        $this->_build->varchar( "meta_title", "255" );
        $this->_build->varchar( "meta_tags", "255" );
        $this->_build->varchar( "meta_description", "255" );
        $this->_build->timestamp( "create_date" );
        $this->_build->run();
    }


    /**
     * Method to decide whether to create the whole table or to send it to the method so it can be altered
     *
     * @access public
     */
    public function desc ()
    {
        $table_exists = mysql_query ( "SHOW TABLES LIKE 'giles_wilson_blog'" );

        if ( mysql_num_rows ( $table_exists ) == 0 )
            $this->put ();

        else
            $this->alter ();
    }
}

$build = new build_blog ( $this->_db_name, "blog" );
$build->desc ();

?>