<?php 
class ProfilesModel extends Model
{	
	public function getProfile()
	{
		$sql="SELECT p_user.*, u.grade as grade, p_state.state_code as state_code, p_city.city AS city, sc_state.state, sc_city.city, est.establishment_name as establishment_name From users u 
INNER JOIN profiles as p_user ON u.profile_id=p_user.id 
INNER JOIN states as p_state ON p_state.id = p_user.state_id 
INNER JOIN cities AS p_city ON p_city.id=p_user.city_id
INNER JOIN establishments AS est ON est.id = u.establishment_id
INNER JOIN profiles as sc_profile ON sc_profile.id = est.profile_id 
INNER JOIN states AS sc_state ON sc_state.id = sc_profile.state_id 
INNER JOIN cities AS sc_city ON sc_city.id = sc_profile.city_id WHERE u.id = ".$_SESSION['user_details'][0]['id'];
		$this->_setSql($sql);
		$res = $this->getAll();
		return $res;
	}
	public function profileinfo($user_id)
	{
	   $sql="SELECT *,profiles.state_id as state_id,profiles.city_id as city_id,users.id as id,users.profile_id as profile_id From users INNER JOIN profiles ON users.profile_id = profiles.id INNER JOIN cities ON cities.id = profiles.city_id INNER JOIN states ON states.id = profiles.state_id INNER JOIN establishments ON establishments.id = users.establishment_id WHERE users.id = ".$user_id;
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
		$_SESSION['user_details'][0]['lastname'] = $lastname;
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
	public function getRowEstablishment($id)
	{
		$sql="SELECT *,establishments.id as est_id,profiles.id as id FROM establishments INNER JOIN profiles ON profiles.id = establishments.profile_id INNER JOIN states ON states.id = profiles.state_id INNER JOIN cities ON cities.id = profiles.city_id WHERE establishments.id = $id";
		$this->_setSql($sql);
		$res = $this->getAll();	
		$sql="SELECT * FROM prorate_hours WHERE establishment_id='$id'";
		$this->_setSql($sql);
		$res_required = $this->getAll();
		$res[0]['required_hours'] = $res_required;
		
		return $res;					
	}
	public function EditEstablishment($est_name,$email,$city,$phone,$address,$state,$zipcode,$required_hours,$website,$logo,$user_id,$id,$profile_id,$status){
		
		$sql="UPDATE profiles SET email='$email', street1='$address', city_id='$city', state_id='$state',zipcode='$zipcode', url='$website', phone='$phone',modified_by='$user_id' WHERE id = $profile_id";
		$this->_setSql($sql);
	    $this->updateRow();
		if($logo!=''){
			$sql="UPDATE profiles SET picture='$logo' WHERE id = $profile_id";
			$this->_setSql($sql);
	    	$this->updateRow();
		}
		$sql_est="UPDATE establishments SET establishment_name='$est_name',modified_by='$user_id',status='$status' WHERE profile_id=$profile_id";
		$this->_setSql($sql_est);
	    $this->updateRow();
		     
		$i=1;
		foreach($required_hours as $val):
				 $res_required = array();
				 $sql="SELECT * FROM prorate_hours WHERE number_years='$i' AND establishment_id='$id'";
				 $this->_setSql($sql);
				 $res_required = $this->getAll();	
			  if(count($res_required) > 0){
				$sql_est="UPDATE prorate_hours SET required_hours = '$val', modified_date=NOW(),modified_by='$user_id' WHERE number_years='$i' AND establishment_id='$id'";
				$this->_setSql($sql_est);
				$establishment_id = $this->updateRow();
			}else{		
				$sql_est="INSERT INTO prorate_hours SET required_hours = '$val', number_years='$i',establishment_id='$id',created_date=NOW(),created_by='$user_id',modified_date=NOW(),modified_by='$user_id'";
				$this->_setSql($sql_est);
				$establishment_id = $this->insertRow();
			}
			$i++;
		endforeach;
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
}