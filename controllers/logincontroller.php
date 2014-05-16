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
		  
			
			if(@$_SESSION['user_details'][0]['role_id'] == 1)
				$this->redirectUrl = 'admin/establishments/';
			if(@$_SESSION['user_details'][0]['role_id'] == 2)
				$this->redirectUrl = 'school/assignments/';
			if(@$_SESSION['user_details'][0]['role_id'] == 3)
				$this->redirectUrl = 'student/contributions/';		
			
		    header('Location: '. BASE_FRONTEND_URL . $this->redirectUrl);
		
		}
		
		
		
	        $allEstablishments = array();
		$allEstablishments = $this->_model->getAllEstablishments();
		$this->_view->set('allEstablishments', $allEstablishments);

		$this->_view->set('title', 'Admin - Login');
		$this->_view->set('redirect_url', $this->redirectUrl);
		return $this->_view->output();
	}
	
	public function checklogin()
	{
	
		$errors = '';
		$check = true;
		
		$isLogged = false;
		
		$userName = isset($_POST['username']) ? trim($_POST['username']) : "";
		$password = isset($_POST['password']) ? trim($_POST['password']) : "";
		
		if(empty($userName))
		{
		  $check = false;
		  //array_push($errors, "Enter Username.");
		}
		
		if(empty($password))
		{
		  $check = false;
		  //array_push($errors, "Enter Password.");
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
		  
		  $user_details = $this->_model->getLogin();
		  if($user_details){
			  if(@$user_details[0]['status'] == 'Inactive'){
					  $isLogged = false;
					  $this->_setView("index");
					  $errors = "Your account is deactivated. Please Contact admin";
					  $this->_view->set('errors', $errors);
					  $this->_view->set('title', 'Login Failed.');		
				  }else{
					  $isLogged = true;
					  $_SESSION['user_details']= $user_details;
					  $url = explode('=',$_REQUEST['load']);
					  if(isset($url[1])){
						  $this->redirectUrl = $url[1];
					  }
					  if(@$user_details[0]['role_id'] == 1)
						$this->redirectUrl = 'admin/establishments/';
					  if(@$user_details[0]['role_id'] == 2)
						$this->redirectUrl = 'school/assignments/';
					  if(@$user_details[0]['role_id'] == 3)
						$this->redirectUrl = 'student/contributions/';		
					 /* echo "<pre>";
					  print_r($emplyId);*/
					  header('Location: '. BASE_FRONTEND_URL . $this->redirectUrl);
			   }
		  }else{
			  
			  $isLogged = false;
			  $this->_setView("index");
			  $errors = "Username/Password is incorrect.";
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
	public function logout()
	{
		session_destroy();
		header('Location: '. BASE_FRONTEND_URL . 'login/index');
	}
        //google,facebook login check 
	public function checksociallogin()
	{     
               

		$UserEmail = isset($_POST['email']) ? trim($_POST['email']) : "";
                $StudentId = isset($_POST['studentid']) ? trim($_POST['studentid']) : "";
		$Establishment = isset($_POST['establishment']) ? trim($_POST['establishment']) : "";
                $this->_model->setUserEmail($UserEmail);
		$this->_model->setStudentId($StudentId);
		$this->_model->setEstablishment($Establishment);
		$user_details = $this->_model->getSocialLogin();              
		
                          if(count($user_details)==0){
                                echo '0';
                          }else if(@$user_details[0]['status'] == 'Inactive'){
				echo 'Inactive';	 	
		           }
                           else if(@$user_details[0]['status'] == 'Delete'){
				echo '-1';	 	
		           }else{
					  $isLogged = true;
					  $_SESSION['user_details']= $user_details;
					  $url = explode('=',$_REQUEST['load']);
					  if(isset($url[1])){
						  $this->redirectUrl = $url[1];
					  }
					  if(@$user_details[0]['role_id'] == 1)
						$this->redirectUrl = 'admin/establishments/';
					  if(@$user_details[0]['role_id'] == 2)
						$this->redirectUrl = 'school/assignments/';
					  if(@$user_details[0]['role_id'] == 3)
						$this->redirectUrl = 'student/contributions/';		
					 
			       echo BASE_FRONTEND_URL.$this->redirectUrl;
			   }
		  
		
        
        }

}
