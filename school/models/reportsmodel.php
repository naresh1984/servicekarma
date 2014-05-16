<?php 
class ReportsModel extends Model
{
	public function usersinfo($establishment_id)
	{
	    $sql="SELECT *,profiles.state_id as state_id,profiles.city_id as city_id,users.id as id,users.profile_id as profile_id,users.required_hours as required_hours,users.created_date as created_date From users INNER JOIN profiles ON users.profile_id = profiles.id INNER JOIN cities ON cities.id = profiles.city_id INNER JOIN states ON states.id = profiles.state_id INNER JOIN establishments ON establishments.id = users.establishment_id WHERE users.establishment_id = ".$establishment_id." AND role_id = 3";
		$this->_setSql($sql);
		$res = $this->getAll();
		$i=0;
		foreach($res as $result):
		 $id = $res[$i]['id'];
		 $sql="SELECT sum(hours) as hours,sum(minutes) as minutes FROM service_hours WHERE student_id = $id AND is_approved = 'Approved'";
		 $this->_setSql($sql);
		 $res_1 = $this->getRow();	
		 $res[$i]['hours']=$res_1['hours']?$res_1['hours']:0;
		 $res[$i]['minutes']=$res_1['minutes']?$res_1['minutes']:0;
		 $i++;
		endforeach;
		return $res;
	}
	public function getRowUser($id)
	{
		$sql="SELECT *,users.id as user_id,users.status as user_status,profiles.id as profile_id,users.created_date as created_date FROM users INNER JOIN profiles ON profiles.id = users.profile_id INNER JOIN states ON states.id = profiles.state_id INNER JOIN cities ON cities.id = profiles.city_id INNER JOIN establishments AS est ON est.id = users.establishment_id WHERE users.id = $id";		
		
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
}