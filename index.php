<?php include'header.php' ?>

<link href="css/home.css" type="text/css" rel="stylesheet">
<?php

include 'connect.php';
 
$sql = " SELECT
            cat_id,
            cat_name,
            cat_description,
            topics.topic_subject,
            topics.topic_date,
            topics.topic_cat
        FROM
            categories 
            LEFT JOIN
            topics
            ON 
            topics.topic_cat=cat_id ";
        
           
 
$result = mysqli_query($conn,$sql);
 
if(!$result)
{
    echo 'The categories could not be displayed, please try again later.';
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'No categories defined yet.';
    }
    else
    {
        
        echo '<table id="home-table">
              <tr>
                <th>Category</th>
                <th>Last topic</th>
              </tr>'; 
        
            
        while($row = mysqli_fetch_assoc($result))
        {               
            echo '<tr>';
                echo '<td>';
                    echo '<h3><a href="cat_view.php?id='.$row['cat_id'].'">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
                echo '</td>';
                echo '<td>';
                if($row['topic_subject'] != "")            
                            echo '<a href="topic.php?id=">'.$row['topic_subject'].'</a> on '.$row['topic_date'].' ';
                else
                            echo 'No topics ';

                echo '</td>';
            echo '</tr>';
        }
        echo'</table><br><br><br>';
    }
}
?>


<?php include'footer.php' ?>

</body>
</html>