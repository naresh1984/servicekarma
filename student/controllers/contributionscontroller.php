<?php
class ContributionsController extends Controller
{
	public function __construct($model, $action)
	{
		parent::__construct($model, $action);
		$this->_setModel($model);
		
		if(!isset($_SESSION['user_details'][0]['id']) || $_SESSION['user_details'][0]['role_id']!=3)
		{
			header("Location:".BASE_URL."login/index/");
		}		
	}
		
	public function index()
	{
		$this->_setView("index");		
		$user_id = $_SESSION['user_details'][0]['id'];
		$establishment_id = $_SESSION['user_details'][0]['establishment_id'];	
		
		$allPendingServiceRecords = array();
		$allPendingServiceRecords = $this->_model->getAllServiceRecords($user_id, "Pending");
		$this->_view->set('allPendingServiceRecords', $allPendingServiceRecords);
		
		$allApprovedServiceRecords = array();
		$allApprovedServiceRecords = $this->_model->getAllServiceRecords($user_id, "Approved");
		$this->_view->set('allApprovedServiceRecords', $allApprovedServiceRecords);
		
		$allRejectedServiceRecords = array();
		$allRejectedServiceRecords = $this->_model->getAllServiceRecords($user_id, "Rejected");
		$this->_view->set('allRejectedServiceRecords', $allRejectedServiceRecords);
		
		$allServiceRecordsHours = array();
		$allServiceRecordsHours = $this->_model->getAllServiceRecordsHours($user_id);
		$this->_view->set('allServiceRecordsHours', $allServiceRecordsHours);
		
        return $this->_view->output();
	}

}