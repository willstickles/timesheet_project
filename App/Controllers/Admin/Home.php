<?php

namespace App\Controllers\Admin;

use App\Flash;
use \Core\View;
use \App\Auth;

class Home extends Authenticated
{
	/**
	 * Before filter
	 *
	 * @return void
	 */
	protected function before() {
		parent::before();
		
		$this->user = Auth::getUser();
	}
	
	/**
	 * After filter
	 *
	 * @return void
	 */
	protected function after() {
	
	}
	
	public function indexAction() {
		echo 'Admin index';
	}
}