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
	protected $_managerName = NULL;
	protected $_url = "http://183.82.1.3:8090/olm/";
	
	public function addTo($to,$name)
	{
		$this->_to = $to;
		$this->_name = $name;
	}
	
	public function addMngName($name)
	{
		$this->_managerName = $name;
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
	
	public function addUrl($url)
	{
		$this->_url = $url;
	}	
	
	public function send()
	{
		$this->_headers  = 'MIME-Version: 1.0' . "\r\n";
		$this->_headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";	
		if($this->_cc!=NULL){
			$this->_headers .= 'Cc: ' .$this->_cc. "\r\n";
		}
		$this->_headers .= "From: LogictreeIT <olm@logictreeit.com>" . "\r\n";
		$this->_template = 	$this->setTemplate();
		$sendmail = mail($this->_to, $this->_subject, $this->_template, $this->_headers);
		if(!$sendmail){
			throw new Exception("Error sending mail.");
		}
	}
	
	public function setTemplate()
	{
		$output = '
		<p style="font-family:Arial, Helvetica, sans-serif; font-size:12px;"><strong>Hi ';
		if($this->_managerName!=NULL){
			$output .= $this->_managerName;
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
				<p style="font-family:Arial, Helvetica, sans-serif; font-size:12px;"><strong>Note:</strong> Please <a href="'.$this->_url.'" style="text-decoration:underline;">click here</a> for more details.<br><br><strong>Thank you,<br> OLM</strong></p>';
		return $output;
	}

}