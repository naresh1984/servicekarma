<?php
class ReportsController extends Controller
{
	public function __construct($model, $action)
	{
		parent::__construct($model, $action);
		$this->_setModel($model);
		
		if(!isset($_SESSION['user_details'][0]['id']) || $_SESSION['user_details'][0]['role_id']!=2)
		{
			header("Location:".BASE_URL."login/index/");
		}		
	}
		
	public function index()
	{
		$this->_setView("index");
		$establishment_id = $_SESSION['user_details'][0]['establishment_id'];
		$users_details = array();
		$users_details = $this->_model->usersinfo($establishment_id);
		$this->_view->set('users_details', $users_details);
		
		return $this->_view->output();
	}	
	public function studentinfo()
	{
       $this->_setView("student_profile");
       @$string = explode('/', $_GET['load']);		
       @$id = @$string[2];	
	   $userDetails = array();	
	   $userDetails = $this->_model->getRowUser($id);	
		$this->_view->set('userDetails', $userDetails);
	  
	   return $this->_view->output();		
	}	
	public function comingsoon()
	{
       $this->_setView("coming_soon");
	   return $this->_view->output();		
	}
}