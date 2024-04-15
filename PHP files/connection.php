<?php
$username='root';
$password='Adbms2023#';
$databasename='mydb';
$con=mysqli_connect('localhost',$username,$password,$databasename);
if(mysqli_connect_errno())
{
	echo'Failed to connect to mysql'.mysqli_connect_errno();
}
else
	echo "database connected";
?>