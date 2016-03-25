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
 
$sql = "SELECT
            cat_id,
            cat_name,
            cat_description
        FROM
            categories
        WHERE
            cat_id = " . test_input($_GET['id']);
 
$result = mysqli_query($conn,$sql);
 
if(!$result)
{
    echo 'The category could not be displayed, please try again later.' . mysqli_error($conn);
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'This category does not exist.';
    }
    else
    {
        
        while($row = mysqli_fetch_array($result,MYSQL_ASSOC))
        {
            echo '<h2>Topics in ' . $row['cat_name'] . ' category</h2>';
        }
         $sql = "SELECT  
                    topic_id,
                    topic_subject,
                    topic_date,
                    topic_cat
                FROM
                    topics
                WHERE
                    topic_cat = " .test_input($_GET['id']);
         
        $result = mysqli_query($conn,$sql);
         
        if(!$result)
        {
            echo 'The topics could not be displayed, please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                echo 'There are no topics in this category yet.';
            }
            else
            {
                
                echo '<table class="inside">
                      <tr>
                        <th>Topic</th>
                        <th>Created at</th>
                      </tr>'; 
                     
                while($row = mysqli_fetch_array($result,MYSQL_ASSOC))
		        {               
                    echo '<tr>';
                        echo '<td  style="text-align:center;">';
                            echo '<h3><a href="topic_view.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><h3>';
                        echo '</td>';
                        echo '<td style="text-align:center;">';
                            echo date('d-m-Y', strtotime($row['topic_date']));
                        echo '</td>';
                    echo '</tr>';
                }
                echo'</table>';
            }
        }
    }
}
 
include 'footer.php';
?>
		
        