<?php

namespace App;

/**
 * Application configuration
 *
 * PHP version 7.0.2-22
 */
class Config
{
	/**
	 * Database host
	 * @var string
	 */
	const DB_HOST = 'localhost';
	
	/**
	 * Database name
	 * @var string
	 */
	const DB_NAME = 'harmonmvc';
	
	/**
	 * Database user
	 * @var string
	 */
	const DB_USER = 'root';
	
	/**
	 * Database password
	 * @var string
	 */
	const DB_PASSWORD = 'root';
//	const DB_PASSWORD = 'SGbp2#9pA9n=';
	
	/**
	 * Show or hide error messages on screen
	 * @var boolean
	 */
	const SHOW_ERRORS = true;
	
	/**
	 * Secret key for hashing
	 * @var boolean
	 */
	const SECRET_KEY = 'Aw4d1MaOo81dJ10JawAZEOTAD80C3mK3';
	
	/**
	 * SMTPDebug
	 */
	const PHPMAILER_SMTPDEBUG = 0;
	
	/**
	 * Host
	 */
	const PHPMAILER_HOST = 'smtp.1and1.com';
	
	/**
	 * SMTPAuth
	 */
	const PHPMAILER_SMTPAUTH = true;
	
	/**
	 * Username
	 */
	const PHPMAILER_USERNAME = 'smtp.user@tierradaily.com';
	
	/**
	 * Password
	 */
	const PHPMAILER_PASSWORD = 'urnID10t';
	
	/**
	 * SMTPSecure
	 */
	const PHPMAILER_SMTPSECURE = 'tls';
	
	/**
	 * Port
	 */
	const PHPMAILER_PORT = 25;
}