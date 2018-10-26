<?php

namespace App\Models;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PDO;
use App\Mail;
use Core\View;
use App\Flash;

/**
 * Class Excel
 *
 * PHP version 7.0.2-22
 */
class Excel extends \Core\Model
{
	/**
	 * Spreadsheet file name
	 * @var $filename
	 */
	protected $filename;
	
	/**
	 * Spreadsheet object
	 * @var array $objSpreadsheet
	 */
	protected $objSpreadsheet;

	/**
	* Error messages
	*
	* @var array
	*/
	public $errors = [];
	
	/**
	 * Projects
	 *
	 * @var array
	 */
//	public $projects = [];
	
	/**
	 * Hours
	 *
	 * @var array
	 */
//	public $hours = [];
	
	/**
	 * Excel constructor.
	 * @param string $data
	 */
	public function __construct( $data = '' ) {
		
		$this->ts_id = $data;
		
	}
	
	/**
	 * Create spreadsheet with basic author information
	 *
	 */
	public function createSpreadsheet() {
		
		$hours = static::getHoursByTimesheetId();
		$user = User::findByID( $hours->user_id );
		$this->objSpreadsheet = new Spreadsheet();
		
		// Set document properties
		$this->objSpreadsheet->getProperties()->setCreator("Harmon Bennett")
			->setLastModifiedBy( $user->name )
			->setTitle("Tierra Daily Time Sheet Summary")
			->setSubject("Daily Time Sheet")
			->setDescription("Employee daily timesheet.")
			->setKeywords("office Excel php")
			->setCategory("Timesheet");
		
		// Set document header row
		$this->objSpreadsheet->getActiveSheet()
			->setCellValue('A1', 'Employee Name')
			->setCellValue('B1', 'Lunch Hours')
			->setCellValue('C1', 'Total daily hours')
			->setCellValue('D1', 'Email Address')
			->setCellValue('E1', 'Day Start Time')
			->setCellValue('F1', 'Day End Time')
			->setCellValue('G1', 'Start Location')
			->setCellValue('H1', 'Report Date' )
			->setCellValue('I1', 'Project Number')
			->setCellValue('J1', 'Project Name')
			->setCellValue('K1', 'Time Arrived')
			->setCellValue('L1', 'Client Name')
			->setCellValue('M1', 'Densities')
			->setCellValue('N1', 'Concrete')
			->setCellValue('O1', 'Samples')
			->setCellValue('Q1', 'Remarks')
			->setCellValue('P1', 'Time Departed Job');
		
		$this->setData();
		
		return true;
			
	}
	
	protected function getHoursByTimesheetId() {
		
		$sql = 'SELECT * FROM timesheets
				WHERE id = :id';
		
		$db = static::getDB();
		$stmt = $db->prepare( $sql );
		
		$stmt->bindValue( ':id', $this->ts_id, PDO::PARAM_STR );
		
		$stmt->setFetchMode( PDO::FETCH_CLASS, get_called_class() );
		
		$stmt->execute();
		
		return $stmt->fetch();
		
	}
	
	protected function getProjectsById() {
		
		$sql = 'SELECT * FROM projects
				WHERE timesheet_id = :timesheet_id';
		
		$db = static::getDB();
		$stmt = $db->prepare( $sql );
		
		$stmt->bindValue( ':timesheet_id', $this->ts_id, PDO::PARAM_STR );
		
		$stmt->setFetchMode( PDO::FETCH_CLASS, get_called_class() );
		
		$stmt->execute();
		
		$projects = $stmt->fetchAll();
		
		return $projects;
		
	}
	
	public function save() {
		
		if ( file_exists( ROOT . DS . 'timesheets' . DS . 'Excel.xlsx' ) ) {
			$this->objSpreadsheet = IOFactory::load( ROOT . DS . 'timesheets' . DS . 'Excel.xlsx' );
			
			if ( $this->setData() ) {
				
				return true;
			}
			
		} else {
			if ( $this->createSpreadsheet() ) {
				return true;
			}
		}
		
		return false;

	}
	
	public function setData() {
		
		$hours = static::getHoursByTimesheetId();
		$user = User::findByID( $hours->user_id );
		$projects = static::getProjectsById();
		
		// Get the highest row number and column letter referenced in the worksheet
		$highestRow = $this->objSpreadsheet->getActiveSheet()->getHighestRow(); // e.g. 10
		
		$row = $highestRow + 1;
		
		// Set User Name and Hours
		$this->objSpreadsheet->getActiveSheet()
			->setCellValue( 'A'.$row, $user->name )
			->setCellValue( 'B'.$row, $hours->lunch_hours )
			->setCellValue( 'C'.$row, $hours->total_hours )
			->setCellValue( 'D'.$row, $user->email )
			->setCellValue( 'E'.$row,  $hours->start_time )
			->setCellValue( 'F'.$row, $hours->end_time )
			->setCellValue( 'G'.$row, $hours->start_location )
			->setCellValue( 'H'.$row, $hours->report_date );
		
		// Set Project information for this timesheet
		foreach ( $projects as $rows => $columns ) {
			$this->objSpreadsheet->getActiveSheet()
				->setCellValue( 'I'.$row, $columns->project_id )
				->setCellValue( 'J'.$row, $columns->project_name )
				->setCellValue( 'K'.$row, $columns->time_arrived )
				->setCellValue( 'L'.$row, $columns->client_name )
				->setCellValue( 'M'.$row, $columns->densities )
				->setCellValue( 'N'.$row, $columns->concrete )
				->setCellValue( 'O'.$row, $columns->samples )
				->setCellValue( 'Q'.$row, $columns->remarks )
				->setCellValue( 'P'.$row, $columns->time_departed );
			$row++;
		}
		
		// Save spreadsheet
		$objWriter = IOFactory::createWriter( $this->objSpreadsheet, 'Xlsx');
		
		try {
			$objWriter->save( str_replace('.php', '.xlsx', ROOT . DS . 'timesheets' . DS . pathinfo(__FILE__, PATHINFO_BASENAME) ) );
			return true;
		} catch ( \PHPExcel_Writer_Exception $e ) {
			echo "<br/>********** BEGIN DEBUGGING **********<br/>";
			echo "<pre>";
			echo "DESC: Save Errors  <br />";
			echo htmlspecialchars( var_dump( $e->getMessage() ) );
			echo "</pre>";
			echo "********** END DEBUGGING **********<br />";
		}
		return false;
		
	}
	
	public function sendTimesheetEmail( $email ) {
		
		$hours = static::getHoursByTimesheetId();
		$user = User::findByID( $hours->user_id );
		$projects = static::getProjectsById();
		
		$html = View::getTemplate( 'Timesheet.daily_timesheet_email_html', [
			'hours' =>  $hours,
			'user'  =>  $user,
			'projects'  =>  $projects
		] );
		
		$text = View::getTemplate( 'Timesheet.daily_timesheet_email_txt', [
			'hours' =>  $hours,
			'user'  =>  $user,
			'projects'  =>  $projects
		] );
		
		Mail::send( $email, 'Tierra Daily Timesheet', $text, $html );

	}
	
}