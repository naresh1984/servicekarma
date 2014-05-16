<?php
class Mailer
{
	
	protected $_from;
	protected $_to;
	protected $_cc = NULL;
	protected $_bcc;
	protected $_subject;
	protected $_body;
	protected $_headers;
	protected $_params;
	protected $_template;
	protected $_name;
	protected $_employeeName = NULL;
	
	public function addTo($to,$name)
	{
		$this->_to = $to;
		$this->_name = $name;
	}
	
	public function addEmpName($name)
	{
		$this->_employeeName = $name;
	}
	
	public function addCc($cc)
	{
		$this->_cc = $cc;
	}
	
	public function setFrom($from)
	{
		$this->_from = $from;
	}
	
	public function setSubject($subject)
	{
		$this->_subject = $subject;
	}	
	
	public function getParams($params)
	{
		$this->_params = $params;
	}
	
	public function send()
	{
	  $this->_headers  = 'MIME-Version: 1.0' . "\r\n";
	  $this->_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";	
	  if($this->_cc!=NULL){
		  $this->_headers .= 'Cc: ' .$this->_cc. "\r\n";
	  }
	  $this->_template = $this->setTemplate();
	  $this->_headers .= "From: Servicekarma <".$_SESSION['user']['email'].">" . "\r\n";
	  $sendmail = mail($this->_to, $this->_subject, $this->_template, $this->_headers);
	  if(!$sendmail){
		  throw new Exception("Error sending mail.");
	  }
	}
	
	public function setTemplate()
	{
		$output = '
		<p style="font-family:Arial, Helvetica, sans-serif; font-size:12px;"><strong>Hi, ';
		if($this->_employeeName!=NULL){
			$output .= $this->_employeeName;
		}
		$output .= '</strong></p>
<table cellpadding="0" cellspacing="0" border="0" width="100%" style="border:solid 1px #aeaeae; border-collapse:collapse; font-family:Arial, Helvetica, sans-serif; font-size:12px;">	
	<tr>
    	<th colspan="2" style="text-align:left; background:#CCC; padding:5px;" height="10">'.$this->_subject.'</th>
    </tr>';
	if(!empty($this->_params)){
		foreach($this->_params as $key=>$val){
		$output .= '<tr><th style="border:solid 1px #aeaeae; text-align:left; padding:5px;" height="10">';
		$output .= $key;
		$output .= ':</th>';
        $output .= '<td style="border:solid 1px #aeaeae; padding:5px;" height="10">';
		$output .= stripslashes($val);
		$output .= '</td></tr>';
		}
	}
	$output .= '</table>
				<p style="font-family:Arial, Helvetica, sans-serif; font-size:12px;"><strong>Note:</strong> Please <a href="http://183.82.1.3:8090/olm/" style="text-decoration:underline;">click here</a> for more details.<br><br><strong>Thank you,<br> OLM</strong></p>';
		return $output;
	}
	
	public function sendRejectEmail()
	{
	  $this->_headers  = 'MIME-Version: 1.0' . "\r\n";
	  $this->_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";	
	  if($this->_cc!=NULL){
		  $this->_headers .= 'Cc: ' .$this->_cc. "\r\n";
	  }
	  $this->_template = $this->setRejectEmailTemplate();
	  $this->_headers .= "From: Servicekarma <info@servicekarma.com>" . "\r\n";
	  $sendmail = mail($this->_to, $this->_subject, $this->_template, $this->_headers);
	  if(!$sendmail){
		  throw new Exception("Error sending mail.");
	  }
	}
	
	public function setRejectEmailTemplate()
	{
		$output = '
		<p style="font-family:Arial, Helvetica, sans-serif; font-size:12px;"><strong>Hi, ';
		if($this->_name!=NULL){
			$output .= $this->_name;
		}
		$output .= '</strong></p>
<table cellpadding="0" cellspacing="0" border="0" width="100%" style="border:solid 1px #aeaeae; border-collapse:collapse; font-family:Arial, Helvetica, sans-serif; font-size:12px;">	
	<tr>
    	<th style="text-align:left; background:#CCC; padding:5px;font-family:Arial, Helvetica, sans-serif; font-size:12px;" height="10">'.$this->_subject.'</th>
    </tr>';
	if(!empty($this->_params)){
		$organization_event = $this->_params['organization_event'];
		$from_date = $this->_params['from_date'];
		$to_date = $this->_params['to_date'];
		$hours = $this->_params['hours'];
		$minutes = $this->_params['minutes'];
		$rejected_reason = $this->_params['rejected_reason'];		
	}
	
	$output .= "<tr><td style='font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:5px;'>Your login details are</td></tr>	
	<tr>
	  <td style='font-family:Arial, Helvetica, sans-serif; font-size:12px;padding:5px;'>Your contribution to '".$organization_event."', 'Date Range:".$from_date." - ".$to_date."', '".$hours."hr ".$minutes."min' has been rejected. Reason is '".$rejected_reason."'</td>	  
	</tr>
	<tr><td>&nbsp;</td></tr>";
	
	$output .= '</table>
				<p style="font-family:Arial, Helvetica, sans-serif; font-size:12px;"><strong>Note:</strong> Please <a href="http://183.82.1.3:8090/servicekarma/" style="text-decoration:underline;">click here</a> for more details.<br><br><strong>Thank you,<br> Servicekarma</strong></p>';
		return $output;
	}
}