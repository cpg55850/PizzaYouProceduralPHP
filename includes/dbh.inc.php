<?php

$host = "localhost";
$username = "root";
$password = "root";
$dbname = "pizza2";

$conn = mysqli_connect($host, $username, $password, $dbname);

if(!$conn){
	die("Connection failed: ".mysli_connect_error());
}