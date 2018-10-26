<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

/**
 * Password controller
 *
 * PHP version 7.0.2-22
 */
class Password extends \Core\Controller
{
	/**
	 * Show the forgotten password page
	 *
	 * @return void
	 */
	public function forgotAction() {
		View::renderTemplate( 'Password.forgot' );
	}
	
	/**
	 * Send the password reset link to the supplied email
	 *
	 * @return void
	 */
	public function requestResetAction() {
		User::sendPasswordReset( $_POST['email'] );
		
		View::renderTemplate( 'Password.reset_requested' );
	}
	
	/**
	 * Show the reset password form
	 *
	 * @return void
	 */
	public function resetAction() {
		$token = $this->route_params['token'];
		
		$user = $this->getUserOrExit( $token );
		
		View::renderTemplate( 'Password.reset', [
			'token' =>  $token
		] );
		
		
	}
	
	/**
	 * Reset the user's password
	 *
	 * @return void
	 */
	public function resetPasswordAction() {
		$token = $_POST['token'];
		
		$user = $this->getUserOrExit( $token );
		
		$user = User::findByPasswordReset( $token );
		
		if ( $user->resetPassword( $_POST['password'] ) ) {
			
			View::renderTemplate( 'Password.reset_success' );
			
		} else {
			
			View::renderTemplate( 'Password.reset', [
				'token' =>  $token,
				'user'  =>  $user
			]);
			
		}
		
		
	}
	
	/**
	 * Find the user model associated with the password reset token, or end the request with a message
	 *
	 * @param string $token Password reset sent to user
	 *
	 * @return mixed User object if found and the token hasn't expired, null otherwise
	 */
	protected function getUserOrExit( $token ) {
		$user = User::findByPasswordReset( $token );
		
		if ( $user ) {
			
			return $user;
			
		} else {
			
			View::renderTemplate( 'Password.token_expired' );
			exit;
			
		}
	}
	
	
}