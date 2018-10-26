<?php
/**
 * Front Controller
 *
 * PHP version 7.0.22-2
 */
ph
/**
 * Site variables
 */
define( 'DS', DIRECTORY_SEPARATOR );
define( 'ROOT', dirname(__DIR__ ) );
define( 'VIEWS_PATH', ROOT . DS . 'App' . DS . 'Views' );
define( 'CACHE_DIR', ROOT . DS . 'cache' );
define( 'COMPILED_DIR', ROOT . DS . 'compiled' );
define( 'BLADEONE_MODE', 1 ); // (optional) 1=forced (test), 2=run fast (production), 0=automatic, default value.

include( ROOT . DS . 'App' . DS . 'simple_html_dom.php' );

date_default_timezone_set( 'America/New_York' );

/**
 * Composer
 */
require ROOT . DS . 'vendor' . DS . 'autoload.php';

/**
 * Error and Exception handling
 */
error_reporting( E_ALL );
set_error_handler( 'Core\Error::errorHandler' );
set_exception_handler( 'Core\Error::exceptionHandler' );

/**
 * Sessions
 */
session_start();

/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add( '', ['controller' => 'Home', 'action' => 'index'] );
$router->add( 'login', ['controller' => 'Login', 'action' => 'new'] );
$router->add( 'logout', ['controller' => 'Login', 'action' => 'destroy'] );
$router->add( 'password/reset/{token:[\da-f]+}', ['controller' => 'Password', 'action' => 'reset'] );
$router->add( 'signup/activate/{token:[\da-f]+}', ['controller' => 'Signup', 'action' => 'activate'] );
$router->add( 'admin/{controller}/{id:\d+}/{action}', ['namespace' => 'Admin' ] );
$router->add( 'admin/{controller}/{action}', ['namespace' => 'Admin' ] );
$router->add( '{controller}/{id:\d+}/{action}');
$router->add( '{controller}/{action}');

$router->dispatch( $_SERVER['QUERY_STRING'] );