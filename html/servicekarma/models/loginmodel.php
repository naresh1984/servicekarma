<?php
class LoginModel extends Model
{
	private $_userName;
	private $_password;
	
	public function setUserName($username)
	{
		$this->_userName = $username;
	}
	
	public function setPassword($password)
	{
		$this->_password = $password;
	}
	
	
	public function getLogin()
	{
		
			
	    
		$sql="CALL GetLogin('".$this->_userName."','".md5($this->_password)."','')";		
		$this->_setSql($sql);
		$EmplId=$this->getAll();
						
		if(empty($EmplId)){
			return false;
		}
				
		
				
	   			
		return $EmplId;					
	}
	
	
	
	
	public function updatePwd()
	{
	
	    $_SESSION['employ']['0']['password']= md5($_REQUEST['newpwd']);
		
		$sql="CALL GetLogin('','".md5($_REQUEST['newpwd'])."','".$_SESSION['employ']['0']['emptblno']."')";	
		$this->_setSql($sql);
	    return $this->getAll();
						
	}
}