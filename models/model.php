<?php 
class Model
{
	protected $_db;
	protected $_sql;
	
	public function __construct()
	{
		$this->_db = DB::init();
	}
	
	protected function _setSql($sql)
	{
		$this->_sql = $sql;
	}
	
	public function getAll($data = null)
	{
		if(!$this->_sql)
		{
			throw new Exception("No SQL query!");
		}

		$sth = $this->_db->prepare($this->_sql);
		$sth->execute($data);
		$result = $sth->fetchAll();
		return $result;
	}
	
	public function getRow($data = null)
	{
		if (!$this->_sql)
		{
			throw new Exception("No SQL query!");
		}
		
		$sth = $this->_db->prepare($this->_sql);
		$sth->execute($data);
		$result = $sth->fetch();
		return $result;	
	}
	public function insertRow($data = null)
	{
		if (!$this->_sql)
		{
			throw new Exception("No SQL query!");
		}
	
		$sth = $this->_db->prepare($this->_sql);
		$sth->execute($data);
		//$result = $sth->fetch();
		//return $result;	
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
	
}