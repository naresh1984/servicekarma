<?php 
class ServicerecordModel extends Model
{
	
	public function getAllServiceRecords($user_id)
	{
		$clause = '';
		if($user_id!='')
		{
			$clause = " WHERE service_hours.student_id = ".$user_id;
		}
				
		
		$sql="SELECT service_hours.id as service_hours_id, service_hours.is_approved as is_approved, service_hours.organization_event as organization_event, service_hours.from_date as from_date, service_hours.to_date as to_date, service_hours.hours as hours, service_hours.minutes as minutes, users.required_hours as required_hours, users.required_minutes as required_minutes, user_profiles.firstname as firstname, user_profiles.lastname as lastname, user_profiles.email as email, sh_profiles.picture as document, sh_profiles.street1 as street1, sh_profiles.zipcode as zipcode, sh_states.state_code as state_code, sh_cities.city as city FROM service_hours INNER JOIN users ON service_hours.student_id = users.id INNER JOIN profiles user_profiles ON users.profile_id = user_profiles.id INNER JOIN profiles sh_profiles ON service_hours.profile_id = sh_profiles.id INNER JOIN states sh_states ON sh_states.id = sh_profiles.state_id INNER JOIN cities sh_cities ON sh_cities.id = sh_profiles.city_id ".$clause;
		
		$this->_setSql($sql);
		$res = $this->getAll();		
		return $res;					
	}
	
	public function getAllServiceRecordsHours($user_id)
	{
			$res = array();
			$student_id = $user_id;
			
			$sql_pending="SELECT sum(hours) as pending_hours, sum(minutes) as pending_minutes FROM service_hours WHERE student_id = $student_id AND is_approved = 'Pending'";
			$this->_setSql($sql_pending);
			$res_1 = $this->getRow();
			$res['pending_hours']=$res_1['pending_hours']?$res_1['pending_hours']:0;
			$res['pending_minutes']=$res_1['pending_minutes']?$res_1['pending_minutes']:0;
			
			$sql_approve="SELECT sum(hours) as approved_hours, sum(minutes) as approved_minutes FROM service_hours WHERE student_id = $student_id AND is_approved = 'Approved'";
			$this->_setSql($sql_approve);
			$res_2 = $this->getRow();
			$res['approved_hours']=$res_2['approved_hours']?$res_2['approved_hours']:0;
			$res['approved_minutes']=$res_2['approved_minutes']?$res_2['approved_minutes']:0;					
			
			$sql_required="SELECT required_hours, required_minutes FROM users WHERE id = $student_id";
			$this->_setSql($sql_required);
			$res_3 = $this->getRow();
			$res['required_hours']=$res_3['required_hours']?$res_3['required_hours']:0;
			$res['required_minutes']=$res_3['required_minutes']?$res_3['required_minutes']:0;
		
			return $res;					
	}
	
	public function getRowServicerecord($id)
	{
		 $sql="SELECT service_hours.id as service_hours_id, service_hours.is_approved as is_approved, service_hours.rejected_reason as rejected_reason, service_hours.student_id as student_id, service_hours.organization_event as organization_event, service_hours.from_date as from_date, service_hours.to_date as to_date, service_hours.hours as hours, service_hours.minutes as minutes, service_hours.comments as comments, users.required_hours as required_hours, users.required_minutes as required_minutes, users.student_id as student_school_id, user_profiles.firstname as firstname, user_profiles.lastname as lastname, user_profiles.email as email, sh_profiles.picture as document, sh_profiles.street1 as street1, sh_states.state_code as state_code, sh_cities.city as city, sh_profiles.zipcode as zipcode FROM service_hours INNER JOIN users ON service_hours.student_id = users.id INNER JOIN profiles user_profiles ON users.profile_id = user_profiles.id INNER JOIN profiles sh_profiles ON service_hours.profile_id = sh_profiles.id INNER JOIN states sh_states ON sh_states.id = sh_profiles.state_id INNER JOIN cities sh_cities ON sh_cities.id = sh_profiles.city_id  WHERE service_hours.id = $id";		 
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;	
				
	}
	
	public function approveRejectAssignment($service_hours_id, $status, $rejected_reason, $user_id)
	{
		if($status == "approve")
		{
			$approve_status = "Approved";
			echo $sql="UPDATE service_hours SET is_approved='$approve_status', approved_by='$user_id', approved_date=NOW(), modified_by='$user_id' WHERE id = $service_hours_id";
		}
		else if($status == "reject" || $status == "rejectemail")
		{
			$approve_status = "Rejected";
			$sql="UPDATE service_hours SET is_approved='$approve_status', rejected_by='$user_id', rejected_date=NOW(), rejected_reason='$rejected_reason', modified_by='$user_id' WHERE id = $service_hours_id";
		}

		$this->_setSql($sql);
		$this->updateRow();	  		
	}
		
}