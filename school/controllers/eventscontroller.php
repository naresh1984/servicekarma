<?php
class EventsController extends Controller
{
	public function __construct($model, $action)
	{
		parent::__construct($model, $action);
		$this->_setModel($model);
		
		if(!isset($_SESSION['user_details'][0]['id']) && $_SESSION['user_details'][0]['id']!=1)
		{
			header("Location:".BASE_FRONTEND_URL."assignments/index/redirect=".$_REQUEST['load']);
		}		
	}
		
	public function index()
	{
		$this->_setView("index");
		$establishment_id = $_SESSION['user_details'][0]['establishment_id'];		
		$allEvents = array();
		$allEvents = $this->_model->getAllEvents($establishment_id);
		$this->_view->set('allEvents', $allEvents);
		
        return $this->_view->output();
	}	

	public function add()
	{
		if(@$_REQUEST['ajaxcheck']==1)
		{
			$ajax_error = '';
			$establishment_id = $_SESSION['user_details'][0]['establishment_id'];	
			$event_title = $_REQUEST['event_title'];
		    $event_check = $this->_model->checkEvent($event_title,$establishment_id);			
			if(count($event_check) > 0)
			 $ajax_error = 1; 
		    if($ajax_error == 1)
			 echo $ajax_error;

		
		}else if(!isset($_REQUEST['ajaxcheck']) && trim(@$_REQUEST['event_title'])!='')
		{	
		
/*			echo "<pre>";
			print_r($_REQUEST);
			exit();*/			
			 
			$event_title = @$_REQUEST['event_title'];	
			$category_id = 	@$_REQUEST['category'];	
			$other_category_name = 	@$_REQUEST['other_category_name'];	
			$organization_id = 	@$_REQUEST['organization'];	
			$other_organization_name = 	@$_REQUEST['other_organization_name'];			
			$email = @$_REQUEST['email'];
			$from_date = mysql_real_escape_string(date("Y-m-d", strtotime(@$_REQUEST['from_date'])));
			$to_date = mysql_real_escape_string(date("Y-m-d", strtotime(@$_REQUEST['to_date'])));
			$start_time = @$_REQUEST['start_hour']." ".@$_REQUEST['start_minute']." ".@$_REQUEST['start_am_pm'];
			$end_time = @$_REQUEST['end_hour']." ".@$_REQUEST['end_minute']." ".@$_REQUEST['end_am_pm'];			
			$city = @$_REQUEST['city'];
			$phone = @$_REQUEST['phone_1'].'-'.@$_REQUEST['phone_2'].'-'.@$_REQUEST['phone_3'];
			$address = @$_REQUEST['address'];			
			$state = @$_REQUEST['state'];
			$zipcode = @$_REQUEST['zipcode'];	
			$website = @$_REQUEST['website'];
			$volunteer_capacity = @$_REQUEST['volunteer_capacity'];
			$description = @$_REQUEST['description'];
			if(isset($_REQUEST['is_proof_required']))
			{
				if($_REQUEST['is_proof_required']==1)
				{
					$is_proof_required = 1;
				}
			}
			else
			{
					$is_proof_required = 0;
			}	
			$status = @$_REQUEST['status'];	
			$user_id = $_SESSION['user_details'][0]['id'];	
			$establishment_id = $_SESSION['user_details'][0]['establishment_id'];			
			$event_insert = $this->_model->insertEvent($event_title,$category_id,$other_category_name,$organization_id,$other_organization_name,$email,$from_date,$to_date,$start_time,$end_time,$establishment_id,$city,$phone,$address,$state,$zipcode,$website,$volunteer_capacity,$description,$is_proof_required,$user_id,$status);
			header("Location:".BASE_FRONTEND_URL."events/");
			
		}else{
			
		$this->_setView("add_event");
		$allStates = array();
		$allStates = $this->_model->getAllStates();
		$this->_view->set('allStates', $allStates);
		
		$establishment_id = $_SESSION['user_details'][0]['establishment_id'];		
		
		$allCategories = array();
		$allCategories = $this->_model->getAllCategories($establishment_id);
		$this->_view->set('allCategories', $allCategories);		
		
		$allOrganizations = array();
		$allOrganizations = $this->_model->getAllOrganizations($establishment_id);
		$this->_view->set('allOrganizations', $allOrganizations);
		
        return $this->_view->output();
		}
	}
	
	public function editEvent()
	{

		@$string = explode('/', $_GET['load']);		
	    @$id = @$string[2];		
		
		if(@$_REQUEST['ajaxcheck']==1)
		{
			$ajax_error = '';
			$event_title = $_REQUEST['event_title'];
			$id = $_REQUEST['id'];	
			$establishment_id = $_SESSION['user_details'][0]['establishment_id'];	
			$event_check = $this->_model->EditcheckEvent($event_title,$id,$establishment_id );		
			if(count($event_check) > 0)
			 $ajax_error = 1; 
		    if($ajax_error == 1)
			 echo $ajax_error;

		
		}else if(!isset($_REQUEST['ajaxcheck']) && trim(@$_REQUEST['event_title'])!='')
		{				
/*			echo "<pre>";
			print_r($_REQUEST);
			exit();*/
			
			$event_title = @$_REQUEST['event_title'];
			$category_id = 	@$_REQUEST['category'];	
			$other_category_name = 	@$_REQUEST['other_category_name'];	
			$organization_id = 	@$_REQUEST['organization'];	
			$other_organization_name = 	@$_REQUEST['other_organization_name'];				
			$email = @$_REQUEST['email'];			
			$from_date = mysql_real_escape_string(date("Y-m-d", strtotime(@$_REQUEST['from_date'])));
			$to_date = mysql_real_escape_string(date("Y-m-d", strtotime(@$_REQUEST['to_date'])));
			$start_time = @$_REQUEST['start_hour']." ".@$_REQUEST['start_minute']." ".@$_REQUEST['start_am_pm'];
			$end_time = @$_REQUEST['end_hour']." ".@$_REQUEST['end_minute']." ".@$_REQUEST['end_am_pm'];				
			$city = @$_REQUEST['city'];
			$phone = @$_REQUEST['phone_1'].'-'.@$_REQUEST['phone_2'].'-'.@$_REQUEST['phone_3'];
			$address = @$_REQUEST['address'];			
			$state = @$_REQUEST['state'];
			$zipcode = @$_REQUEST['zipcode'];
			$website = @$_REQUEST['website'];
			$volunteer_capacity = @$_REQUEST['volunteer_capacity'];		
			$description = @$_REQUEST['description'];
			if(isset($_REQUEST['is_proof_required']))
			{
				if($_REQUEST['is_proof_required']==1)
				{
					$is_proof_required = "Yes";
				}
			}
			else
			{
					$is_proof_required = "No";
			}				
			$user_id = $_SESSION['user_details'][0]['id'];
			$establishment_id = $_SESSION['user_details'][0]['establishment_id'];	
			$profile_id = @$_REQUEST['profile_id'];
			$id = @$_REQUEST['id'];
			$status = @$_REQUEST['status'];	
			$event_edit = $this->_model->editEvent($event_title,$category_id,$other_category_name,$organization_id,$other_organization_name,$email,$from_date,$to_date,$start_time,$end_time,$establishment_id,$city,$phone,$address,$state,$zipcode,$website,$volunteer_capacity,$description,$is_proof_required,$user_id,$status,$id,$profile_id);		
			header("Location:".BASE_FRONTEND_URL."events/");
			
		}else{
			
		$this->_setView("add_event");
		$allStates = array();
		$allStates = $this->_model->getAllStates();
		$this->_view->set('allStates', $allStates);
	
		$eventDetails = $this->_model->getRowEvent($id);	
		$this->_view->set('eventDetails', $eventDetails);
		$allCities = array();
		$allCities = $this->_model->getCities($eventDetails[0]['state_id']);	
		$this->_view->set('allCities', $allCities);
		
		$establishment_id = $_SESSION['user_details'][0]['establishment_id'];		
		
		$allCategories = array();
		$allCategories = $this->_model->getAllCategories($establishment_id);
		$this->_view->set('allCategories', $allCategories);		
		
		$allOrganizations = array();
		$allOrganizations = $this->_model->getAllOrganizations($establishment_id);
		$this->_view->set('allOrganizations', $allOrganizations);
		
        return $this->_view->output();
		}
	}
	
	public function getcitiesevents()
	{
       	
		$state_id = $_REQUEST['state_id'];
		$city_id = @$_REQUEST['city_id'];
		$this->_setView("ajax_cities");
		$Cities = array();
		$Cities = $this->_model->getCities($state_id);
		$this->_view->set('Cities', $Cities);
		$this->_view->set('city_id', $city_id);
        return $this->_view->output();		
	}	
	
	public function orgdetails()
	{       	
		$org_id = $_REQUEST['org_id'];		
		$this->_setView("add_event");
		$orgDetails = array();
		$orgDetails = $this->_model->getRowOrganization($org_id);			
        //return $orgDetails;	
		//print_r($orgDetails);		
		echo json_encode(array('result'=>$orgDetails[0]));	
	}	
	
	public function comingsoon()
	{
       $this->_setView("coming_soon");
	   return $this->_view->output();		
	}

}