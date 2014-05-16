<?php 
class AssignmentsModel extends Model
{
	
	public function getAllPendingAssignments($establishment_id)
	{
		$clause = '';
		if($establishment_id!='')
		{
			$clause = " WHERE service_hours.is_approved = 'Pending' AND users.establishment_id = ".$establishment_id;
		}
				
		
		$sql="SELECT service_hours.id as service_hours_id, service_hours.student_id as student_id, service_hours.organization_event as organization_event, service_hours.from_date as from_date, service_hours.to_date as to_date, service_hours.hours as hours, service_hours.minutes as minutes, users.required_hours as required_hours, users.required_minutes as required_minutes, user_profiles.firstname as firstname, user_profiles.lastname as lastname, user_profiles.email as email, sh_profiles.picture as document FROM service_hours INNER JOIN users ON service_hours.student_id = users.id INNER JOIN profiles user_profiles ON users.profile_id = user_profiles.id INNER JOIN profiles sh_profiles ON service_hours.profile_id = sh_profiles.id".$clause;
		
		$this->_setSql($sql);
		$res = $this->getAll();
		return $res;					
	}
	
	public function getRowAssignment($id)
	{
		 $sql="SELECT service_hours.id as service_hours_id, service_hours.student_id as student_id, service_hours.organization_event as organization_event, service_hours.from_date as from_date, service_hours.to_date as to_date, service_hours.hours as hours, service_hours.minutes as minutes, service_hours.comments as comments, users.required_hours as required_hours, users.required_minutes as required_minutes, users.student_id as student_school_id, user_profiles.firstname as firstname, user_profiles.lastname as lastname, user_profiles.email as email, sh_profiles.picture as document, sh_profiles.street1 as street1, sh_states.state_code as state_code, sh_cities.city as city, sh_profiles.zipcode as zipcode FROM service_hours INNER JOIN users ON service_hours.student_id = users.id INNER JOIN profiles user_profiles ON users.profile_id = user_profiles.id INNER JOIN profiles sh_profiles ON service_hours.profile_id = sh_profiles.id INNER JOIN states sh_states ON sh_states.id = sh_profiles.state_id INNER JOIN cities sh_cities ON sh_cities.id = sh_profiles.city_id  WHERE service_hours.id = $id";
		 
		$this->_setSql($sql);
		$res = $this->getAll();				
		
		$i=0;
		foreach($res as $result):
			$id = $res[$i]['student_id'];
			$sql_pending="SELECT sum(hours) as pending_hours, sum(minutes) as pending_minutes FROM service_hours WHERE student_id = $id AND is_approved = 'Pending'";
			$this->_setSql($sql_pending);
			$res_1 = $this->getRow();
			$res[$i]['pending_hours']=$res_1['pending_hours']?$res_1['pending_hours']:0;
			$res[$i]['pending_minutes']=$res_1['pending_minutes']?$res_1['pending_minutes']:0;
			
			$sql_approve="SELECT sum(hours) as approved_hours, sum(minutes) as approved_minutes FROM service_hours WHERE student_id = $id AND is_approved = 'Approved'";
			$this->_setSql($sql_approve);
			$res_2 = $this->getRow();
			$res[$i]['approved_hours']=$res_2['approved_hours']?$res_2['approved_hours']:0;
			$res[$i]['approved_minutes']=$res_2['approved_minutes']?$res_2['approved_minutes']:0;
			$i++;
		endforeach;
		
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
	
	public function getRowUser($id)
	{
		$sql="SELECT *,users.id as user_id,users.status as user_status,profiles.id as profile_id,users.created_date as created_date FROM users INNER JOIN profiles ON profiles.id = users.profile_id INNER JOIN states ON states.id = profiles.state_id INNER JOIN cities ON cities.id = profiles.city_id INNER JOIN establishments AS est ON est.id = users.establishment_id WHERE users.id = $id";		
		
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
		
}