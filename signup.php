<?php

//connet to database, info to pass to function
$mysql_hostname="localhost";
$mysql_user="root";
$mysql_password="root";
$mysql_database= "Homework2";

$connect=mysql_connect($mysql_hostname, $mysql_user, $mysql_password)
or die("Couldn't connect");
echo "<br>";
echo "Connection Successful";
echo "<br>";
mysql_select_db($mysql_database, $connect) or die("Oops couldn't find the database");


$Firstname = $_POST["signup-firstname"];
$Lastname = $_POST["signup-lastname"];
$Email= $_POST["signup-email"];
$Password= $_POST["signup-password"];
$Password2= $_POST["signup-repassword"];
$taken= 0;

// check if password is empty
if($Password == "")
	die("Password field empty");
if(strlen($Password) < 10 )
	die("Password is less than 10 characters");

// check if passwords match
if ($Password != $Password2) 
	die("Passwords do not match");

// check if email is in correct format
if(!filter_var($Email, FILTER_VALIDATE_EMAIL))
	die("Email is in incorrect format");

// if yes, then check if email exists
$sql = "SELECT email FROM Users";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
	if ($row['email'] == $Email){
		die(" Email is already taken</br>");
	}
}

// if email does not exist, enter it into the db
$sql = "INSERT INTO Users(Firstname, Lastname, Email, Password) VALUES ('$Firstname','$Lastname','$Email','$Password')";
$confirm = mysql_query($sql);
if ($confirm) 
	echo "1 record added</br>";
else 
	echo "Couldnt enter data". mysql_error();

?>


