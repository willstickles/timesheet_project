<?php

namespace Core;

use PDO;
use App\Config;


/**
 * Base model
 *
 * PHP version 7.0.2-22
 */
abstract class Model
{
	/**
	 * Get the POD database connection
	 *
	 * @return mixed
	 */
	protected static function getDB(){
		static $db = null;
		
		if ( $db === null ) {
				$dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
				$db = new PDO( $dsn, Config::DB_USER, Config::DB_PASSWORD );
				
				// Throw an Exception when an error occurs
				$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}
		return $db;
	}
}