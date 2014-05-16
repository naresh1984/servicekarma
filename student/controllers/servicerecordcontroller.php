<?php
class ServicerecordController extends Controller
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
		$allServiceRecords = array();
		$allServiceRecords = $this->_model->getAllServiceRecords($user_id);
		$this->_view->set('allServiceRecords', $allServiceRecords);
		
		$allServiceRecordsHours = array();
		$allServiceRecordsHours = $this->_model->getAllServiceRecordsHours($user_id);
		$this->_view->set('allServiceRecordsHours', $allServiceRecordsHours);
		
        return $this->_view->output();
	}	
	
	public function viewServicerecord()
	{						
		@$string = explode('/', $_GET['load']);		
	    @$id = @$string[2];	
		$this->_setView("view_servicerecord");	
		$servicerecordDetails = array();			
        $servicerecordDetails = $this->_model->getRowServicerecord($id);	
		$this->_view->set('servicerecordDetails', $servicerecordDetails);
        return $this->_view->output();	
	}
	
	public function approve()
	{		
		if(@$_REQUEST['ajaxcheck']==1 && @$_REQUEST['approve_status']!="")
		{
			$ajax_error = '';
			$rejected_reason = '';
			if(@$_REQUEST['rejected_reason']!="")
			{
				$rejected_reason = @$_REQUEST['rejected_reason'];
			}
			if(@$_REQUEST['approve_status'] == "reject" || @$_REQUEST['approve_status'] == "rejectemail")
			{
				if(@$_REQUEST['rejected_reason']=="")
				{
					$ajax_error = 2;
				}
			}
			
			$user_id = $_SESSION['user_details'][0]['id'];
			
/*			 echo "<pre>";
			 print_r($_REQUEST);*/
			
			if(@$_REQUEST['approve_status'] == "approve" || @$_REQUEST['approve_status'] == "reject" || @$_REQUEST['approve_status'] == "rejectemail")
			{
				$approve_reject_assignment = $this->_model->approveRejectAssignment(@$_REQUEST['servicehour_id'], @$_REQUEST['approve_status'], $rejected_reason, $user_id);
			}
			else
			{
				$ajax_error = 1;
			}
			if($ajax_error != '')
			 	echo $ajax_error;	
			
/*			$ajax_error = '';
			$organization_name = $_REQUEST['organization_name'];
			$id = $_REQUEST['id'];	
			$establishment_id = $_SESSION['user_details'][0]['establishment_id'];	
			$organization_check = $this->_model->EditcheckOrganization($organization_name,$id,$establishment_id );		
			if(count($organization_check) > 0)
			 $ajax_error = 1; 
		    if($ajax_error == 1)
			 echo $ajax_error;	*/
		}		
		
		
	}
	
	public function comingsoon()
	{
       $this->_setView("coming_soon");
	   return $this->_view->output();		
	}

}