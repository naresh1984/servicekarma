<?php
class ServicehoursController extends Controller
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
		$select_establishment = '';
		if(isset($_REQUEST['select_establishment']))
		{
			$select_establishment = $_REQUEST['select_establishment'];
		}
		$allUsers = array();
		$allUsers = $this->_model->getAllUsers($select_establishment);
		$this->_view->set('allUsers', $allUsers);
		
		$allEstablishments = array();
		$allEstablishments = $this->_model->getAllEstablishments();
		$this->_view->set('allEstablishments', $allEstablishments);
		
        return $this->_view->output();
	}	

	public function add()
	{
		if(@$_REQUEST['ajaxcheck']==1)
		{
			 $ajax_error = ''; 		    
			 echo $ajax_error;				 	
		}			
		else if(trim(@$_REQUEST['organization_event'])!='')
		{	
			$picture="";
			$filename = date("m-d-Yhms");
			if(move_uploaded_file(@$_FILES["file"]["tmp_name"],"../student/upload/" .$filename. $_FILES["file"]["name"]))
             	$picture = "upload/" .$filename. $_FILES["file"]["name"];
			 
			$organization_event = @$_REQUEST['organization_event'];
			$hours_volunteered = @$_REQUEST['hours_volunteered'];
			$minutes_volunteered = @$_REQUEST['minutes_volunteered'];
			$from_date = mysql_real_escape_string(date("Y-m-d", strtotime(@$_REQUEST['from_date'])));
			$to_date = mysql_real_escape_string(date("Y-m-d", strtotime(@$_REQUEST['to_date'])));
			$hours_volunteered = @$_REQUEST['hours_volunteered'];
			$minutes_volunteered = @$_REQUEST['minutes_volunteered'];
			$email = @$_REQUEST['email'];
			$address = @$_REQUEST['address'];
			$state = @$_REQUEST['state'];
			$city = @$_REQUEST['city'];
			$zipcode = @$_REQUEST['zipcode'];
			$phone = @$_REQUEST['phone_1'].'-'.@$_REQUEST['phone_2'].'-'.@$_REQUEST['phone_3'];	
			$comments = @$_REQUEST['comments'];			
			$user_id = $_SESSION['user_details'][0]['id'];	
				
			$servicehour_insert = $this->_model->insertServicehour($organization_event,$hours_volunteered, $minutes_volunteered, $from_date, $to_date, $email,$address, $state, $city, $zipcode, $phone, $picture, $comments, $user_id);			
			header("Location:".BASE_FRONTEND_URL."/contributions/");
			
		}else{
			
		$this->_setView("add_servicehours");
		$allStates = array();
		$allStates = $this->_model->getAllStates();
		$this->_view->set('allStates', $allStates);
				
        return $this->_view->output();
		}
	}
	
	public function comingsoon()
	{
       $this->_setView("coming_soon");
	   return $this->_view->output();		
	}

}