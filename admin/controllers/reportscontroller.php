<?php
class ReportsController extends Controller
{
	public function __construct($model, $action)
	{
		parent::__construct($model, $action);
		$this->_setModel($model);
		
		if(!isset($_SESSION['user_details'][0]['id']) || $_SESSION['user_details'][0]['role_id']!=1)
		{
			header("Location:".BASE_FRONTEND_URL."login/index/");
		}		
	}
		
	public function index()
	{
		$this->_setView("index");	
		$allUsers = array();
		$allUsers = $this->_model->getAllUsers();
		$this->_view->set('allUsers', $allUsers);
		
		$allEstablishments = array();
		$allEstablishments = $this->_model->getAllEstablishments();
		$this->_view->set('allEstablishments', $allEstablishments);
				
        return $this->_view->output();
	}	
	
	public function comingsoon()
	{
       $this->_setView("coming_soon");
	   return $this->_view->output();		
	}
	
}