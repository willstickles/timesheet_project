<?php

namespace App\Controllers;

use App\Models\Project;
use App\Models\Excel;
use Core\View;

/**
 * Timesheet controller
 *
 * PHP version 7.0.2-22
 */
class Timesheet extends Authenticated
{
	/**
	 * Show the index page
	 *
	 * @return void
	 */
	public function indexAction() {
		View::renderTemplate( 'Timesheet.index' );
	}
	
	/**
	 * Add new timesheet
	 *
	 * @return void
	 */
	public function addNewAction() {
		View::renderTemplate( 'Timesheet.add-new' );
	}
	
	/**
	 * Submit a new timesheet
	 *
	 * @return void
	 */
	public function createAction() {
		
		$project = new Project( $_POST );
		
		$save_project = $project->saveProject(); // returns Timesheet ID
		
		if ( is_numeric( $save_project ) && ! is_array( $save_project ) ) {
			$timesheet = new Excel( $save_project );
			
			if ( $timesheet->save() ) {

				$timesheet->sendTimesheetEmail( $_POST['email'] );
				
				View::renderTemplate( 'Timesheet.daily_timesheet_success' );
				
			}
		}
	}
	
	public function getPList() {
		$plist = Project::getProjectList();
	}
}