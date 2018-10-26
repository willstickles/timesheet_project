<?php

namespace App\Controllers;

use App\Flash;
use \Core\View;
use \App\Auth;

/**
 * Profile controller
 *
 * PHP version 7.0.2-22
 */
class Profile extends Authenticated
{
	/**
	 * Before filter - called before each action method
	 *
	 * @return void
	 */
	protected function before() {
		parent::before();
		
		$this->user = Auth::getUser();
		
		if ( $this->user->is_admin ) {
			$this->redirect( '/admin/profile/show' );
		}
		
	}
	/**
	 * Show the profile
	 *
	 * @return void
	 */
	public function showAction() {
		View::renderTemplate( 'Profile.show', [
			'user'  =>  $this->user
		] );
	}
	
	/**
	 * Show the form for editing the profile
	 *
	 * @return void
	 */
	public function editAction() {
		View::renderTemplate( 'Profile.edit', [
			'user'  =>  $this->user
		] );
	}
	
	/**
	 * Update the profile
	 *
	 * @return void
	 */
	public function updateAction() {
		
		if ( $this->user->updateProfile( $_POST ) ) {
			
			Flash::addMessage( 'Changes saved' );
			
			$this->redirect( '/profile/show' );
			
		} else {
			
			View::renderTemplate( 'Profile.edit', [
				'user'  =>  $this->user
			]);
			
		}
	}
}