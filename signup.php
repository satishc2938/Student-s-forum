<?php include 'connect.php';
      include 'header.php';     

$uname = $pass = $repass = $email = "";
$uname_Err = $pass_Err = $repass_Err = $email_Err = "";
$uname_flag = $pass_flag = $repass_flag = $email_flag = TRUE;


if(isset($_POST['signup'])){
	
	if(empty($_POST['uname'])){
		$uname_Err="*Please enter username";
		$uname_flag = FALSE;
		
	}
	else{
		$uname= test_input($_POST['uname'])	;
		if(strlen($uname)>30){
            			$uname_Err="*Username cannot be greater than 30 characters";
			            $uname_flag = FALSE;
		}
		else {
			$uname= test_input($_POST['uname'])	;
			 $uname_flag = TRUE;
		}
		
	}
	
	if(empty($_POST['pass'])){
		$pass_Err="*Please enter password";
		$pass_flag=FALSE;
		
	}
	else{
		$pass = test_input($_POST["pass"]);
        if (!preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$',$pass)) {
        $pass_Err = "Atleast 1 uppercase, 1 lower case , 1 numeric and 1 special character ";
	    $pass_flag = false;
   
       }
	  	
	}
	
	if(empty($_POST['repass'])){
		$repass_Err="*Please confirm password";
		$repass_flag=FALSE;
		
	}
	else{
		$repass = test_input($_POST["repass"]);	
		if($repass != $pass){
			$repass_Err="*Passwords did not match";
			$repass_flag = false;
		}
		
	}
	
	if(empty($_POST['email'])){
		$email_Err="*Please enter your email";
		$email_flag=FALSE;
		
	}
	else{
		$email=test_input($_POST['email']);
		if(!filter_var($email,FILTER_VALIDATE_EMAIL))	{
		     $email_Err = " *Invalid email format";
		     $email_flag=false;
	   
	   }
		
	}
	
	
	if($uname_flag==TRUE && $pass_flag==TRUE && $repass_flag==TRUE && $email_flag==TRUE ){
		
		$reg = "INSERT INTO users(user_name, user_pass, user_email ,user_date, user_level) VALUES('".$uname."','".sha1($pass)."','".$email."',NOW(),0) ";
	    mysqli_query($conn, $reg); 
        header("Location:login.php"); 	
	}
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

?>

<link rel="stylesheet" href="css/signup.css" type="text/css">


	<form name="signup" method="post" action = "" >
		<fieldset class="signup-form">
			<legend style="text-align: center;">Signup</legend>
		<p>		
		<label>User Name : </label> 
		<input type="text" name="uname"  value="<?php echo $uname; ?>" />
		<span class="error"><?php echo $uname_Err;?></span></br>
        </p>
       <p>		
		<label>Password : </label> 
		<input type="password" name="pass"  value="<?php echo $pass; ?>" />
		<span class="error"><?php echo $pass_Err;?></span></br>
       </p>
       <p>		
		<label>Confirm Password : </label> 
		<input type="password" name="repass"  value="<?php echo $repass; ?>" />
		<span class="error"><?php echo $repass_Err;?></span></br>
       </p>
       <p>		
		<label>Email : </label> 
		<input type="text" name="email"  value="<?php echo $email ; ?>" />
		<span class="error"><?php echo $email_Err;?></span></br>
       </p>
       
		<hr>
		
		
		<center><input style="width: 100px;" type="submit"  name="signup" value="Register">&nbsp&nbsp;
			<input style="width: 100px;" type="reset"  value="Reset">
			<center>
	</fieldset>

	</form>
	


<?php //include 'footer.php'; ?>