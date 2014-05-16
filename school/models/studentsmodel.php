<?php 
class StudentsModel extends Model
{
	public function getAllStates()
	{
		$sql="SELECT * FROM states ORDER BY state ASC";
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	
	public function getAllEstablishments()
	{
		$sql="SELECT * FROM establishments WHERE status!='Delete' ORDER BY establishment_name ASC";
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	public function getRowEstablishment($id)
	{
		$sql="SELECT * FROM establishments WHERE id = $id";
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	public function getAllUsers($select_establishment)
	{
		$clause = '';
		if($select_establishment!='')
		{
			$clause = "WHERE users.establishment_id = ".$select_establishment ." AND role_id=3 AND users.status='Active'";
		}
		
		$sql="SELECT *,users.id as user_id,users.status as user_status,profiles.id as profile_id,users.required_hours as required_hours,users.created_date as created_date FROM users INNER JOIN profiles ON profiles.id = users.profile_id INNER JOIN states ON states.id = profiles.state_id INNER JOIN cities ON cities.id = profiles.city_id INNER JOIN establishments AS est ON est.id = users.establishment_id ".$clause." ORDER BY users.username ASC";

		$this->_setSql($sql);
		$res = $this->getAll();
		return $res;					
	}
	
	public function getRowUser($id)
	{
		$sql="SELECT *,users.id as user_id,users.status as user_status,profiles.id as profile_id,users.created_date as created_date FROM users INNER JOIN profiles ON profiles.id = users.profile_id INNER JOIN states ON states.id = profiles.state_id INNER JOIN cities ON cities.id = profiles.city_id INNER JOIN establishments AS est ON est.id = users.establishment_id WHERE users.id = $id";		
		
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
	
	public function checkEmail($email)
	{
		$sql="SELECT * FROM users WHERE username = '$email'";
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	
	public function EditcheckEmail($email,$id)
	{
		$sql="SELECT * FROM users WHERE username = '$email' AND id !='$id'";		
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	
	public function insertUser($first_name,$last_name,$email,$establishment_id,$city,$phone,$address,$state,$zipcode,$picture,$user_id,$status,$password,$student_id,$graduation_year)
	{		
		$number_years = $graduation_year-date('Y');
		$sql_pro_hours="SELECT required_hours FROM prorate_hours WHERE number_years = $number_years AND establishment_id=$establishment_id";		
		
		$this->_setSql($sql_pro_hours);
		$res_pro_hours = $this->getAll();	
		$required_hours = $res_pro_hours[0]['required_hours'];
		
		
		$sql="INSERT INTO profiles(firstname,lastname,email,picture,street1,city_id,state_id,country,zipcode,phone,created_date,created_by,modified_by) Values('".$first_name."','".$last_name."','".$email."','".$picture."','".$address."','".$city."','".$state."','USA','".$zipcode."','".$phone."',NOW(),'".$user_id."','".$user_id."')";
		$this->_setSql($sql);
	    $profile_id = $this->insertRow();
		$password = md5($password);
		$sql_usr="INSERT INTO users(username,password,role_id,establishment_id,profile_id,status,created_date,created_by,modified_by,student_id, graduation_year,required_hours) Values('".$email."','".$password."','3','".$establishment_id."','".$profile_id."','".$status."',NOW(),'".$user_id."','".$user_id."','".$student_id."','".$graduation_year."','".$required_hours."')";
		$this->_setSql($sql_usr);
	    $this->insertRow();
		
	}
	
	public function editUser($first_name,$last_name,$email,$establishment_id,$city,$phone,$address,$state,$zipcode,$picture,$user_id,$id,$profile_id,$status,$password,$student_id,$graduation_year,$created_date)	
	{			
		
		
		$creted_year = date("Y", strtotime(@$created_date));
	    $number_years = $graduation_year - $creted_year;
	    $created_date;
		$sql_pro_hours="SELECT required_hours FROM prorate_hours WHERE number_years = $number_years AND establishment_id=$establishment_id";		
		$this->_setSql($sql_pro_hours);
		$res_pro_hours = $this->getAll();	
		$required_hours = $res_pro_hours[0]['required_hours'];
		
		$sql="UPDATE profiles SET firstname='$first_name', lastname='$last_name',email='$email', street1='$address', city_id='$city', state_id='$state',zipcode='$zipcode', phone='$phone',modified_by='$user_id' WHERE id = $profile_id";
		$this->_setSql($sql);
		$this->updateRow();
	    		
		if($password=='')
		{
			$sql_usr="UPDATE users set username = '$email',modified_by = '$user_id',status='$status', required_hours='$required_hours', student_id='$student_id', graduation_year='$graduation_year' WHERE profile_id = '$profile_id' AND id = '$id'";
		}
		else
		{
				$password = md5($password);
				$sql_usr="UPDATE users set username = '$email', password = '$password',modified_by = '$user_id',status='$status', required_hours='$required_hours', student_id='$student_id', graduation_year='$graduation_year' WHERE profile_id = '$profile_id' AND id = '$id'";
		}
		$this->_setSql($sql_usr);
	    $this->updateRow();
		
		if($picture!=''){
		    $sql_pic="UPDATE profiles SET picture='$picture' WHERE id = $profile_id";
			$this->_setSql($sql_pic);
	    	$this->updateRow();
		}		
	}
	
	
	public function generateRandomString($length = 6) 
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
	public function deleteUsers($ids)
	{
			echo $sqlDel="UPDATE users SET status='Delete' WHERE id IN($ids)";
			$this->_setSql($sqlDel);
	    	$this->updateRow();	
	}

	
}