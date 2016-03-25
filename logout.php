<?php
session_start();

session_destroy(); 
$_SESSION['signed_in']=FALSE;
header("Location:index.php");

?>