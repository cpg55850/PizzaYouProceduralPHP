<?php
//continue current session
session_start();
//check to see if session variable (uname) is set
//if set destroy the session
if(!empty($_SESSION['u_name'])){
    session_destroy();
}
//redirect the user to the home page
header("Location: ./index.php");
?>