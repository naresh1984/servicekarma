<?php
class UpcomingeventsController extends Controller
{
	public function __construct($model, $action)
	{
		parent::__construct($model, $action);
		$this->_setModel($model);
		
		if(!$_SESSION['user_details'][0]['role_id'])
		{
			header("Location:".BASE_FRONTEND_URL."login/index/redirect=".$_REQUEST['load']);
		}		
	}
		
	public function index()
	{
		$this->_setView("index");
		$upcomingevent_details = array();
		$upcomingevent_details = $this->_model->upcomingevents($_SESSION['user_details'][0]['establishment_id']);
		$this->_view->set('upcomingevent_details', $upcomingevent_details);
		return $this->_view->output();
	}	
	
}