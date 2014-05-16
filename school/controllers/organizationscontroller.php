<?php
class OrganizationsController extends Controller
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
		$allOrganizations = array();
		$allOrganizations = $this->_model->getAllOrganizations($establishment_id);
		$this->_view->set('allOrganizations', $allOrganizations);
		
        return $this->_view->output();
	}	

	public function add()
	{
		if(@$_REQUEST['ajaxcheck']==1)
		{
			$ajax_error = '';
			$establishment_id = $_SESSION['user_details'][0]['establishment_id'];	
			$organization_name = $_REQUEST['organization_name'];
		    $organization_check = $this->_model->checkOrganization($organization_name,$establishment_id);			
			if(count($organization_check) > 0)
			 $ajax_error = 1; 
		    if($ajax_error == 1)
			 echo $ajax_error;

		
		}else if(!isset($_REQUEST['ajaxcheck']) && trim(@$_REQUEST['organization_name'])!='')
		{	
		
/*			echo "<pre>";
			print_r($_REQUEST);
			exit();*/			
			 
			$organization_name = @$_REQUEST['organization_name'];				
			$email = @$_REQUEST['email'];			
			$city = @$_REQUEST['city'];
			$phone = @$_REQUEST['phone_1'].'-'.@$_REQUEST['phone_2'].'-'.@$_REQUEST['phone_3'];
			$address = @$_REQUEST['address'];			
			$state = @$_REQUEST['state'];
			$zipcode = @$_REQUEST['zipcode'];	
			$website = @$_REQUEST['website'];
			$status = @$_REQUEST['status'];	
			$user_id = $_SESSION['user_details'][0]['id'];	
			$establishment_id = $_SESSION['user_details'][0]['establishment_id'];			
			$organization_insert = $this->_model->insertOrganization($organization_name,$email,$establishment_id,$city,$phone,$address,$state,$zipcode,$website,$user_id,$status);
			header("Location:".BASE_FRONTEND_URL."organizations/");
			
		}else{
			
		$this->_setView("add_organization");
		$allStates = array();
		$allStates = $this->_model->getAllStates();
		$this->_view->set('allStates', $allStates);
		
        return $this->_view->output();
		}
	}
	
	public function editOrganization()
	{

		@$string = explode('/', $_GET['load']);		
	    @$id = @$string[2];		
		
		if(@$_REQUEST['ajaxcheck']==1)
		{
			$ajax_error = '';
			$organization_name = $_REQUEST['organization_name'];
			$id = $_REQUEST['id'];	
			$establishment_id = $_SESSION['user_details'][0]['establishment_id'];	
			$organization_check = $this->_model->EditcheckOrganization($organization_name,$id,$establishment_id );		
			if(count($organization_check) > 0)
			 $ajax_error = 1; 
		    if($ajax_error == 1)
			 echo $ajax_error;

		
		}else if(!isset($_REQUEST['ajaxcheck']) && trim(@$_REQUEST['organization_name'])!='')
		{				
/*			echo "<pre>";
			print_r($_REQUEST);
			exit();*/
			
			$organization_name = @$_REQUEST['organization_name'];			
			$email = @$_REQUEST['email'];			
			$city = @$_REQUEST['city'];
			$phone = @$_REQUEST['phone_1'].'-'.@$_REQUEST['phone_2'].'-'.@$_REQUEST['phone_3'];
			$address = @$_REQUEST['address'];			
			$state = @$_REQUEST['state'];
			$zipcode = @$_REQUEST['zipcode'];
			$website = @$_REQUEST['website'];			
			$user_id = $_SESSION['user_details'][0]['id'];
			$establishment_id = $_SESSION['user_details'][0]['establishment_id'];	
			$profile_id = @$_REQUEST['profile_id'];
			$id = @$_REQUEST['id'];
			$status = @$_REQUEST['status'];	
			$organization_edit = $this->_model->editOrganization($organization_name,$email,$establishment_id,$city,$phone,$address,$state,$zipcode,$website,$user_id,$id,$profile_id,$status);		
			header("Location:".BASE_FRONTEND_URL."organizations/");
			
		}else{
			
		$this->_setView("add_organization");
		$allStates = array();
		$allStates = $this->_model->getAllStates();
		$this->_view->set('allStates', $allStates);
	
		$organizationDetails = $this->_model->getRowOrganization($id);	
		$this->_view->set('organizationDetails', $organizationDetails);
		$allCities = array();
		$allCities = $this->_model->getCities($organizationDetails[0]['state_id']);	
		$this->_view->set('allCities', $allCities);
        return $this->_view->output();
		}
	}
	
	public function getcitiesorganizations()
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
	
	public function comingsoon()
	{
       $this->_setView("coming_soon");
	   return $this->_view->output();		
	}

}