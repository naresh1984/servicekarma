<?php 
class EstablishmentsModel extends Model
{
	
	public function getAllStates()
	{
		$sql="SELECT * FROM states ORDER BY state ASC";
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	public function getCities($state_id)
	{
		$sql="SELECT * FROM cities WHERE state_id=$state_id ORDER BY city ASC";
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	
	public function insertEstablishment($est_name,$email,$city,$phone,$address,$state,$zipcode,$required_hours,$website,$logo,$user_id,$status)
	{
		
		
		$sql="INSERT INTO profiles(email,picture,street1,city_id,state_id,country,zipcode,url,phone,created_date,created_by,modified_by) Values('$email','$logo','$address','$city','$state','USA','$zipcode','$website','$phone',NOW(),'$user_id','$user_id')";
		$this->_setSql($sql);
	    $profile_id = $this->insertRow();
		$sql_est="INSERT INTO establishments(establishment_name,profile_id,is_proof_required,required_hours,created_date,created_by,modified_by,status) Values('$est_name','$profile_id','Yes','$required_hours',NOW(),'$user_id','$user_id',',$status')";
		$this->_setSql($sql_est);
	    $this->insertRow();
		
		
	}
	
	public function getAllEstablishments()
	{
		$sql="SELECT *,establishments.id as est_id,profiles.id as id FROM establishments INNER JOIN profiles ON profiles.id = establishments.profile_id INNER JOIN states ON states.id = profiles.state_id INNER JOIN cities ON cities.id = profiles.city_id  ORDER BY establishments.id DESC";
		$this->_setSql($sql);
		$res = $this->getAll();	
		$i=0;
		foreach($res as $result):
		 $res[$i]['users_count']=$i;
		 $id = $res[$i]['est_id'];
		 $sql="SELECT count(*) as user_count FROM users WHERE establishment_id = $id";
		 $this->_setSql($sql);
		 $res_1 = $this->getRow();	
		 $res[$i]['users_count']=$res_1['user_count'];
		 $i++;
		endforeach;
		return $res;					
	}
	public function getRowEstablishment($id)
	{
		$sql="SELECT *,establishments.id as est_id,profiles.id as id FROM establishments INNER JOIN profiles ON profiles.id = establishments.profile_id INNER JOIN states ON states.id = profiles.state_id INNER JOIN cities ON cities.id = profiles.city_id WHERE establishments.id = $id";
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	public function checkEst($est_name)
	{
		$sql="SELECT * FROM establishments WHERE establishment_name = '$est_name'";
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	public function checkEmail($email)
	{
		$sql="SELECT * FROM profiles WHERE email = '$email'";
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	public function EditcheckEst($est_name,$profile_id)
	{
		$sql="SELECT * FROM establishments WHERE establishment_name = '$est_name' AND profile_id!='$profile_id'";
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	public function EditcheckEmail($email,$profile_id)
	{
		 $sql="SELECT * FROM profiles WHERE email = '$email' AND id!='$profile_id'";
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	
	public function EditEstablishment($est_name,$email,$city,$phone,$address,$state,$zipcode,$required_hours,$website,$logo,$user_id,$id,$profile_id,$status){
		
		$sql="UPDATE profiles SET email='$email', street1='$address', city_id='$city', state_id='$state',zipcode='$zipcode', url='$website', phone='$phone',modified_by='$user_id' WHERE id = $profile_id";
		$this->_setSql($sql);
	    $this->updateRow();
		if($logo!=''){
		echo	$sql="UPDATE profiles SET picture='$logo' WHERE id = $profile_id";
			$this->_setSql($sql);
	    	$this->updateRow();
		}
		$sql_est="UPDATE establishments SET establishment_name='$est_name', is_proof_required='Yes', required_hours='$required_hours', modified_by='$user_id',status='$status' WHERE profile_id=$profile_id";
		$this->_setSql($sql_est);
	    $this->updateRow();
	}
	
	
	public function profileinfo($user_id)
	{
		 $sql="SELECT *,profiles.state_id as state_id,profiles.city_id as city_id From users INNER JOIN profiles ON users.profile_id = profiles.id INNER JOIN cities ON cities.id = profiles.city_id INNER JOIN states ON states.id = profiles.state_id WHERE users.id = ".$user_id;
		$this->_setSql($sql);
		$res = $this->getAll();
		return $res;
	}
	public function editProfile($firstname,$lastname,$address,$city,$state,$zipcode,$phone,$logo,$profile_id,$user_id)
	{
		$sql="UPDATE profiles SET firstname='$firstname', lastname='$lastname', street1='$address', city_id='$city', state_id='$state',zipcode='$zipcode', phone='$phone',modified_by='$user_id' WHERE id = $profile_id";
		$this->_setSql($sql);
	    $this->updateRow();
		if($logo!=''){
			$sql="UPDATE profiles SET picture='$logo' WHERE id = $profile_id";
			$this->_setSql($sql);
	    	$this->updateRow();
			$_SESSION['user_details'][0]['picture']=$logo;
		}
		$_SESSION['user_details'][0]['firstname'] = $firstname;
	}
	public function check_oldpwd($user_id,$old_pwd)
	{
		$password = md5($old_pwd);
		$sql="SELECT * FROM users WHERE password = '$password' and id='$user_id'";
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	public function change_password($user_id,$old_pwd,$new_pwd)
	{
		$password = md5($old_pwd);
		$current_pwd = md5($new_pwd);
		$sql="UPDATE users SET password='$current_pwd' WHERE password = '$password' and id='$user_id'";
		$this->_setSql($sql);
	    $this->updateRow();				
	}
	
}