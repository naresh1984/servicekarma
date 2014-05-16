<?php 
class EventsModel extends Model
{
	public function getAllStates()
	{
		$sql="SELECT * FROM states ORDER BY state ASC";
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	
	public function getAllCategories($establishment_id)
	{		
		$sql="SELECT * FROM establishment_categories WHERE establishment_id = $establishment_id AND status = 'Active' ORDER BY category_name ASC";
		$this->_setSql($sql);
		$res = $this->getAll();
		return $res;					
	}
	
	public function getAllOrganizations($establishment_id)
	{
		$clause = '';
		if($establishment_id!='')
		{
			$clause = " WHERE establishment_id = ".$establishment_id." AND organizations.status = 'Active'";
		}
		
		//$sql="SELECT *,organizations.id as organization_id,organizations.status as organization_status,profiles.id as profile_id FROM organizations INNER JOIN profiles ON profiles.id = organizations.profile_id INNER JOIN states ON states.id = profiles.state_id INNER JOIN cities ON cities.id = profiles.city_id INNER JOIN establishments AS est ON est.id = organizations.establishment_id ".$clause." ORDER BY organizations.organization_name ASC";
		$sql="SELECT *,organizations.id as organization_id,organizations.status as organization_status,profiles.id as profile_id FROM organizations INNER JOIN profiles ON profiles.id = organizations.profile_id INNER JOIN states ON states.id = profiles.state_id INNER JOIN cities ON cities.id = profiles.city_id ".$clause." ORDER BY organizations.organization_name ASC";

		$this->_setSql($sql);
		$res = $this->getAll();
		return $res;					
	}
	
	public function getAllEvents($establishment_id)
	{
		$clause = '';
		if($establishment_id!='')
		{
			$clause = " WHERE events.establishment_id = ".$establishment_id;
		}		
		
		$sql="SELECT *,events.id as event_id,events.status as event_status,profiles.id as profile_id FROM events INNER JOIN profiles ON profiles.id = events.profile_id INNER JOIN establishment_categories ON establishment_categories.id = events.category_id INNER JOIN organizations ON organizations.id = events.organization_id INNER JOIN states ON states.id = profiles.state_id INNER JOIN cities ON cities.id = profiles.city_id ".$clause." ORDER BY events.event_title ASC";

		$this->_setSql($sql);
		$res = $this->getAll();
		return $res;					
	}
	
	public function getRowEvent($id)
	{
		$sql="SELECT *,events.id as event_id,events.status as event_status,profiles.id as profile_id FROM events INNER JOIN profiles ON profiles.id = events.profile_id INNER JOIN states ON states.id = profiles.state_id INNER JOIN cities ON cities.id = profiles.city_id WHERE events.id = $id";		
		
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
	
	public function checkEvent($event_title,$establishment_id)
	{
		$sql="SELECT * FROM events WHERE event_title = '$event_title' AND establishment_id ='$establishment_id'";		
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	
	public function EditcheckEvent($event_title,$id,$establishment_id)
	{
		$sql="SELECT * FROM events WHERE event_title = '$event_title' AND id !='$id' AND establishment_id ='$establishment_id'";	
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	
	public function insertEvent($event_title,$category_id,$other_category_name,$organization_id,$other_organization_name,$email,$from_date,$to_date,$start_time,$end_time,$establishment_id,$city,$phone,$address,$state,$zipcode,$website,$volunteer_capacity,$description,$is_proof_required,$user_id,$status)
	{				
		
		if($category_id==0 && $other_category_name!='')
		{
			$sql="INSERT INTO establishment_categories(category_name,establishment_id,status,created_date,created_by,modified_by) Values('$other_category_name','$establishment_id','Active',NOW(),'$user_id','$user_id')";
			$this->_setSql($sql);	
			$category_id = $this->insertRow();	
		}
		
		if($organization_id==0 && $other_organization_name!='')
		{
			$sql="INSERT INTO profiles(created_date,created_by,modified_by) Values(NOW(),'$user_id','$user_id')";
			$this->_setSql($sql);
			$org_profile_id = $this->insertRow();		
			$sql_org="INSERT INTO organizations(organization_name,establishment_id,profile_id,status,created_date,created_by,modified_by) Values('$other_organization_name','$establishment_id','$org_profile_id','Active',NOW(),'$user_id','$user_id')";
			$this->_setSql($sql_org);
			$organization_id = $this->insertRow();		
		}
		
		$sql="INSERT INTO profiles(email,street1,city_id,state_id,country,zipcode,url,phone,created_date,created_by,modified_by) Values('$email','$address','$city','$state','USA','$zipcode','$website','$phone',NOW(),'$user_id','$user_id')";
		$this->_setSql($sql);
	    $profile_id = $this->insertRow();		
		$sql_org="INSERT INTO events(event_title, category_id, organization_id, establishment_id, profile_id, from_date, to_date,start_time, end_time, volunteer_capacity, description, is_proof_required, status, created_date, created_by, modified_by) Values('$event_title', '$category_id', '$organization_id',  '$establishment_id', '$profile_id', '$from_date', '$to_date', '$start_time', '$end_time', '$volunteer_capacity', '$description', '$is_proof_required', '$status', NOW(), '$user_id', '$user_id')";
		$this->_setSql($sql_org);
	    $this->insertRow();		
	}
	
	public function editEvent($event_title,$category_id,$other_category_name,$organization_id,$other_organization_name,$email,$from_date,$to_date,$start_time,$end_time,$establishment_id,$city,$phone,$address,$state,$zipcode,$website,$volunteer_capacity,$description,$is_proof_required,$user_id,$status,$id,$profile_id)	
	{			
	
		if($category_id==0 && $other_category_name!='')
		{
			$sql="INSERT INTO establishment_categories(category_name,establishment_id,status,created_date,created_by,modified_by) Values('$other_category_name','$establishment_id','Active',NOW(),'$user_id','$user_id')";
			$this->_setSql($sql);	
			$category_id = $this->insertRow();	
		}
		
		if($organization_id==0 && $other_organization_name!='')
		{
			$sql="INSERT INTO profiles(created_date,created_by,modified_by) Values(NOW(),'$user_id','$user_id')";
			$this->_setSql($sql);
			$org_profile_id = $this->insertRow();		
			$sql_org="INSERT INTO organizations(other_organization_name,establishment_id,profile_id,status,created_date,created_by,modified_by) Values('$organization_name','$establishment_id','$org_profile_id','Active',NOW(),'$user_id','$user_id')";
			$this->_setSql($sql_org);
			$organization_id = $this->insertRow();		
		}
		
		$sql="UPDATE profiles SET email='$email', street1='$address', city_id='$city', state_id='$state',zipcode='$zipcode', phone='$phone',url='$website',modified_by='$user_id' WHERE id = $profile_id";
		$this->_setSql($sql);
		$this->updateRow();	    		

		$sql_org="UPDATE events set event_title = '$event_title', category_id = '$category_id', organization_id = '$organization_id', establishment_id = '$establishment_id', from_date = '$from_date', to_date = '$to_date', start_time = '$start_time', end_time = '$end_time', description = '$description', is_proof_required = '$is_proof_required', modified_by = '$user_id', status='$status' WHERE profile_id = '$profile_id' AND id = '$id'";		
		
		$this->_setSql($sql_org);
	    $this->updateRow();
		}
		
		public function getRowOrganization($id)
		{
			$sql="SELECT *,organizations.id as organization_id,organizations.status as organization_status,profiles.id as profile_id FROM organizations INNER JOIN profiles ON profiles.id = organizations.profile_id INNER JOIN states ON states.id = profiles.state_id INNER JOIN cities ON cities.id = profiles.city_id WHERE organizations.id = $id";		
			
			$this->_setSql($sql);
			$res = $this->getAll();	
			return $res;					
		}
	
}