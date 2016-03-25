<?php
$server="localhost";
$db_username="root";
$db_password="";
$database="studentforum";

$conn=new mysqli($server,$db_username,$db_password,$database);
       if($conn->connect_errno > 0){
         die('Sorry, We\'re experiencing some connection problems.'); 
       }
	  

?>