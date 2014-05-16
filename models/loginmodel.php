<?php
class LoginModel extends Model
{
	private $_userName;
	private $_password;
	private $_Establishment;
	private $_UserEmail;
	private $_StudentId;
	
	public function setUserName($username)
	{
		$this->_userName = $username;
	}
	
	public function setPassword($password)
	{
		$this->_password = $password;
	}
		public function setUserEmail($UserEmail)
	{
		$this->_UserEmail = $UserEmail;
	}
	public function setStudentId($StudentId)
	{
		$this->_StudentId = $StudentId;
	}
	public function setEstablishment($Establishment)
	{
		$this->_Establishment = $Establishment;
	}

	public function getAllEstablishments()
	{
		$sql="SELECT * FROM establishments WHERE status!='Delete' ORDER BY establishment_name ASC";
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	
	public function getLogin()
	{
		
			
	    
		$sql="SELECT *,users.id as id FROM users INNER JOIN profiles ON profiles.id = users.profile_id WHERE username ='".$this->_userName."' AND password ='".md5($this->_password)."'";		
		$this->_setSql($sql);
		$User_deatils=$this->getAll();
						
		if(empty($User_deatils)){
			return false;
		}
				
		
				
	   			
		return $User_deatils;					
	}
	
	
	
	
	public function updatePwd()
	{
	
	    $_SESSION['employ']['0']['password']= md5($_REQUEST['newpwd']);
		
		$sql="CALL GetLogin('','".md5($_REQUEST['newpwd'])."','".$_SESSION['employ']['0']['emptblno']."')";	
		$this->_setSql($sql);
	    return $this->getAll();
						
	}
        //google,facebook login check 
public function getSocialLogin()
	{
		
		$sql="SELECT *,users.id as id FROM users where establishment_id=".$this->_Establishment." AND 	student_id='".$this->_StudentId."' AND username='".$this->_UserEmail."'";		
		$this->_setSql($sql);
		$User_deatils=$this->getAll();      

                return $User_deatils;					
	}


}
