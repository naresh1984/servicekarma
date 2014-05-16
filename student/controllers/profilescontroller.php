<?php
class ProfilesController extends Controller
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
		$user_id = $_SESSION['user_details'][0]['id'];		
		$this->_setView("profile");
		$profile_details = array();
		$profile_details = $this->_model->profileinfo($user_id);
		$this->_view->set('profile', $profile_details);
        return $this->_view->output();	
	}	
	public function editProfile()
	{
       	
		$user_id = $_SESSION['user_details'][0]['id'];	
		if(@$_REQUEST['firstname']!='' && @$_REQUEST['email']!=''){
			
			$logo="";
			$fname = $user_id.'_'.date("m-d-Yhms");
			if(move_uploaded_file(@$_FILES["file"]["tmp_name"],"upload/" .$fname. $_FILES["file"]["name"])){
            $logo = "upload/" .$fname. $_FILES["file"]["name"];
			if(@$_REQUEST['image_url']!='')
			  unlink($_REQUEST['image_url']);
			}
			
			$firstname=$_REQUEST['firstname'];
			$lastname=$_REQUEST['lastname'];
			$address=$_REQUEST['address'];
			$city=$_REQUEST['city'];
			$state=$_REQUEST['state'];
			$zipcode=$_REQUEST['zipcode'];
			$phone=$_REQUEST['phone_1'].'-'.$_REQUEST['phone_2'].'-'.$_REQUEST['phone_3'];
			$profile_id=$_REQUEST['profile_id'];
			$this->_model->editProfile($firstname,$lastname,$address,$city,$state,$zipcode,$phone,$logo,$profile_id,$user_id);
			if(@$_REQUEST['nav_url']!=''){
				header("Location:".$_REQUEST['nav_url']);
			}else{			
				header("Location:".BASE_FRONTEND_URL."establishments/");
			}
		}else{	
			$this->_setView("editProfile");
			$profile_details = array();
			$profile_details = $this->_model->profileinfo($user_id);
			$this->_view->set('profile', $profile_details);
			
			$allCities = array();
			$allCities = $this->_model->getCities($profile_details[0]['state_id']);	
			$this->_view->set('allCities', $allCities);
			$allStates = array();
			$allStates = $this->_model->getAllStates();	
			$this->_view->set('allStates', $allStates);
			return $this->_view->output();		
		}
	}
	
	public function getcities()
	{
       	
		$state_id = $_REQUEST['state_id'];
		$city_id = @$_REQUEST['city_id'];
		$this->_setView("ajax_cities");
		$Cities = array();
		$Cities = $this->_model->getCities($state_id);
		$this->_view->set('city_id', $city_id);
		$this->_view->set('Cities', $Cities);
        return $this->_view->output();		
	}
	public function changepassword()
	{
       
	   if(@$_REQUEST['ajaxcheck']==1)
	   {
		   $old_pwd = @$_REQUEST['old_pwd'];
		   $user_id = $_SESSION['user_details'][0]['id'];	
		   $check_pwd = $this->_model->check_oldpwd($user_id,$old_pwd);
		   $ajax_error = array();
		   if(count($check_pwd) == 0)
			 $ajax_error[] = 1;
		   if(count($ajax_error) > 0)
			 echo implode(',',$ajax_error);	 
	   }
	   else if(trim(@$_REQUEST['old_pwd'])!='' && trim(@$_REQUEST['new_pwd'])!=''){
	       $old_pwd = @$_REQUEST['old_pwd'];
		   $new_pwd = @$_REQUEST['new_pwd'];
		   $user_id = $_SESSION['user_details'][0]['id'];	
		   $this->_model->change_password($user_id,$old_pwd,$new_pwd);
		   if(@$_REQUEST['nav_url']!=''){
				header("Location:".$_REQUEST['nav_url']);
			}else{			
				header("Location:".BASE_FRONTEND_URL."users/");
			}
	   }
	   else{
	   		$this->_setView("changepassword");
	   		return $this->_view->output();	
	   }
	}
}