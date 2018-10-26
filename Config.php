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
	const DB_HOST = '';
	
	/**
	 * Database name
	 * @var string
	 */
	const DB_NAME = '';
	
	/**
	 * Database user
	 * @var string
	 */
	const DB_USER = '';
	
	/**
	 * Database password
	 * @var string
	 */
	const DB_PASSWORD = '';
	
	/**
	 * Show or hide error messages on screen
	 * @var boolean
	 */
	const SHOW_ERRORS = true;
	
	/**
	 * Secret key for hashing
	 * @var boolean
	 */
	const SECRET_KEY = '';
	
	/**
	 * SMTPDebug
	 */
	const PHPMAILER_SMTPDEBUG = 0;
	
	/**
	 * Host
	 */
	const PHPMAILER_HOST = '';
	
	/**
	 * SMTPAuth
	 */
	const PHPMAILER_SMTPAUTH = true;
	
	/**
	 * Username
	 */
	const PHPMAILER_USERNAME = '';
	
	/**
	 * Password
	 */
	const PHPMAILER_PASSWORD = '';
	
	/**
	 * SMTPSecure
	 */
	const PHPMAILER_SMTPSECURE = 'tls';
	
	/**
	 * Port
	 */
	const PHPMAILER_PORT = 25;
}