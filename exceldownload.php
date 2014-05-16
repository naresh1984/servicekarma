<?php session_start();
$table = 'employees';
$filename = tempnam(sys_get_temp_dir(), "csv");
$caluse = "";

 if($_SESSION['roles_id']==0)
 $sub_clause = "AND location_id = ".$_SESSION['user']['location_id'];
 else
 $sub_clause = "";
 //SELECT * FROM  employees e,leaves l WHERE e.emptblno = l.emptblno AND e.status = 'Active'   AND (e.empid LIKE CONCAT(empid1, '%') OR e.firstname LIKE CONCAT('%',$name, '%') OR e.lastname LIKE CONCAT('%',$name, '%')) ORDER BY e.empid ASC;
$conn = mysql_connect("localhost", "root", "Logictree@123#");
mysql_select_db("leavemgnt",$conn);

$file = fopen($filename,"w");
$empid = str_replace('-','/',@$_REQUEST['emp']);
$name = @$_REQUEST['name'];
if(trim($empid) && trim($name)){
$caluse = " AND (e.empid LIKE '%$empid%'  OR e.firstname LIKE '%$name%'  OR e.lastname LIKE '%$name%') ";
}else if(trim($empid)!='' && trim($name)==''){
$caluse = "AND (e.empid LIKE '%$empid%')";
}else if(trim($empid)=='' && trim($name)!=''){
$caluse = " AND (e.firstname LIKE '%$name%' OR e.lastname LIKE '%$name%')";
}

// Write column names
$result = array('EmpId','FirstName','LastName','ContactNo','Address','Email','ELs','NELs','CompOffs','LOPs','Status');//mysql_query("show columns from $table",$conn);
for ($i = 0; $i < count($result); $i++) {
    $colArray[$i] = $result[$i];
    $fieldArray[$i] = $colArray[$i];
}
fputcsv($file,$fieldArray);

// Write data rows
$result = mysql_query("SELECT e.empid,e.firstname,e.lastname,e.contactno,e.address,e.email,l.els,l.nels,l.compoffs,l.lops,e.status FROM  employees e,leaves l WHERE e.emptblno = l.emptblno  $sub_clause $caluse ORDER BY e.status ASC,e.empid ASC",$conn);
for ($i = 0; $i < mysql_num_rows($result); $i++) {
    $dataArray[$i] = mysql_fetch_assoc($result);
}
foreach ($dataArray as $line) {
    fputcsv($file,$line);
}

fclose($file);

header("Content-Type: application/csv");
header("Content-Disposition: attachment;Filename=logictree_employees_".date('m-d-Y-h:i:s').".csv");

// send file to browser
readfile($filename);
unlink($filename);
?>
	
