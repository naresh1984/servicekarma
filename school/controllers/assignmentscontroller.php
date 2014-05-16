<?php
class AssignmentsController extends Controller
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
		$allPendingAssignments = array();
		$allPendingAssignments = $this->_model->getAllPendingAssignments($establishment_id);
		$this->_view->set('allPendingAssignments', $allPendingAssignments);
		
        return $this->_view->output();
	}	
	
	public function viewAssignment()
	{
		@$string = explode('/', $_GET['load']);		
	    @$id = @$string[2];		
		
		if(@$_REQUEST['ajaxcheck']==1)
		{
			$id = $_REQUEST['id'];	
			$ajax_error = ''; 		    
			echo $ajax_error;	
		
		}else if(!isset($_REQUEST['ajaxcheck']) && trim(@$_REQUEST['service_hours_id'])!='')
		{					
			header("Location:".BASE_FRONTEND_URL."assignments/");
			
		}else{
						
		$this->_setView("approve_assignment");
		$assignmentDetails = array();
		$assignmentDetails = $this->_model->getRowAssignment($id);	
		$this->_view->set('assignmentDetails', $assignmentDetails);
        return $this->_view->output();
		}
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
				if(@$_REQUEST['approve_status'] == "rejectemail")
				{
					$assignmentDetails = $this->_model->getRowAssignment(@$_REQUEST['servicehour_id']);
					$assignmentDetails[0]['rejected_reason'] = @$_REQUEST['rejected_reason'];
					$this->_mail->setFrom("info@servicekarma.com");
					$this->_mail->addTo($assignmentDetails[0]['email'],$assignmentDetails[0]['firstname']." ".$assignmentDetails[0]['lastname']);				
					$this->_mail->setSubject('Servicekarma - Service hours rejected');	
					$this->_mail->getParams($assignmentDetails[0]);		
					$this->_mail->sendRejectEmail();
				}
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