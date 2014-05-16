<?php 
class OrganizationsModel extends Model
{
	public function getAllStates()
	{
		$sql="SELECT * FROM states ORDER BY state ASC";
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	
	public function getAllOrganizations($establishment_id)
	{
		$clause = '';
		if($establishment_id!='')
		{
			$clause = " WHERE establishment_id = ".$establishment_id;
		}
		
		//$sql="SELECT *,organizations.id as organization_id,organizations.status as organization_status,profiles.id as profile_id FROM organizations INNER JOIN profiles ON profiles.id = organizations.profile_id INNER JOIN states ON states.id = profiles.state_id INNER JOIN cities ON cities.id = profiles.city_id INNER JOIN establishments AS est ON est.id = organizations.establishment_id ".$clause." ORDER BY organizations.organization_name ASC";
		$sql="SELECT *,organizations.id as organization_id,organizations.status as organization_status,profiles.id as profile_id FROM organizations INNER JOIN profiles ON profiles.id = organizations.profile_id INNER JOIN states ON states.id = profiles.state_id INNER JOIN cities ON cities.id = profiles.city_id ".$clause." ORDER BY organizations.organization_name ASC";

		$this->_setSql($sql);
		$res = $this->getAll();
		return $res;					
	}
	
	public function getRowOrganization($id)
	{
		$sql="SELECT *,organizations.id as organization_id,organizations.status as organization_status,profiles.id as profile_id FROM organizations INNER JOIN profiles ON profiles.id = organizations.profile_id INNER JOIN states ON states.id = profiles.state_id INNER JOIN cities ON cities.id = profiles.city_id WHERE organizations.id = $id";		
		
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
	
	public function checkOrganization($organization_name,$establishment_id)
	{
		$sql="SELECT * FROM organizations WHERE organization_name = '$organization_name' AND establishment_id ='$establishment_id'";		
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	
	public function EditcheckOrganization($organization_name,$id,$establishment_id)
	{
		$sql="SELECT * FROM organizations WHERE organization_name = '$organization_name' AND id !='$id' AND establishment_id ='$establishment_id'";	
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	
	public function insertOrganization($organization_name,$email,$establishment_id,$city,$phone,$address,$state,$zipcode,$website,$user_id,$status)
	{				
		$sql="INSERT INTO profiles(email,street1,city_id,state_id,country,zipcode,url,phone,created_date,created_by,modified_by) Values('$email','$address','$city','$state','USA','$zipcode','$website','$phone',NOW(),'$user_id','$user_id')";
		$this->_setSql($sql);
	    $profile_id = $this->insertRow();		
		$sql_org="INSERT INTO organizations(organization_name,establishment_id,profile_id,status,created_date,created_by,modified_by) Values('$organization_name','$establishment_id','$profile_id','$status',NOW(),'$user_id','$user_id')";
		$this->_setSql($sql_org);
	    $this->insertRow();		
	}
	
	public function editOrganization($organization_name,$email,$establishment_id,$city,$phone,$address,$state,$zipcode,$website,$user_id,$id,$profile_id,$status)	
	{			
		$sql="UPDATE profiles SET email='$email', street1='$address', city_id='$city', state_id='$state',zipcode='$zipcode', phone='$phone',url='$website',modified_by='$user_id' WHERE id = $profile_id";
		$this->_setSql($sql);
		$this->updateRow();	    		

		$sql_org="UPDATE organizations set organization_name = '$organization_name', establishment_id = '$establishment_id',modified_by = '$user_id',status='$status' WHERE profile_id = '$profile_id' AND id = '$id'";		
		
		$this->_setSql($sql_org);
	    $this->updateRow();
		}
	
}