<?php

namespace App\Models;

use App\Flash;
use Core\View;
use PDO;
use App\simple_html_dom;

/**
 * Project class
 *
 * PHP version 7.0.2-22
 */
class Project extends \Core\Model
{
	/**
	 * Error messages
	 *
	 * @var array
	 */
	public $errors = [];
	
	/**
	 * User constructor.
	 *
	 * @param array $data       Initial property values
	 */
	public function __construct( $data = [] ) {
		foreach ( $data as $key => $value ) {
			$this->$key = $value;
		}
	}
	
	/**
	 * Save job information
	 *
	 * @return boolean True if data is saved, false otherwise
	 */
	 private function saveHours() {
		
	 	$email = ( isset($_POST['email']) ) ? $_POST['email'] : '';
	 	
		$user = User::findByEmail( $email );
		
		$this->validate();
		
		if ( empty( $this->errors ) ) {
			$sql = 'INSERT INTO timesheets ( user_id, lunch_hours, start_location, start_time, end_time, total_hours, report_date, created_at )
					VALUES ( :user_id, :lunch_hours, :start_location, :start_time, :end_time, :total_hours, :report_date, :created_at )';
			
			$db = static::getDB();
			$stmt = $db->prepare( $sql );
			
			$stmt->bindValue( ':user_id', $user->id, PDO::PARAM_INT );
			$stmt->bindValue( ':lunch_hours', $this->luncHours, PDO::PARAM_INT );
			$stmt->bindValue( ':start_location', $this->startLocation, PDO::PARAM_STR );
			$stmt->bindValue( ':start_time', $this->dailyStartTime, PDO::PARAM_STR );
			$stmt->bindValue( ':end_time', $this->dailyEndTime, PDO::PARAM_STR );
			$stmt->bindValue( ':total_hours', $this->totalDailyHours, PDO::PARAM_INT );
			$stmt->bindValue( ':report_date', date( 'Y-m-d H:i:s', strtotime($this->reportDate)), PDO::PARAM_STR );
			$stmt->bindValue( ':created_at', date( 'Y-m-d H:i:s' ), PDO::PARAM_STR );
			
			return $stmt->execute();
		}
		
		return false;
		
	}
	
	public function saveProject() {
	 	
	 	$save_hours = $this->saveHours();
		
		if ( $save_hours ) {
			
			$sql = 'INSERT INTO projects ( timesheet_id, project_id, project_name, client_name, time_arrived, time_departed, densities, concrete, samples,remarks )
				VALUES ( :timesheet_id, :project_id, :project_name, :client_name, :time_arrived, :time_departed, :densities, :concrete, :samples, :remarks )';
			
			$db = static::getDB();
			$timesheet_id = $db->lastInsertId();
			$stmt = $db->prepare( $sql );
			
			$arr = $this; // @TODO You should sanitize this.
			$proj = [];
			$assocProject = [];
			$inlineProject = [];
			$finalArr = [];
			
			foreach ($arr as $key => $value) {
				if (is_array($value)) {
					if ($key == "projectId") {
						$inlineProject = $value;
						
					} else {
						$assocProject[$key] = $value;
					}
					
					unset($arr->$key);
				}
			}
			
			foreach ($assocProject as $key => $value) {
				foreach ($value as $k => $v) {
					$proj[$inlineProject[$k]][$key] = $v;
				}
			}
			
			foreach ($proj as $key => $value) {
				$finalArr['projectId'][$key] = $value;
			}
			
			foreach ( $finalArr['projectId'] as $key => $value ){
				
				if ( is_array( $value ) ) {
					
					for ( $i=0; $i<count($key); $i++ ) {
						
						$stmt->bindValue( ':timesheet_id', $timesheet_id, PDO::PARAM_INT );
						$stmt->bindValue( ':project_id', $key, PDO::PARAM_STR );
						$stmt->bindValue( ':project_name', $value['projectName'], PDO::PARAM_STR );
						$stmt->bindValue( ':client_name', $value['clientName'], PDO::PARAM_STR );
						$stmt->bindValue( ':time_arrived', $value['arrivalTime'], PDO::PARAM_STR );
						$stmt->bindValue( ':time_departed', $value['timeDeparted'], PDO::PARAM_STR );
						$stmt->bindValue( ':densities', $value['densities'], PDO::PARAM_STR );
						$stmt->bindValue( ':concrete', $value['concrete'], PDO::PARAM_STR );
						$stmt->bindValue( ':samples', $value['samples'], PDO::PARAM_STR );
						$stmt->bindValue( ':remarks', $value['remarks'], PDO:: PARAM_LOB );
						
						$stmt->execute();
					}
					
				}
				
			}
			
			if ( $stmt->errorInfo()[0] == '00000' ) {
				return $timesheet_id;
			}
			
		} else {
			Flash::addMessage( 'There was a problem saving your hours. Please try again.' );
			View::renderTemplate( 'Timesheet.add-new', [
				'project'    =>  $this->errors
			]);
		}
		
	}
	
	private function validate() {
		
	 	if ( $this->employeeName == '' ) {
	 		$this->errors[] = 'Name is required';
	    }
	    
	    if ( $this->email == '' ) {
	 		$this->errors[] = 'Email is required';
	    }
	    
//	    if ( $this->reportDate == '' ){
//	 		$this->errors[] = 'Report date is required';
//	    }
//
//	    if ( $this->projectId == '' ) {
//	    	$this->errors[] = 'Project Id is required';
//	    }
//
//	    if ( $this->projectName == '' ) {
//	    	$this->errors[] = 'Project Name is required';
//	    }
//
//	    if ( $this->arrivalTime == '' ) {
//	    	$this->errors[] = 'Arrival Time is reqired';
//	    }
//
//	    if ( $this->timeDeparted == '' ) {
//	    	$this->errors[] = 'Departure Time is reqired';
//	    }
		
	}
	
	public static function getProjectList() {
	 	$plist = [];
	 	$data = file_get_contents( 'http://tierraeng.com/plist/CombPLIST7351.htm' );
		
		$dom = new \DOMDocument();
		
		@$dom->loadHTML($data);
		
		$dom->preserveWhiteSpace = false;
		
		$tables = $dom->getElementsByTagName( 'table' )->item( 0 );
		
		$rows = $tables->getElementsByTagName('tr');
		
		foreach ($rows as $row) {
			$cols = $row->getElementsByTagName('td');
//			$cols = str_replace( '\n', '', $cols);
			$plist[$cols->item(0)->nodeValue] = $cols->item(1)->nodeValue;

//			$plist[]['projectNo'] = $cols->item(0)->nodeValue;
//			$plist[]['projectName'] = $cols->item(1)->nodeValue;
		}
		
		$plist['count'] = count($plist);
		
		echo json_encode( $plist );
	}
	
}