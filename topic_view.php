<?php

include 'connect.php';
include 'header.php';

 echo'<link href="css/inside.css" type="text/css" rel="stylesheet" />';
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
$sql = " SELECT
    topic_id,
    topic_subject
FROM
    topics
WHERE
    topics.topic_id = ".test_input($_GET['id']);

 
$result = mysqli_query($conn,$sql);
 
if(!$result)
{
    echo 'The topics could not be displayed, please try again later.' ;
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'This topic does not exist.';
    }
    else
    {
        
        while($row = mysqli_fetch_array($result,MYSQL_ASSOC))
        {
            echo '<h2>Posts in ' . $row['topic_subject'] . ' topic</h2>';
            $topic_name = $row['topic_subject'];
         
		}
         
         
         $sql = "SELECT
    posts.post_id,     
    posts.post_topic,
    posts.post_content,
    posts.post_date,
    posts.post_by,
    users.user_id,
    users.user_name
    FROM
    posts
    LEFT JOIN
    users
    ON
    posts.post_by = users.user_id
    WHERE
    posts.post_topic = " .test_input($_GET['id']);
         
        $result = mysqli_query($conn,$sql);
         
        if(!$result)
        {
            echo 'The posts could not be displayed, please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                echo 'There are no posts in this topic yet.';
            }
            else
            {
             
                echo '<table class = "inside" >
                      <tr>
                        <th colspan="2">'.$topic_name.'</th>
                        
                      </tr>'; 

                if(!empty($_SESSION) && $_SESSION['user_level']=='1')
                {     
                   while($row = mysqli_fetch_array($result,MYSQL_ASSOC))
		           {               
                    echo '<tr>';
                        echo '<td>';
                            echo '<p><span style="color:green;font-size:18px;font-weight:bold; padding:3px;">'.$row['user_name'].'</span><br>'.$row['post_date'].'</p>';
                        echo '</td>';
                        echo '<td style="text-align:center;">';
                            echo $row['post_content'];
                            echo'<br><a style="float:right;" href ="delete_post.php?id='.$row['post_id'].'&&topic_id='.$row['post_topic'].'" >delete</a>';
                        echo '</td>';
                    echo '</tr>';
					$topic_idr = $row['post_topic'];
					
                   }
                   echo "</table><br><br>";
                }
                else
                {     
                   while($row = mysqli_fetch_array($result,MYSQL_ASSOC))
                   {               
                    echo '<tr>';
                        echo '<td >';
                            echo '<p><span style="color:green;font-size:18px;font-weight:bold; padding:3px;">'.$row['user_name'].'</span><br>'.$row['post_date'].'</p>';
                        echo '</td>';
                        echo '<td    style="text-align:center;">';
                            echo $row['post_content'];
                            echo '</td>';
                    echo '</tr>';
                    $topic_idr = $row['post_topic'];
                    
                   }
                   echo'</table><br><br>';
                }   
                
				echo '<form  method="post" action="reply.php?id='.$topic_idr.'">
                <fieldset class="reply-form">
                <textarea name="reply-content"></textarea>
                <input type="submit" name="reply" value="Submit reply" />
                </fieldset>
                </form><br><br><br>' ;
            }
               
        }

    }
}

//include 'footer.php';
?>
		
        