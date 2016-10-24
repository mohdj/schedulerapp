<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examples extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null)
	{
		$this->load->view('example.php',$output);
	}

		
	public function students()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('students');
			
			$output = $crud->render();	

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	public function reports()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('daily_hifz_report');
			
			$output = $crud->render();	

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	public function teachers()
	{
		try{

			session_start();
			if ($_SESSION['login_teacher'] == "30376437" || $_SESSION['login_teacher'] == "30376437")
				{

				}else
				 header("Location: http://www.muntasebaathifz.com/app/login.php");

			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('teachers');
			
			$output = $crud->render();	

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

}