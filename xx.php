<?php
// MYSQL
$mysql = mysql_connect("50.63.244.83", "Dummyd", "Logictree@2013");
echo $db = mysql_select_db("Dummyd", $mysql);

/*print "<h3>MYSQL: simple select</h3>";
$rs = mysql_query( "SELECT * FROM users;" );
while($row = mysql_fetch_assoc($rs))
{
debug($row);
}

print "<h3>MYSQL: calling sp with out variables</h3>";
$rs = mysql_query( "CALL get_user(1, @first, @last)" );
$rs = mysql_query( "SELECT @first, @last" );
while($row = mysql_fetch_assoc($rs))
{
debug($row);
}

print "<h3>MYSQL: calling sp returning a recordset – doesn\"t work</h3>";
$rs = mysql_query( "CALL get_users()" );
while($row = mysql_fetch_assoc($rs))
{
debug($row);
}

// MYSQLI
$mysqli = new mysqli("localhost", "root", "", "mydatabase");

print "<h3>MYSQLI: simple select</h3>";
$rs = $mysqli->query( "SELECT * FROM users;" );
while($row = $rs->fetch_object())
{
debug($row);
}

print "<h3>MYSQLI: calling sp with out variables</h3>";
$rs = $mysqli->query( "CALL get_user(1, @first, @last)" );
$rs = $mysqli->query( "SELECT @first, @last" );
while($row = $rs->fetch_object())
{
debug($row);
}

print "<h3>MYSQLI: calling sp returning a recordset</h3>";
$rs = $mysqli->query( "CALL get_users()" );
echo "<pre>ssss";
print_r($rs );
echo "<pre>ssss";
while($row = $rs->fetch_object())
{
debug($row);
}

// PDO
$pdo = new PDO("mysql:dbname=mydatabase;host=localhost", "root", "");

print "<h3>PDO: simple select</h3>";
foreach($pdo->query( "SELECT * FROM users;" ) as $row)
{
debug($row);
}

print "<h3>PDO: calling sp with out variables</h3>";
$pdo->query( "CALL get_user(1, @first, @last)" );
foreach($pdo->query( "SELECT @first, @last" ) as $row)
{
debug($row);
}

print "<h3>PDO: calling sp returning a recordset</h3>";
foreach($pdo->query( "CALL get_users()" ) as $row)
{
debug($row);
}

function debug($o)
{
print "<pre>";
print_r($o);
print "</pre>";
}*/
?>