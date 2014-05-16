<?php 
class ServicehoursModel extends Model
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
	
	public function insertServicehour($organization_event,$hours_volunteered, $minutes_volunteered, $from_date, $to_date, $email,$address, $state, $city, $zipcode, $phone, $picture, $comments, $user_id)
	{		
		
		$sql="INSERT INTO profiles(email,picture,street1,city_id,state_id,country,zipcode,phone,created_date,created_by,modified_by) Values('$email','$picture','$address','$city','$state','USA','$zipcode','$phone',NOW(),'$user_id','$user_id')";		
		$this->_setSql($sql);
	    $profile_id = $this->insertRow();

		$sql_servicehours="INSERT INTO service_hours(student_id, organization_event, profile_id, from_date, to_date, hours, minutes, comments, is_approved, created_date, created_by, modified_by) Values('$user_id', '$organization_event', '$profile_id', '$from_date', '$to_date','$hours_volunteered', '$minutes_volunteered', '$comments', 'Pending', NOW(), '$user_id', '$user_id')";
		$this->_setSql($sql_servicehours);
	    $this->insertRow();
		
	}
}