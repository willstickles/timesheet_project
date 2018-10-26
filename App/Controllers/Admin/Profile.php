<?php

namespace App\Controllers\Admin;

use \App\Flash;
use \Core\View;
use App\Auth;

/**
 * Class Profile admin controller
 * @package App\Controllers\Admin
 */
class Profile extends \App\Controllers\Authenticated
{
	/**
	 * Before filter
	 *
	 * @return void
	 */
	protected function before() {
		parent::before();
		
		$this->user = Auth::getUser();
		
		if ( ! $this->user->is_admin ) {
			$this->redirect( '/profile/show' );
		}
		
	}
	
	/**
	 * Show the profile
	 *
	 * @return void
	 */
	public function showAction() {
		View::renderTemplate( 'Admin.Profile.show', [
			'user'  =>  $this->user
		] );
	}
	
	/**
	 * Show the form for editing the profile
	 *
	 * @return void
	 */
	public function editAction() {
		View::renderTemplate( 'Admin.Profile.edit', [
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
			
			$this->redirect( '/admin/profile/show' );
			
		} else {
			
			View::renderTemplate( 'Admin.Profile.edit', [
				'user'  =>  $this->user
			]);
			
		}
	}
}