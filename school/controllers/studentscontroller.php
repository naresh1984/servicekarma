<?php
class StudentsController extends Controller
{
	public function __construct($model, $action)
	{
		parent::__construct($model, $action);
		$this->_setModel($model);
		
		if(!isset($_SESSION['user_details'][0]['id']) && $_SESSION['user_details'][0]['id']!=1)
		{
			header("Location:".BASE_FRONTEND_URL."establishments/index/redirect=".$_REQUEST['load']);
		}		
	}
		
	public function index()
	{
		$this->_setView("index");		
		$select_establishment = $_SESSION['user_details'][0]['establishment_id']; 
		
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
			$email = $_REQUEST['email'];
		    $email_check = $this->_model->checkEmail($email);			
			if(count($email_check) > 0)
			 $ajax_error = 1; 
		    if($ajax_error == 1)
			 echo $ajax_error;

		
		}else if(!isset($_REQUEST['ajaxcheck']) && trim(@$_REQUEST['email'])!='')
		{			

			if(isset($_REQUEST['random_password']))
			{
				if($_REQUEST['random_password']==1)
				{
					$password = $this->_model->generateRandomString(6);
				}
			}
			else
			{
					$password = @$_REQUEST['password'];
			}			
/*			echo "password:".$password;
			echo "<pre>";
			print_r($_REQUEST);
			exit();*/
			$picture="";
			$filename = date("m-d-Yhms");
			if(move_uploaded_file(@$_FILES["file"]["tmp_name"],"../student/upload/" .$filename. $_FILES["file"]["name"]))
             	$picture = "upload/" .$filename. $_FILES["file"]["name"];
			 
			$first_name = @$_REQUEST['first_name'];
			$last_name = @$_REQUEST['last_name'];			
			$email = @$_REQUEST['email'];
			$establishment_id = $_SESSION['user_details'][0]['establishment_id'];
			$city = @$_REQUEST['city'];
			$phone = @$_REQUEST['phone_1'].'-'.@$_REQUEST['phone_2'].'-'.@$_REQUEST['phone_3'];
			$address = @$_REQUEST['address'];			
			$state = @$_REQUEST['state'];
			$zipcode = @$_REQUEST['zipcode'];	
			$status = @$_REQUEST['status'];	
			$user_id = $_SESSION['user_details'][0]['id'];
			$status = @$_REQUEST['status'];	
			$status = @$_REQUEST['status'];	
			$student_id = @$_REQUEST['student_id'];	
			$graduation_year = @$_REQUEST['graduation_year'];
						
			
			$user_insert = $this->_model->insertUser($first_name,$last_name,$email,$establishment_id,$city,$phone,$address,$state,$zipcode,$picture,$user_id,$status, $password,$student_id,$graduation_year);
			
			$params = array();
			$params['username'] = $email;
			$params['password'] = $password;				
			$this->_mail->setFrom("info@servicekarma.com");
			$this->_mail->addTo($email,$first_name." ".$last_name);				
			$this->_mail->setSubject('Servicekarma Login Details');	
			$this->_mail->getParams($params);		
			$this->_mail->send();	
			
			header("Location:".BASE_FRONTEND_URL."students/");
			
		}else{
			
		$this->_setView("add_user");
		$allStates = array();
		$allStates = $this->_model->getAllStates();
		$this->_view->set('allStates', $allStates);
		
		$establishmentDetails = array();
		$establishmentDetails = $this->_model->getRowEstablishment($_SESSION['user_details'][0]['establishment_id']);
		$this->_view->set('establishmentDetails', $establishmentDetails);
		
        return $this->_view->output();
		}
	}
	
	public function editUser()
	{

		@$string = explode('/', $_GET['load']);		
	    @$id = @$string[2];		
		
		if(@$_REQUEST['ajaxcheck']==1)
		{
			$ajax_error = '';
			$email = $_REQUEST['email'];
			$id = $_REQUEST['id'];	
			$email_check = $this->_model->EditcheckEmail($email,$id);		
			if(count($email_check) > 0)
			 $ajax_error = 1; 
		    if($ajax_error == 1)
			 echo $ajax_error;

		
		}else if(!isset($_REQUEST['ajaxcheck']) && trim(@$_REQUEST['email'])!='')
		{			

/*			if(@$_REQUEST['image_url']!='')
		    	unlink($_REQUEST['image_url']);	*/
			$password = '';	
			if(trim(@$_REQUEST['password'])!='')
			{
				$password = @$_REQUEST['password'];
			}
			
/*			echo "password:".$password;
			echo "<pre>";
			print_r($_REQUEST);
			exit();*/
						
			$picture="";
			$filename = date("m-d-Yhms");
			if(move_uploaded_file(@$_FILES["file"]["tmp_name"],"../student/upload/" .$filename. $_FILES["file"]["name"]))
            $picture = "upload/" .$filename. $_FILES["file"]["name"];
			
			$first_name = @$_REQUEST['first_name'];
			$last_name = @$_REQUEST['last_name'];			
			$email = @$_REQUEST['email'];
			$establishment_id = $_SESSION['user_details'][0]['establishment_id'];
			$city = @$_REQUEST['city'];
			$phone = @$_REQUEST['phone_1'].'-'.@$_REQUEST['phone_2'].'-'.@$_REQUEST['phone_3'];
			$address = @$_REQUEST['address'];			
			$state = @$_REQUEST['state'];
			$zipcode = @$_REQUEST['zipcode'];			
			$user_id = $_SESSION['user_details'][0]['id'];
			$profile_id = @$_REQUEST['profile_id'];
			$id = @$_REQUEST['id'];
			$status = @$_REQUEST['status'];	
			
			$student_id = @$_REQUEST['student_id'];	
			$graduation_year = @$_REQUEST['graduation_year'];						
			$created_date = @$_REQUEST['created_date'];
			$user_insert = $this->_model->editUser($first_name,$last_name,$email,$establishment_id,$city,$phone,$address,$state,$zipcode,$picture,$user_id,$id,$profile_id,$status,$password,$student_id,$graduation_year,$created_date);
			
			if($password!='')
			{
				$params = array();
				$params['username'] = $email;
				$params['password'] = $password;				
				$this->_mail->setFrom("info@servicekarma.com");
				$this->_mail->addTo($email,$first_name." ".$last_name);				
				$this->_mail->setSubject('Servicekarma Login Details');	
				$this->_mail->getParams($params);		
				$this->_mail->send();
			}
			
			header("Location:".BASE_FRONTEND_URL."students/");
			
		}else{
			
		$this->_setView("add_user");
		$allStates = array();
		$allStates = $this->_model->getAllStates();
		$this->_view->set('allStates', $allStates);
		
			
		$userDetails = $this->_model->getRowUser($id);	
		$this->_view->set('userDetails', $userDetails);
		$allCities = array();
		$allCities = $this->_model->getCities($userDetails[0]['state_id']);	
		$this->_view->set('allCities', $allCities);
        return $this->_view->output();
		}
	}
	
	public function getcitiesusers()
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
	
	public function getestablishmentusers()	{
       	
		$establishment_id = $_REQUEST['establishment_id'];
		$this->_setView("ajax_users");
		$allUsers = array();
		$allUsers = $this->_model->getAllUsers($establishment_id);
		$this->_view->set('allUsers', $allUsers);
        return $this->_view->output();		
	}
	public function comingsoon()
	{
       $this->_setView("coming_soon");
	   return $this->_view->output();		
	}
	public function deleteuser()
	{
		$userids = $_REQUEST['sid'];
		$this->_model->deleteUsers($userids);
		return true;
			
	}
	

}