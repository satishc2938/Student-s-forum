<?php 

include 'connect.php';
include 'header.php';     
?>


<p>Welcome , <b style="font-size: 18px"><?php echo $_SESSION['user_name'] ; ?></b> .You can now <a href="index.php">Proceed to Forum Overview.</a> </p>
<?php include 'footer.php';  ?>
