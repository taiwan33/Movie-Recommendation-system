<html lang="en">
<head>
    <link rel="stylesheet" href="css.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Recommendation system</title>
    <link rel="stylesheet" type="text/css" href="css.css">  
</head>
<body>
<div class="container">
    
<?php

include("header.php");
include("db.php");


?>

<div class="panel_panel-default">
    <div class="panel-heading">

    <div class ="panel-heading">
    <h2>
    <a class="btn btn-success" href="add_user.php">Add Users</a>
     <a class="btn btn-info pull-right"  href="index.php"> Home </a>
    </h2><br></br> 
</div>

</div>
</div>

<div class="panel-body">

<table class="table_table-striped">
<th> User Name </th>
<th>Add Movies</th>
<th>Show Movies</th>
<th>Show Recommendation</th>

<?php 

$result=mysqli_query($con,"select * from users"); 


while($row=mysqli_fetch_array($result))
{
?>
<tr>


<td><?php echo $row ['username']; ?></td>
<td>
<br/>
<form action ="add_movies.php" method="post"> 
<input type="hidden" name="user_id" value="<?php echo $row['id'] ?>">
<input type="submit" name="add_movies" class="btn btn-primary" value="Add Movies">
</form>
    
</td>
<td>

<a href="show_movies.php?user_id=<?php echo $row['id'] ?>&user_name=<?php echo $row['username'] ?>"><button class="btn btn-primary">Show Movies</button></a>
 

<td>
<a href="user_recommendation.php?user_id=<?php echo $row['id'] ?>&user_name=<?php echo $row['username'] ?>"><button class="btn btn-primary">Show Recommendation</button></a>

</td>
</td>
<?php 
} ?> 

</table>

</div>
</div>
</body>
<html>

