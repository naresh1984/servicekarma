<?php
class View
{
	protected $_file;
	protected $_data = array();
	
	public function __construct($file)
	{
		$this->_file = $file;
	}
	
	public function set($key,$value)
	{
		$this->_data[$key] = $value;
	}
	
	public function get($key)
	{
		return $this->_data[$key];
	}
	
	public function output()
	{
		if(!file_exists($this->_file))
		{
			throw new Exception("Template ". $this->_file ." doesn't exist.");
		}
		extract($this->_data);
		ob_start();
		include($this->_file);
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
	}
	
	public function getLeavesHtml($id=NULL)
	{
		$els = 0;
		$nels = 0;
		$sumOfLeaves = 0;
				
		$controller = new EmployeesController('Employees', 'getAllLeaves');
		
		if($id==NULL){
			$id = $_SESSION['employ'][0]['emptblno'];
		}
		
		$employLeaves = $controller->getAllLeaves($id);	
		$els = (!empty($employLeaves)) ? $employLeaves[0]['els'] : 0;
		$nels = (!empty($employLeaves)) ? $employLeaves[0]['nels'] : 0;

		$requestLeaves = $controller->getRqstdLeaves($id);
		
			
		$sumOfLeaves = (!empty($requestLeaves[0]['current_leavedays'])) ? $requestLeaves[0]['current_leavedays'] : 0;
		

		$output = 
		'<table class="table1 width_full sidebox">
          <tr><th colspan="2" class="tabTitle">Available Leaves upto 1st of current month</th></tr>
		  <tr><td>ELs:</td><td>';
		$output .= $els; 
		$output .= '</td></tr>';
		$output .= '<tr><td>NELs:</td><td>';
        $output .= $nels;
        $output .= '</td></tr>';
        $output .= '<tr><td colspan="2"><em>Number of leaves applied/taken from 1st of current month: '.$sumOfLeaves.' days.</em></td></tr></table>';
		return 	$output;
	}
	
	public function getForcedLeaves($id)
	{
		$controller = new EmployeesController('Employees', 'getForcedLeave');	
		$forcedLeaves = $controller->getForcedLeave($id);	
		
		$output = "";
		
		if(count($forcedLeaves)>0){
			$output .= 
			'<table class="table1 width_full">
			  <tr><th colspan="3" class="tabTitle">Forced Leaves</th></tr>
			  <tr><th>S.No.</th><th>Type of Leave</th><th>Date</th></tr>';			
			$counter = 1;  
			foreach($forcedLeaves as $leaves){
			  $output .= 
			  '<tr>
			  	<td align="center">'.$counter.'</td>
				<td align="center">';
			 $leaveList = array();	
			 if($leaves['els']!=0){
			 	$leaveList[] = $leaves['els']." ELs";
			 }
			 if($leaves['nels']!=0){
			 	$leaveList[] = $leaves['nels']." NELs";
			 }
			 if($leaves['lops']!=0){
			 	$leaveList[] = $leaves['lops']." LOPs";
			 }
			 if($leaves['compoffs']!=0){
			 	$leaveList[] = $leaves['compoffs']." Comp Offs";
			 }	
			 if(count($leaveList)>0){
			 	$output .= implode(', ',$leaveList);
			 }
			 $output .= '<td align="center">'.date("d-m-Y",strtotime($leaves['processedon'])).'
			  </td></tr>';	
			  $counter++;
			}
			$output .= "</table>";
		}
		
		return $output;
		
	}
	
	
}