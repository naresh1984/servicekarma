<?php
class LoginController extends Controller
{
	
	public $redirectUrl;

	public function __construct($model, $action)
	{
		parent::__construct($model, $action);
		$this->_setModel($model);

		if(isset($_REQUEST['load'])){
		  $redirect = explode("=",$_REQUEST['load']);
		  if(isset($redirect[1]) && $redirect[1]!=""){
			  $this->redirectUrl = $redirect[1];
		  }
		}
	}
		
	public function index()
	{
		if(isset($_SESSION['user_details'][0]['id']))
		{
		  header('Location: '. BASE_FRONTEND_URL . 'employees/appliedLeaves');
		}
		$this->_view->set('title', 'Admin - Login');
		$this->_view->set('redirect_url', $this->redirectUrl);
		return $this->_view->output();
	}
	
	public function checklogin()
	{
		if(!isset($_POST['loginSubmit']))
		{
		  header('Location: '. BASE_FRONTEND_URL . 'login/index');
		}
		
		$errors = array();
		$check = true;
		
		$isLogged = false;
		
		$userName = isset($_POST['username']) ? trim($_POST['username']) : "";
		$password = isset($_POST['password']) ? trim($_POST['password']) : "";
		
		if(empty($userName))
		{
		  $check = false;
		  array_push($errors, "Enter Username.");
		}
		
		if(empty($password))
		{
		  $check = false;
		  array_push($errors, "Enter Password.");
		}	
		
		if(!$check)
		{
		  $this->_setView("index");
		  $this->_view->set("title", "Invalid form data");
		  $this->_view->set('errors', $errors);
		  return $this->_view->output();
		}
		
		try {
		  $this->_model->setUserName($userName);
		  $this->_model->setPassword($password);
		  
		  $emplyId = $this->_model->getLogin();
		  if($emplyId){
			  $isLogged = true;
			  $_SESSION['employ']= $emplyId;
			  $_SESSION['roles'][]= @$emplyId[0]['roleid'];
			  $_SESSION['roles'][]= @$emplyId[1]['roleid'];
			  $_SESSION['roles'][]= @$emplyId[2]['roleid'];
			  
			  $this->redirectUrl = 'employees/appliedLeaves';
			  $url = explode('=',$_REQUEST['load']);
			  if(isset($url[1])){
				  $this->redirectUrl = $url[1];
			  }
			  
			  header('Location: '. BASE_FRONTEND_URL . $this->redirectUrl);
			  
		  }else{
			  $isLogged = false;
			  $this->_setView("index");
			  array_push($errors, "The combination of Username/Password is incorrect.");
			  $this->_view->set('errors', $errors);
			  $this->_view->set('title', 'Login Failed.');							
		  }
		  
		}catch(Exception $e){
		  $this->_setView("index");
		  $this->_view->set('title', 'There was an error login!');
		  $this->_view->set('saveError', $e->getMessage());
		}
		
		return $this->_view->output();		
	}
	
	public function changePassword()
	{    
       
		if(!isset($_SESSION['user_details'][0]['id']))
		{
			header("Location:".BASE_FRONTEND_URL."login/index/redirect=".$_REQUEST['load']);
		}		  
		
	    if(isset($_REQUEST['submit']) && @$_REQUEST['submit']!=''){
		
		 if(md5(@$_REQUEST['oldpwd'])!=$_SESSION['employ']['0']['password']){
		  $this->_view->set('oldpwd_error', 'Old password is incorrect.');
		 }
		 if($_REQUEST['newpwd']!=$_REQUEST['repwd']){
		  $this->_view->set('newpwd_error', 'Enter New Password and Re-Enter New Password.');
		 }
	   if(@md5($_REQUEST['oldpwd'])==$_SESSION['employ']['0']['password'] && $_REQUEST['newpwd']==$_REQUEST['repwd']){   
		
	    $emplyId = $this->_model->updatePwd();
		
		$this->_view->set('msg', 'Password updated successfully');
		$this->_view->set('title', 'Employee - Change Password');
		$this->_view->set('page', 'cp');
		
		
		header("Location:".BASE_FRONTEND_URL."login/pwdSuccess");
		
		}
	   
		}
		$this->_view->set('oldpwd', @$_REQUEST['oldpwd']);
		$this->_view->set('newpwd', @$_REQUEST['newpwd']);
		$this->_view->set('repwd', @$_REQUEST['repwd']);
		$this->_view->set('title', 'Employee - Change Password');
		$this->_view->set('page', 'cp');
		return $this->_view->output();		
	}
	
	public function pwdsuccess(){
	    
		$this->_view->set('msg', 'Password updated successfully'); 
	    $this->_view->set('title', 'Employee - Update Password');
		$this->_view->set('page', 'cp');
		return $this->_view->output();
		
	}
	public function logout()
	{
		session_destroy();
		header('Location: '. BASE_FRONTEND_URL . 'login/index');
	}
}