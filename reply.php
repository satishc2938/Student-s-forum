
<?php

include 'connect.php';
include 'header.php';
 
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
} 

if(isset($_POST['reply'])){
    
    if(!empty($_SESSION) && $_SESSION['signed_in'])
    {
        
        $sql = "INSERT INTO 
                    posts(post_content,
                          post_date,
                          post_topic,
                          post_by) 
                VALUES ('" . $_POST['reply-content'] . "',
                        NOW(),
                        " . test_input($_GET['id']) . ",
                        " . $_SESSION['user_id'] . ")";
                         
        $result = mysqli_query($conn,$sql);
                         
        if(!$result)
        {
            echo 'Your reply has not been saved, please try again later.';
        }
        else
        {
            echo '<p>Your reply has been saved, check out <a href="topic_view.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.</p>';
        }
    }
    else
    {
        echo '<p>You must be signed in to post a reply.<a href="login.php">Click here</a> to login .</p>';
        
    }
}
 
include 'footer.php';
?>
