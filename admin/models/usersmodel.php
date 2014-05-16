<?php 
class UsersModel extends Model
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
	
	public function getAllUsers($select_establishment)
	{
		$clause = '';
		if($select_establishment!='')
		{
			$clause = "WHERE users.establishment_id = ".$select_establishment;
		}
		
		$sql="SELECT *,users.id as user_id,users.status as user_status,profiles.id as profile_id FROM users INNER JOIN profiles ON profiles.id = users.profile_id INNER JOIN states ON states.id = profiles.state_id INNER JOIN cities ON cities.id = profiles.city_id INNER JOIN establishments AS est ON est.id = users.establishment_id ".$clause." ORDER BY users.username ASC";

		$this->_setSql($sql);
		$res = $this->getAll();
		return $res;					
	}
	
	public function getRowUser($id)
	{
		$sql="SELECT *,users.id as user_id,users.status as user_status,profiles.id as profile_id FROM users INNER JOIN profiles ON profiles.id = users.profile_id INNER JOIN states ON states.id = profiles.state_id INNER JOIN cities ON cities.id = profiles.city_id INNER JOIN establishments AS est ON est.id = users.establishment_id WHERE users.id = $id";		
		
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
	
	public function insertUser($first_name,$last_name,$email,$establishment_id,$city,$phone,$address,$state,$zipcode,$picture,$user_id,$status,$password)
	{		
		
		$sql="INSERT INTO profiles(firstname,lastname,email,picture,street1,city_id,state_id,country,zipcode,phone,created_date,created_by,modified_by) Values('$first_name','$last_name','$email','$picture','$address','$city','$state','USA','$zipcode','$phone',NOW(),'$user_id','$user_id')";
		$this->_setSql($sql);
	    $profile_id = $this->insertRow();
		$password = md5($password);
		$sql_usr="INSERT INTO users(username,password,role_id,establishment_id,profile_id,status,created_date,created_by,modified_by) Values('$email','$password','2','$establishment_id','$profile_id','$status',NOW(),'$user_id','$user_id')";
		$this->_setSql($sql_usr);
	    $this->insertRow();
		
	}
	
	public function editUser($first_name,$last_name,$email,$establishment_id,$city,$phone,$address,$state,$zipcode,$picture,$user_id,$id,$profile_id,$status,$password)	
	{			
		$sql="UPDATE profiles SET firstname='$first_name', lastname='$last_name',email='$email', street1='$address', city_id='$city', state_id='$state',zipcode='$zipcode', phone='$phone',modified_by='$user_id' WHERE id = $profile_id";
		$this->_setSql($sql);
		$this->updateRow();
	    		
		if($password=='')
		{
			$sql_usr="UPDATE users set username = '$email', establishment_id = '$establishment_id',modified_by = '$user_id',status='$status' WHERE profile_id = '$profile_id' AND id = '$id'";
		}
		else
		{
				$password = md5($password);
				$sql_usr="UPDATE users set username = '$email', password = '$password', establishment_id = '$establishment_id',modified_by = '$user_id',status='$status' WHERE profile_id = '$profile_id' AND id = '$id'";
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
	
	
	
	
	
	
	
	
	// Get All Roles 
	public function getAllRoles()
	{
		$sql="CALL GetAllRoles()";
		$this->_setSql($sql);
		$res = $this->getAll();			
		return $res;		
	}
	public function getAllLocations()
	{
		$sql="CALL GetAllLocations()";
		$this->_setSql($sql);
		$res = $this->getAll();			
		return $res;		
	}
	public function getRolesByEmpid($id)
	{
		$sql="CALL GetrolesByempid($id)";
		$this->_setSql($sql);
		$res = $this->getAll();			
		return $res;		
	}
	public function getEmployeesByRoleId($role_id)
	{
		$sql="CALL GetEmployeesByRoleId($role_id)";
		$this->_setSql($sql);
		return $this->getAll();
	}
	public function insertEmployeesDetails($empid,$firstname,$lastname,$email,$contactno,$address,$managerid,$password,$createdby,$createdon,$modifiedby,$modifiedon,$status,$rolls,$locationid)
	{
		
		
		 $sql="CALL InsertEmployeeDetails('$empid','$firstname','$lastname','$email','$contactno','$address','$managerid','$password','$createdby',$createdon,'$modifiedby',$modifiedon,'$status','$rolls',@p,'$locationid');";
		$this->_setSql($sql);
	    $this->insertRow();
		$this->_setSql("SELECT @p as msg");
		$result = $this->getAll();
		return $result[0]['msg'];
		
	}
	public function EdittEmployeesDetails($empid,$firstname,$lastname,$email,$contactno,$address,$managerid,$password,$createdby,$createdon,$modifiedby,$modifiedon,$status,$rolls,$id,$locationid)
	{
		
	   $sql="CALL EditEmployeeDetails ('$empid','$firstname','$lastname','$email','$contactno','$address','$managerid','$password','$createdby',$createdon,'$modifiedby',$modifiedon,'$status','$rolls',@p,'$id','$locationid');";
		$this->_setSql($sql);
	    $this->insertRow();
		$this->_setSql("SELECT @p as msg");
		$result = $this->getAll();
		return $result[0]['msg'];
		
	}
	public function getLeavesByEmpId($id)
	{
		$sql="CALL GetLeavesByEmpid($id)";
		$this->_setSql($sql);
		return $this->getAll();
	}
	public function editLeavesByEmpId($id,$createdby,$els,$nels)
	{
		$sql="CALL EditLeavesByEmpId('$id','$createdby','$els','$nels',@p)";
		$this->_setSql($sql);
	    $this->insertRow();
		$this->_setSql("SELECT @p as msg");
		$result = $this->getAll();
		return $result[0]['msg'];
	}
	public function pagination($tpages,$cpage,$limit,$ext){
	
			//echo "<pre>";
		//print_r($employees[0]['count']);
		
		$total_pages = $tpages;
		$limit = $limit;
		$page = mysql_real_escape_string($cpage);
    	if($page){
       		 $start = ($page - 1) * $limit;
    	}else{
        	 $start = 0;
        } 
		if ($page == 0){$page = 1;}
		 $prev = $page - 1; 
		 $next = $page + 1;                         
		 $lastpage = ceil($total_pages/$limit);     
		 $LastPagem1 = $lastpage; 
	$stages = 3;
	$targetpage ='';
	         $paginate = '';
    if($lastpage > 1)
    {  
     
        $paginate .= "<div class='paginate'>";
        // Previous
        if ($page > 1){
            $paginate.= "<a href='$targetpage?page=$prev$ext'>previous</a>";
        }else{
            $paginate.= "<span class='disabled'>previous</span>"; }
             
 
         
        // Pages   
        if ($lastpage < 7 + ($stages * 2))   // Not enough pages to breaking it up
        {  
            for ($counter = 1; $counter <= $lastpage; $counter++)
            {
                if ($counter == $page){
                    $paginate.= "<span class='current'>$counter</span>";
                }else{
                    $paginate.= "<a href='$targetpage?page=$counter$ext'>$counter</a>";}                 
            }
        }
        elseif($lastpage > 5 + ($stages * 2))    // Enough pages to hide a few?
        {
            // Beginning only hide later pages
            if($page < 1 + ($stages * 2))       
            {
                for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
                {
                    if ($counter == $page){
                        $paginate.= "<span class='current'>$counter</span>";
                    }else{
                        $paginate.= "<a href='$targetpage?page=$counter$ext'>$counter</a>";}                 
                }
                $paginate.= ">...>";
                $paginate.= "<a href='$targetpage?page=$LastPagem1$ext'>$LastPagem1</a>";
                $paginate.= "<a href='$targetpage?page=$lastpage$ext'>$lastpage</a>";    
            }
            // Middle hide some front and some back
            elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
            {
                $paginate.= "<a href='$targetpage?page=1$ext'>1</a>";
                $paginate.= "<a href='$targetpage?page=2$ext'>2</a>";
                $paginate.= ">...>";
                for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
                {
                    if ($counter == $page){
                        $paginate.= "<span class='current'>$counter</span>";
                    }else{
                        $paginate.= "<a href='$targetpage?page=$counter$ext'>$counter</a>";}                 
                }
                $paginate.= ">...>";
                $paginate.= "<a href='$targetpage?page=$LastPagem1$ext'>$LastPagem1</a>";
                $paginate.= "<a href='$targetpage?page=$lastpage$ext'>$lastpage</a>";    
            }
            // End only hide early pages
            else
            {
                $paginate.= "<a href='$targetpage?page=1$ext'>1</a>";
                $paginate.= "<a href='$targetpage?page=2$ext'>2</a>";
                $paginate.= ">...>";
                for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page){
                        $paginate.= "<span class='current'>$counter</span>";
                    }else{
                        $paginate.= "<a href='$targetpage?page=$counter$ext'>$counter</a>";}                 
                }
            }
        }
                     
                // Next
        if ($page < $counter - 1){
            $paginate.= "<a href='$targetpage?page=$next$ext'>next</a>";
        }else{
            $paginate.= "<span class='disabled'>next</span>";
            }
             
        $paginate.= "</div>";      
     
     
}
// echo $total_pages.' Results';
 // pagination
 return $paginate;
	}
	public function insertEmployeesLeave($emptblno,$fromdate,$todate,$numdays,$resumeon,$els,$nels,$reason,$address,$contact,$currentproject,$managerid,$createdby,$createdon,$modifiedby,$modifiedon,$status,$type,$userid,$start,$limit,$remarks)
	{
		
		
		   $sql="CALL  Leaverequest('$emptblno','$fromdate','$todate','$numdays','$resumeon','$els','$nels','$reason','$address','$contact','$currentproject',$managerid,'$createdby',$createdon,$modifiedby,$modifiedon,'$status','$type','$userid','$start','$limit','$remarks')";
	
	      $this->_setSql($sql);
		  $this->insertRow();
	      
	}
	
	public function editEmployeesLeave($emptblno,$fromdate,$todate,$numdays,$resumeon,$els,$nels,$reason,$address,$contact,$currentproject,$managerid,$createdby,$createdon,$modifiedby,$modifiedon,$status,$type,$userid,$start,$limit,$remarks)
	{
		
		
	$sql="CALL  Leaverequest('$emptblno','$fromdate','$todate','$numdays','$resumeon','$els','$nels','$reason','$address','$contact','$currentproject',$managerid,'$createdby',$createdon,$modifiedby,$modifiedon,'$status','$type','$userid','$start','$limit','$remarks')";
	
	 $this->_setSql($sql);
	 return $this->getAll();
	      
	}
	public function getEmployeeLeavesById($id)
	{
		$sql = "CALL GetLeavesByEmpid($id)";
		$this->_setSql($sql);
		$res = $this->getAll();
		return $res;
	}
	
	public function getRequestedLeaves($id)
	{
		$fromdate = date('Y-m-01');
		$rqstdLeave = "CALL Leaverequest('$id','$fromdate','','','','','','','','','','','','','','','','10','','','','')";
		$this->_setSql($rqstdLeave);
		return $this->getAll();
	}
	
		public function deleteUser($id)
	{
		
		$rqstdLeave = "CALL deleteUser('$id')";
		$this->_setSql($rqstdLeave);		
		$res = $this->getAll();
		return $res;
	}

	
}