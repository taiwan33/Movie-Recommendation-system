<html lang="en">
<head>
    <link rel="stylesheet" href="css.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
    
</body>
</html>
<div class="container">
<?php

include("header.php");
include("db.php");

?>

<div class="panel_panel-default">
    <div class="panel-heading">

    <div class ="panel-heading">
    <h2>
    <a class="btn_btn-success" href="add_user.php">Add Users</a>
     <a class="btn_btn-info_pull-right"  href="index.php"> Home </a>
    </h2><br></br> 
</div>

</div>
</div>

<div class="panel-body">


<?php

$username = $_GET['user_name'];

$result=mysqli_query($con,"SELECT * FROM user_movies WHERE user_id='$_GET[user_id]'"); 


if(mysqli_num_rows($result)>0){
?>
<h3>Movies added by <?php echo $username ?></h3>

<table class="table_table-striped">
<th> Movie Name </th>
<td></td><td></td>
<th>Movie rating</th>


<?php 


while($row=mysqli_fetch_array($result))
{
?>
<tr>


<td><?php echo $row ['movie_name']; ?></td>
<td></td><td></td>
<td><?php 
    $rating = $row['movie_rating'];
    if($rating>4){
        echo "You will surely like this movie";
    }else if($rating>2){
        echo "You may like this movie";
    }else{
        echo "You may not like this movie";
    }
    ?>
    </td>
</tr>


<?php 
} ?> 

</table>
<?php }else{
    echo "No movies added by ".$username;
} ?>

</div>
