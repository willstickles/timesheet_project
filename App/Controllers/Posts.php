<?php

namespace App\Controllers;

use Core\View;
use App\Models\Post;

/**
 * Posts controller
 *
 * PHP version 7.0.22-2
 */
class Posts extends Authenticated
{
	/**
	 * Show the index page
	 *
	 * @return void
	 */
	public function indexAction() {
		$posts = Post::getAll();
		
		VIEW::renderTemplate( 'Posts.index', [
			'posts'     =>  $posts,
			'class'     =>  'active'
		]);
	}
	
	/**
	 * Show the add new page
	 *
	 * @return void
	 */
	public function addNewAction() {
		View::renderTemplate( 'Posts.add-new' );
	}
	
	/**
	 * Show the edit page
	 *
	 * @return void
	 */
	public function editAction() {
		View::renderTemplate( 'Posts.edit', [ 'params' => $this->route_params ] );
	}
}