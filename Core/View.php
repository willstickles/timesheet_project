<?php

namespace Core;

use eftec\bladeone, eftec\bladeone\BladeOneHtml, eftec\bladeone\BladeOneHtmlBootstrap;
use PHPMailer\PHPMailer\Exception;

/**
 * Base view
 *
 * PHP version 7.0.22-2
 */
class View extends bladeone\BladeOne
{
	/**
	 * Render a view file
	 *
	 * @param string $view The view file
	 * @param array $args  Associative array of data to display in the view ( optional )
	 * @throws \Exception
	 *
	 * @return void
	 */
	public static function render( $view, $args = [] ) {
		extract( $args, EXTR_SKIP );
		
		$file = "../App/Views/$view"; // relative to Core director
		
		if ( is_readable( $file ) ) {
			require $file;
		} else {
			throw new Exception( "$file not found" );
		}
	}
	
	/**
	 * Render a view template using BladeOne
	 *
	 * @param string    $template   The template file
	 * @param array     $args       Associative array of data to display in the view ( optional )
	 *
	 * @return string
	 */
	public static function renderTemplate( $template, $args = [] ) {
		echo static::getTemplate( $template, $args );
	}
	
	/**
	 * Get the contents of a view template using BladeOne
	 *
	 * @params string   $template   The template file
	 * @params array    $args       Associative array of data to display in the view ( optional )
	 *
	 * @return string
	 */
	public static function getTemplate( $template, $args = [] ) {
		static $blade = null;
		
		$args['current_user'] = \App\Auth::getUser();
		$args['flash_messages'] = \App\Flash::getMessages();
		
		if ( $blade === null ) {
			$blade = new View( VIEWS_PATH, COMPILED_DIR );
		}
		
		return $blade->run( $template, $args );
	}
	
	
}