<?php

// database details
$mysql_hostname="localhost";
$mysql_user="root";
$mysql_password= "root";
$mysql_database="Homework2";  

// connect to mysql and the database
$connect=mysql_connect($mysql_hostname, $mysql_user, $mysql_password)
or die("Couldn't connect</br>" .  mysql_error());
echo "Connection Successful</br>";
mysql_select_db($mysql_database) or die("Oops couldn't find the database\n". mysql_error());
echo "Found DB</br></br>";

// create variables from inputs
$cur_email=$_POST["email"];
$cur_password=$_POST["password"];


$sql= "SELECT * FROM Users WHERE email='$cur_email'";
$result = mysql_query($sql);
if(mysql_num_rows($result) == 0){
	die("EmailID does not exist");
}


// some result has been returned, check password
$sql= "SELECT * FROM Users WHERE email='$cur_email' AND password='$cur_password'";
$result = mysql_query($sql);
if(mysql_num_rows($result) == 0){
	die("Invalid password");
}
$row = mysql_fetch_array($result);
echo "Welcome back ". $row['firstname'] . " " . $row['lastname'] . "</br>";


// display users when admin is logged in
if ($row['email'] == 'admin@admin.com'){

	$sql= "SELECT * FROM Users";
	$result = mysql_query($sql);

	$count=mysql_num_rows($result);

	echo "</br>List of users:</br></br>";

	$counter=1;
	while ($row = mysql_fetch_array($result)){
		echo $counter.") ".$row['firstname']." ".$row['lastname']."</br>";
$counter++;
}

}


?>
