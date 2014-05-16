<?php
class UsersController extends Controller
{
	public function __construct($model, $action)
	{
		parent::__construct($model, $action);
		$this->_setModel($model);
		
		if(!isset($_SESSION['user_details'][0]['id']) || $_SESSION['user_details'][0]['role_id']!=1)
		{
			header("Location:".BASE_FRONTEND_URL."login/index/");
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
			if(move_uploaded_file(@$_FILES["file"]["tmp_name"],"../school/upload/" .$filename. $_FILES["file"]["name"]))
             	$picture = "upload/" .$filename. $_FILES["file"]["name"];
			 
			$first_name = @$_REQUEST['first_name'];
			$last_name = @$_REQUEST['last_name'];			
			$email = @$_REQUEST['email'];
			$establishment_id = @$_REQUEST['establishment'];
			$city = @$_REQUEST['city'];
			$phone = @$_REQUEST['phone_1'].'-'.@$_REQUEST['phone_2'].'-'.@$_REQUEST['phone_3'];
			$address = @$_REQUEST['address'];			
			$state = @$_REQUEST['state'];
			$zipcode = @$_REQUEST['zipcode'];	
			$status = @$_REQUEST['status'];	
			$user_id = $_SESSION['user_details'][0]['id'];
			$user_insert = $this->_model->insertUser($first_name,$last_name,$email,$establishment_id,$city,$phone,$address,$state,$zipcode,$picture,$user_id,$status, $password);
			
			$params = array();
			$params['username'] = $email;
			$params['password'] = $password;				
			$this->_mail->setFrom("info@servicekarma.com");
			$this->_mail->addTo($email,$first_name." ".$last_name);				
			$this->_mail->setSubject('Servicekarma Login Details');	
			$this->_mail->getParams($params);		
			$this->_mail->send();	
			
			header("Location:".BASE_ADMIN_URL."users/");
			
		}else{
			
		$this->_setView("add_user");
		$allStates = array();
		$allStates = $this->_model->getAllStates();
		$this->_view->set('allStates', $allStates);
		
		$allEstablishments = array();
		$allEstablishments = $this->_model->getAllEstablishments();
		$this->_view->set('allEstablishments', $allEstablishments);
		
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
			if(move_uploaded_file(@$_FILES["file"]["tmp_name"],"../school/upload/" .$filename. $_FILES["file"]["name"]))
            $picture = "upload/" .$filename. $_FILES["file"]["name"];
			
			$first_name = @$_REQUEST['first_name'];
			$last_name = @$_REQUEST['last_name'];			
			$email = @$_REQUEST['email'];
			$establishment_id = @$_REQUEST['establishment'];
			$city = @$_REQUEST['city'];
			$phone = @$_REQUEST['phone_1'].'-'.@$_REQUEST['phone_2'].'-'.@$_REQUEST['phone_3'];
			$address = @$_REQUEST['address'];			
			$state = @$_REQUEST['state'];
			$zipcode = @$_REQUEST['zipcode'];			
			$user_id = $_SESSION['user_details'][0]['id'];
			$profile_id = @$_REQUEST['profile_id'];
			$id = @$_REQUEST['id'];
			$status = @$_REQUEST['status'];	
			$user_insert = $this->_model->editUser($first_name,$last_name,$email,$establishment_id,$city,$phone,$address,$state,$zipcode,$picture,$user_id,$id,$profile_id,$status,$password);
			
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
			
			header("Location:".BASE_ADMIN_URL."users/");
			
		}else{
			
		$this->_setView("add_user");
		$allStates = array();
		$allStates = $this->_model->getAllStates();
		$this->_view->set('allStates', $allStates);
		
		$allEstablishments = array();
		$allEstablishments = $this->_model->getAllEstablishments();
		$this->_view->set('allEstablishments', $allEstablishments);
		
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
	
	
	
	
	
	
	
	
	
	
	
	
		
	
	
	
	
	public function saveEmployee()
	{
		$this->_view->set('title', 'Admin - SaveEmployee');
		$this->_view->set('page', 'em');
		return $this->_view->output();		
	}
	public function editEmployeeDetails()
	{
		$this->_view->set('title', 'Admin - View/Edit Employee Details');
		$this->_view->set('page', 'em');
	    $string = explode('/', $_GET['load']);
		$id = $string[2];
		
		if(trim(@$_REQUEST['empid'])!=''){
			$this->_view->set('title', 'Admin - Save Employee');
			$this->_view->set('page', 'em');
					
			$empid = $_REQUEST['empid'];
			$firstname = $_REQUEST['firstname'];
			$lastname = $_REQUEST['lastname'];
			$email = trim($_REQUEST['email']);
			$contactno = $_REQUEST['contactno'];
			$address = $_REQUEST['address'];
			$managerid = $_REQUEST['managerid'];
			$locationid = $_REQUEST['locationid'];
			$password = md5('admin');
			$createdby = $_SESSION['user']['emptblno'];
			$createdon = 'now()';
			$modifiedby = $_SESSION['user']['emptblno'];
			$modifiedon = 'now()';
			$status = 1;
			$rolls = implode("|",$_REQUEST['role']);
			
			$this->_view->set('empid', $empid);
			$this->_view->set('firstname', $firstname);
			$this->_view->set('lastname', $lastname);
			$this->_view->set('email', $email);
			$this->_view->set('contactno', $contactno);
			$this->_view->set('address', $address);
			$this->_view->set('managerid', $managerid);
			$this->_view->set('rolls', $_REQUEST['role']);
			$emply = $this->_model->EdittEmployeesDetails($empid,$firstname,$lastname,$email,$contactno,$address,$managerid,$password,$createdby,$createdon,$modifiedby,$modifiedon,$status,$rolls,$id,$locationid);
			$this->_view->set('saved', $emply);
			
		}
		
		
		$employees = array();
		$employees = $this->_model->getEmployeeDetails($id);
		//echo "<pre>";
		//print_r($employees);
		$this->_view->set('empid', $employees[0]['empid']);
		$this->_view->set('firstname', $employees[0]['firstname']);
		$this->_view->set('lastname', $employees[0]['lastname']);
		$this->_view->set('email', $employees[0]['email']);
		$this->_view->set('contactno', $employees[0]['contactno']);
		$this->_view->set('address', $employees[0]['address']);
		$this->_view->set('managerid', $employees[0]['managerid']);
		$this->_view->set('locationid', $employees[0]['location_id']);
		$roles = array();
		$roles = $this->_model->getRolesByEmpid($id);
		
		
		
		
		$this->_view->set('roles', $roles);
		
		$items = array();
		foreach($roles as $ss):
		$item = array($ss['roleid']);
		$items = array_merge($items, $item);
		endforeach;
		$this->_view->set('rolls', $items);
		
		// List all Roles
		$allRoles = array();
		$allRoles = $this->_model->getAllRoles();
		$this->_view->set('allRoles', $allRoles);
		// List all Locations
		$allLocations = array();
		$allLocations = $this->_model->getAllLocations();
		$this->_view->set('allLocations', $allLocations);
		
		// List Managers 
		$emply = array();
		$emply = $this->_model->getEmployeesByRoleId(3); // 3 is Manager's Role ID
		$this->_view->set('allEmployeesByRoleId', $emply);
		return $this->_view->output();		
	}
	
	public function viewAppliedLeaves()
	{   
	    $string = explode('/', $_GET['load']);		
	    $id = $string[2];
		$leave_id=@$string[3];
		
		
		
		if($leave_id!=''){

		  $emply = $this->_model->insertEmployeesLeave('','','','','','','','','','','',"''",'',"''","''","''",'','4',$leave_id,'','','');	

		  // Leave Details By ID
		  $leaveDetails = $this->_model->editEmployeesLeave('','','','','','','','','','','',"''",'',"''","''","''",'','2',$leave_id,'','','');	
		  
		  // Employee Details By Employee ID
		  $emplydetails = $this->_model->editEmployeesLeave('','','','','','','','','','','',"''",'',"''","''","''",'','8',$leaveDetails['0']['emptblno'],'','','');
		  
		  $newFromDate = explode("-",$leaveDetails[0]['fromdate']);
		  $newFromDate = $newFromDate['2']."-".$newFromDate['1']."-".$newFromDate['0'];
		  $newToDate = explode("-",$leaveDetails[0]['todate']);
		  $newToDate = $newToDate['2']."-".$newToDate['1']."-".$newToDate['0'];
		  $newResumeDate = explode("-",$leaveDetails[0]['resumeon']);
		  $newResumeDate = $newResumeDate['2']."-".$newResumeDate['1']."-".$newResumeDate['0'];			  
		  
		  $params = array();
		  $params['Leave From - To'] = $newFromDate." to ".$newToDate;
		  $params['No. of Working Days'] =  $leaveDetails[0]['numdays'];
		  $params['Resume on'] =  $newResumeDate;
		  $params['Reason'] =  $leaveDetails[0]['reason'];
		  $params['Project / Practice'] =  $leaveDetails[0]['currentproject'];
		  $params['Status'] =  $leaveDetails[0]['status'];	
		  
 		  $this->_mail->setFrom($_SESSION['user']['email']);
		  $this->_mail->addTo($emplydetails['0']['email'],$emplydetails[0]['firstname']." ".$emplydetails[0]['lastname']);
		  $this->_mail->setSubject('Updated Leave Details By Admin');
		  $this->_mail->getParams($params);
		  $this->_mail->send();			  
		
		}
		//$emplyLeaves = $this->_model->editEmployeesLeave('','','','','','','','','','','',"''",'',"''","''","''",'','7',@$id,@$start,@$limit,'');
		
		$page =@$_REQUEST['page'];
		$limit = 25;
		if($page=="")
		$page = 1;
		$start = ($page -1) * $limit;
		$ext='';
		$con='';
		$conn="";
		
		if(@$_REQUEST['status']=="" && @$_REQUEST['status']!="All" ){
		$status="Approved";
		$con.=' AND lr.status="Approved"';
		$conn.="&status=Approved";
		
		}else if(@$_REQUEST['status']!="All"){
		$status=$_REQUEST['status'];
		$con.=' AND lr.status="'.@$_REQUEST['status'].'"';
		$conn.="&status=".@$_REQUEST['status'];
		
		}
		if(@$_REQUEST['status']=="All"){
		$conn.="&status=".@$_REQUEST['status'];
		}
		
		if(@$_REQUEST['empid']!=''){
		$con.=' AND e.empid LIKE "'.@$_REQUEST['empid'].'%"';
		$conn.="&empid=".$_REQUEST['empid'];
		}  		
		if(@$_REQUEST['from']!='' && @$_REQUEST['to']==''){
		$con.=' AND lr.fromdate >="'.@date("Y-m-d",strtotime($_REQUEST['from'])).'"';
		$conn.="&from=".$_REQUEST['from'];
		}
		if(@$_REQUEST['to']!='' && @$_REQUEST['from']==''){
		$con.=' AND lr.todate <="'.@date("Y-m-d",strtotime($_REQUEST['to'])).'"';
		$conn.="&to=".$_REQUEST['to'];
		}
		if(@$_REQUEST['from']!='' && @$_REQUEST['to']!=''){
		$con.=' AND ((lr.fromdate BETWEEN "'.@date("Y-m-d",strtotime($_REQUEST['from'])).'"  AND  "'.@date("Y-m-d",strtotime($_REQUEST['to'])).'") OR ( lr.todate BETWEEN  "'.@date("Y-m-d",strtotime($_REQUEST['from'])).'"  AND  "'.@date("Y-m-d",strtotime($_REQUEST['to'])).'"))';
		$conn.="&from=".$_REQUEST['from']."&to=".$_REQUEST['to'];
		}
		$con.=" AND  e.emptblno=".$id;
		
		$emplyLeaves = $this->_model->editEmployeesLeave($con,'','','','','','','','','','',"''",'',"''","''","''",'','9','',$start,$limit,'');
		
		$emplydetails = $this->_model->editEmployeesLeave('','','','','','','','','','','',"''",'',"''","''","''",'','8',@$id,@$start,@$limit,'');	
			
		$total=@$emplyLeaves['0']['newcount'];	
		$this->_view->set('status_value', @$status);
		$this->_view->set('emplyLeaves', $emplyLeaves);
		$this->_view->set('emplydetails', $emplydetails);
		$this->_view->set('title', 'Admin - View Applied Leaves of a Selected Employee');
		$this->_view->set('page', 'em');
		$this->_view->set('id', $id);
		$pagination = $this->_model->pagination($total,$page,$limit,$conn);
		$this->_view->set('pagination', $pagination);
		return $this->_view->output();	
				
	}
	
	public function editLeaves()
	{
		$this->_view->set('title', 'Admin - Edit Employee Leave Details');
		$this->_view->set('page', 'em');
		$string = explode('/', $_GET['load']);
		$id = $string[2];
		if(@$_REQUEST['els']!='' AND @$_REQUEST['nels']!=''){
			$els = $_REQUEST['els'];
			$nels = $_REQUEST['nels'];
			$createdby = $_SESSION['user']['emptblno'];
			$emply =$this->_model->editLeavesByEmpId($id,$createdby,$els,$nels);
			$this->_view->set('saved', $emply);
		}
		
		$employees = array();
		$employees = $this->_model->getEmployeeDetails($id);
		$this->_view->set('empid', $employees[0]['empid']);
		$this->_view->set('firstname', $employees[0]['firstname']);
		$this->_view->set('lastname', $employees[0]['lastname']);
		
		
		// Get ELS AND NELS 
		$leaves = array();
		$leaves = $this->_model->getLeavesByEmpId($id); // 3 is Manager's Role ID
		$this->_view->set('LeavesByEmpId', $leaves);
		$this->_view->set('els', @$leaves[0]['els']);
		$this->_view->set('nels', @$leaves[0]['nels']);
		return $this->_view->output();			
	}
	
	public function getAllLeaves($id)
	{
	$allLeaves = array();
	$allLeaves = $this->_model->getEmployeeLeavesById($id);
	return $allLeaves;
	}

	public function getRqstdLeaves($id)
	{
	$rqstLeaves = array();
	$rqstLeaves = $this->_model->getRequestedLeaves($id);
	return $rqstLeaves;
	}
	
	public function comingsoon()
	{
       $this->_setView("coming_soon");
	   return $this->_view->output();		
	}

}