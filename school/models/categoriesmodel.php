<?php 
class CategoriesModel extends Model
{	
	public function getAllCategories($establishment_id)
	{		
		$sql="SELECT * FROM establishment_categories WHERE establishment_id = $establishment_id  ORDER BY category_name ASC";
		$this->_setSql($sql);
		$res = $this->getAll();
		return $res;					
	}
	
	public function getRowCategory($id)
	{
		$sql="SELECT * FROM establishment_categories WHERE id = $id";			
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	
	public function checkCategory($category_name)
	{
		$sql="SELECT * FROM establishment_categories WHERE category_name = '$category_name'";
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	
	public function EditcheckCategory($category_name,$id)
	{
		$sql="SELECT * FROM establishment_categories WHERE category_name = '$category_name' AND id !='$id'";		
		$this->_setSql($sql);
		$res = $this->getAll();	
		return $res;					
	}
	
	public function insertCategory($category_name,$status,$user_id,$establishment_id)
	{				
		$sql="INSERT INTO establishment_categories(category_name,establishment_id,status,created_date,created_by,modified_by) Values('$category_name','$establishment_id','$status',NOW(),'$user_id','$user_id')";
		$this->_setSql($sql);	
	    $this->insertRow();	
	}
	
	public function editCategory($category_name,$user_id,$id,$status)	
	{			
		$sql="UPDATE establishment_categories SET category_name='$category_name',status='$status',modified_by='$user_id' WHERE id = $id";
		$this->_setSql($sql);
		$this->updateRow();	
	}	
	
}