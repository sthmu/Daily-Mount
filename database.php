<?php
$username="root";
$password="";
$servername="localhost";
$database="dailymount";

$sql=mysqli_connect($servername,$username,$password,$database);

if(!$sql){
    die( "connection to database has failed ".mysqli_connect_errno());
}


$connection="Successfully connected to the database";
echo $connection;


?>