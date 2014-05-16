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
    public function getLeavesHtml($id)
	{
		$els = 0;
		$nels = 0;
		$sumOfLeaves = 0;
				
		$controller = new EmployeesController('Employees', 'getAllLeaves');
		
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
}