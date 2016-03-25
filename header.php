<?php session_start(); ?>

<!DOCTYPE html>
<head>
<link rel="stylesheet" href="css/header.css" type="text/css">
<link rel="stylesheet" href="css/footer.css" type="text/css">

</head>

<body >
 
   <div class = "container"> 
        <div class = "header">
           <div class="left-header">
           <a>
           <img src="images/newlogo.gif" alternate="logo" />
           </a>
    
           </div>
           <div class="right-header">
              <?php if(!empty($_SESSION)): ?>
              <?php if($_SESSION['signed_in']): ?>
                <span>Hello <b><?php echo $_SESSION['user_name'] ?></b>. Not you? <a href="logout.php"><input class="log" type="button" value="Logout"></a></span>
                <?php endif; ?>	
              <?php else: ?>
              <span><a href="login.php"><input class="log" type="button" value="Login"></a> or <a href="signup.php">Register</a></span>           
              <?php endif; ?>
           </div> 
        </div>
        <nav class="navbar">
           <a href="index.php" >Home</a>        
           <a href="create_cat.php" >Create Category</a>
           <a href="topic.php" >Create Topic</a>
            
        </nav> 
   


