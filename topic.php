<?php include 'connect.php';
      include 'header.php';     
echo '<link href="css/category.css" type="text/css" rel="stylesheet" />' ; 
	
	  function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
	  
?>	
<?php if(!empty($_SESSION)): ?>  
<?php if( $_SESSION['signed_in']==FALSE): ?>

<p>Sorry, you have to be <a href="login.php">signed in</a> to create a topic.</p>

<?php else: ?>
<?php 
     
     if(!isset($_POST['topic'])){
			
			
		$sql = "SELECT
                    cat_id,
                    cat_name,
                    cat_description
                FROM
                    categories";
         
        $result = mysqli_query($conn,$sql);
			
			
			
     	
		
			
		if(!$result)
          {
                
                echo 'Something went wrong while signing in. Please try again later.';
                
            }
            else
            {
            	if(mysqli_num_rows($result) == 0)
                {
                
                   if($_SESSION['user_level'] == 1)
                   {
                    echo 'You have not created categories yet.';
                   }
                   else
                   {
                    echo 'Before you can post a topic, you must wait for an admin to create some categories.';
                   }
                }
                else
                {
         
                	echo '
                            <form name="topic" method="post" action = "" >
		                        <fieldset class="topic-form">
			                       <legend style="text-align: center;">Create Topic</legend>
		                          <p>		
		                           <label>Subject : </label> 
		                           <input style="font-size:14px;" type="text" name="topic_subject"  value="" />
		                         
                              </p>'; 
                                     
                	echo '<p><label>Category : </label>
                           <select name="topic_cat">';
                    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                    {
                        echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                    }
                echo '</select></p><br>'; 
                     
                echo '<label>Message : </label><br>
                <textarea style="font-size:14px;" name="post_content" /></textarea>
                    <br><br><input type="submit" name="topic" value="Create topic" />
                    </fieldset>
                 </form>';
            }
        }
				
		    
     
	 }   
   else	{
   	    
          $query  = "BEGIN WORK;";
          $result = mysqli_query($conn,$query);
         
          if(!$result)
          {
            
            echo 'An error occured while creating your topic. Please try again later.';
          }
          else
          {
     
            
            $sql = "INSERT INTO 
                        topics(topic_subject,
                               topic_date,
                               topic_cat,
                               topic_by)
                   VALUES('" . test_input($_POST['topic_subject']) . "',
                               NOW(),
                               " . test_input($_POST['topic_cat']) . ",
                               " . $_SESSION['user_id'] . "
                               )";
                      
            $result = mysqli_query($conn,$sql);
          	if(!$result)
            {
              
                echo 'An error occured while inserting your data. Please try again later.' ;
                $sql = "ROLLBACK;";
                $result = mysqli_query($conn,$sql);
            }
            else
            {
                
                $topicid = mysqli_insert_id($conn);
                 
                $sql = "INSERT INTO
                            posts(post_content,
                                  post_date,
                                  post_topic,
                                  post_by)
                        VALUES
                            ('" . test_input($_POST['post_content']) . "',
                                  NOW(),
                                  " . $topicid . ",
                                  " . $_SESSION['user_id'] . "
                            )";
                $result = mysqli_query($conn,$sql);
                if(!$result)
                {
                    
                    echo 'An error occured while inserting your post. Please try again later.' ;
                    $sql = "ROLLBACK;";
                    $result = mysqli_query($conn,$sql);
                }
                else
                {
                    $sql = "COMMIT;";
                    $result = mysqli_query($conn,$sql);
                     
                    
                    echo 'You have successfully created <a href="topic_view.php?id='. $topicid . '">your new topic</a>.';
                }
            }
				 
			
		}                 	
   		
   	
   }


?>


<?php endif; ?>
<?php else: ?>
<p>Sorry, you have to be <a href="login.php">signed in</a> to create a topic.</p>

<?php endif;?>
<?php include 'footer.php';  ?>