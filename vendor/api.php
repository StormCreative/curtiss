<?php

class API
{
	/**
	 * The main table to connect to
	 * 
	 * @var string
	 */
	public $table;


	/**
	 * The API action
	 * 
	 * @var string
	 */
	public $action;


	/**
	 * The model the API is communicating with
	 *
	 * @var object
	 */
	public $model;


	/**
	 * The binded values for the DB calls
	 * 
	 * @var array
	 */
	public $binds;

	/**
	 * Initiates the API by a given route
	 * Only actions once the browser URI matches
	 * that of the API route set within the main app file
	 *
	 * This is the main entry point for the API
	 * 
	 * @param string $route
	 * @param boolean $kill - whether to exit the array or return it, used for unit testing
	 */
	public static function fetch($route, $kill=true)
	{
		$routes = Route::get_uri();

		$table = $route;

		if (Route::match($table)) {

			$api = new API($table, $routes['additions']);

			if( !!$routes['route_0'] ) {
				$api->action = $routes['route_0'];

				if( method_exists('API', $api->action) ) {
					$result = $api->{$api->action}();

					if( $kill ) {
						exit(json_encode($result));
					} else {
						return $result;
					}
				}
			} else {
				throw new Exception('An action for the API has not been defined.');
			}
		}
	}


	public function __Construct($table="", $params="")
	{	
		// Remove any trailing slashes if they become apparent.
		$this->table = str_replace('/', '', $table);

		$this->load_table();
		$this->handle_uri_params($params);
	}


	/**
	 * Builds up the additional arguments within the URI
	 * these are the query strings picked up by the GET
	 * which are treated as conditions to build up the where clause
	 * 
	 * @params string $params
	 * @access protected
	 * @return void
	 */
	protected function handle_uri_params($params)
	{
		if (!!$params) {

			// Doing this if it was incoming from a string
			// But then it doesn't make sense to have it coming
			// incoming from a string, as its will always be a HTTP
			// request and be passed through and catched with a $_GET

			$params = explode('&', $params);

			foreach ($params as $value) {
				$value = explode('=', $value);

				// Build up the models where clause and the API's bind array
				$this->model->where($value[0].' = :'.$value[0]);
				$this->binds[$value[0]] = $value[1];
			}
			
			// However the unit tests don't pick up the $_GET
			
			/*
			foreach( $_GET as $key => $value ) {
				$this->model->where($key.' = :'.$key);
				$this->binds[$key] = $value;	
			}
			*/
		}

		return $this;
	}


	/**
	 * Retrieves all instances from the database
	 * 
	 * @access protected
	 * @return array 
	 */
	protected function get()
	{
		$output = $this->model->all($this->binds);
		
		if ($output != false) {
			$result = array('status' => 200,
							'data' => $output
							);
		} else {
			$result = array('status' => 401);
		}

		return $result;
	}


	/**
	 * Loads the associated model to connect to 
	 * the database table
	 * 
	 * @access protected
	 * @return void
	 */
	protected function load_table()
	{
		$model = $this->table.'_model';

		if (class_exists($model)) {
			$this->model = new $model();
		}

		return $this;
	}	

}

?>