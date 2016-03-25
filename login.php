<?php include 'connect.php';
      include 'header.php';     
	  
	  $uname=$pass="";
	  $uname_Err=$uname_flag="";
	  
	  function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
	  
?>	  
<?php if(isset($_SESSION['signed_in']) && $_SESSION['signed_in']==TRUE): ?>

<p>You are already logged in , you can <a href="logout.php">logout</a> if you want.</p>

<?php else: ?>
<?php 
     
     if(isset($_POST['login'])){
     	
		if(empty($_POST['uname']) || empty($_POST['pass'])){
			$uname_Err = "*Please fill all fields ";
		    $uname_flag = FALSE;
		}
		else{
			$uname= test_input($_POST['uname']);
			$pass= test_input($_POST['pass']);
			$sql = "SELECT 
                        user_id,
                        user_name,
                        user_level
                    FROM
                        users
                    WHERE
                        user_name = '" .$uname. "'
                    AND
                        user_pass = '" . sha1($pass). "'";
           $result = mysqli_query($conn, $sql) ;
		   if(!$result)
            {
                echo 'Something went wrong while signing in. Please try again later.';
                
            }
            else
            {
            	if(mysqli_num_rows($result)==0){
            		
					$uname_Err = "*Wrong Username/Password combination";
				}
				else{
			    	       	
			    	$_SESSION['signed_in'] = true;             
			        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			        	$_SESSION['user_id']    = $row['user_id'];
                        $_SESSION['user_name']  = $row['user_name'];
                        $_SESSION['user_level'] = $row['user_level'];
			        }
				    header("Location:loginsuccess.php"); 
				}
		    }
     
	 }   	
}

?>
<link rel="stylesheet" href="css/signup.css" type="text/css">

<form name="login" method="post" action = "" >
		<fieldset class="login-form">
			<legend style="text-align: center;">Login</legend>
		<p>		
		<label>User Name : </label> <br>
		<input type="text" name="uname"  value="<?php echo $uname; ?>" />
		</br>
        </p>
       <p>		
		<label>Password : </label><br> 
		<input type="password" name="pass"  value="<?php echo $pass; ?>" />
		<br>
       </p>
       
		<hr>
		
		<br>
		<center><input  type="submit"  name="login" value="Login">
			
			<center>
		<br>
		<span class="error"><?php echo $uname_Err ; ?></span>		
	</fieldset>

	</form>
	

<?php endif; ?>
<?php include 'footer.php';  ?>
