<?php

include 'header.php';
include 'connect.php';
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
 
?>
<?php if(!empty($_SESSION) && $_SESSION['signed_in']): ?>
<?php
$cat_name=$cat_description=$cat_name_Err="";
 
$cat_name_test=$cat_description_test=true;

if(isset($_POST['createcat']))
{
	if (empty($_POST["cat_name"])) {
     $cat_name_Err =" *Category Name is required"; 
	 $cat_name_test =  false;
   } else {
     $cat_name = test_input($_POST['cat_name']);
	 $cat_name_test =  true;
   }
	

   if (empty($_POST["cat_description"])) {
     $cat_description_Err =" *Category Description is required"; 
	 $cat_description_test =  false;
   } else {
     $cat_description = test_input($_POST['cat_description']);
	 $cat_description_test =  true;
   }

 
 
if( $cat_name_test === true && $cat_description_test==true )
	{
	  $sql="INSERT INTO categories(cat_name,cat_description) VALUES ('$cat_name','$cat_description')";
      mysqli_query($conn,$sql);
      header("Location:index.php");

	} 

}


?>

<?php
$cat = (isset($_POST['cat_name'])) ? $_POST['cat_name'] : '';
$desc = (isset($_POST['cat_description'])) ? $_POST['cat_description'] : '';

?>

<link href="css/category.css" type="text/css" rel="stylesheet" />

<form action=""  method = "POST"><br>


<fieldset name="category" class="category" />
<legend>Create Category</legend>
<p>

		<label>Category Name:  </label>
		<input type="text" name="cat_name" style="font-size:14px;" value="<?php print $cat;?>"/>
	    
</p>
        


<p>

		<label>Category Description: </label><br>
		<textarea style="font-size:14px;" name="cat_description"  value="<?php print $desc;?>"/>  </textarea>
	    
        
       
<br>


<input type="submit" name="createcat" value="Add Category">
&nbsp&nbsp;
<span class="error"><?php echo $cat_name_Err;?></span><br>
<input type="reset" name="reset" value="Reset">


</fieldset>
</form>

<?php else: ?>
	<?php echo '<p>Sorry,you must be signed in to add a Category.<a href="login.php">Click here</a> to login .</p>';?>
<?php endif ; ?>	
<?php include "footer.php" ; ?>
	