<?php 
class ReportsModel extends Model
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
	
	public function getAllUsers()
	{
		$sql="SELECT *,users.id as user_id,profiles.id as profile_id FROM users INNER JOIN profiles ON profiles.id = users.profile_id INNER JOIN states ON states.id = profiles.state_id INNER JOIN cities ON cities.id = profiles.city_id INNER JOIN establishments AS est ON est.id = users.establishment_id ORDER BY users.username ASC";

		$this->_setSql($sql);
		$res = $this->getAll();
		return $res;
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
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
}