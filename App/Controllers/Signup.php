<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * Signup controller
 *
 * PHP version 7.0.2-22
 */
class Signup extends \Core\Controller
{
	/**
	 * Show the signup page
	 *
	 * @return void
	 */
	public function newAction() {
		View::renderTemplate( 'Signup.new', [
			'class'     =>  'active'
		]) ;
	}
	
	/**
	 * Sign up a new user
	 *
	 * @return void
	 */
	public function createAction() {
		$user = new User( $_POST );
		
		if ( $user->save() ) {
			
			$user->sendActivationEmail();
			
			$this->redirect( '/signup/success' );
			
		} else {
			
			View::renderTemplate( 'Signup.new', [
				'user'  =>  $user
			]);
			
		}
	}
	
	/**
	 * Show the signup success page
	 *
	 * @return void
	 */
	public function successAction() {
		View::renderTemplate( 'Signup.success' );
	}
	
	/**
	 * Activate a new account
	 *
	 * @return void
	 */
	public function activateAction() {
		User::activate( $this->route_params['token'] );
		
		$this->redirect( '/signup/activated' );
	}
	
	/**
	 * Sowh the activation success page
	 *
	 * @return void
	 */
	public function activatedAction() {
		View::renderTemplate( 'Signup.activated' );
	}
}