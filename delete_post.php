<?php
      include 'connect.php';
      include 'header.php';  

  $post_id = $_GET['id'];
  $topic_id = $_GET['topic_id']; 

  $qry = "DELETE FROM posts WHERE post_id='".$post_id."' ";
  $result = mysqli_query($conn,$qry);
 if(!$result)
 	echo 'The post cannot be deleted. Please try again later..';
 else
 	echo 'Post deleted successfully. Return to <a href="topic_view.php?id='. $topic_id . '">topic view page</a>.';

?>

<?php  include 'footer.php';?>