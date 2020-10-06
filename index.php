<?php

include("header.php");
include("db.php");


?>

<div class="panel panel-default">
    <div class="panel-heading">

    <div class ="panel-heading">
    <h2>
    <a class="btn btn-success" href="add_user.php">Add Users</a>
     <a class="btn btn-info pull-right"  href="index.php"> Back </a>
    </h2><br></br> 
</div>

</div>
</div>

<div class="panel-body">

<table class="table table-striped">
<th> User Name </th>
<th>Add Movies</th>
<th>Show Movies</th>

<?php 

$result=mysqli_query($con,"select * from users"); 


while($row=mysqli_fetch_array($result))
{
?>
<tr>


<td><?php echo $row ['username']; ?></td>
<td>

<form action ="add_movies.php" method="post"> 
<input type="hidden" name="user_id" value="<?php echo $row['id'] ?>">
<input type="submit" name="add_movies" class="btn btn-primary" value="Add Movies">
</form>
    
</td>
<td>

<form action ="show_movies.php" method="get"> 
<input type="hidden" name="user_id" value="<?php echo $row['id'] ?>">
<input type="hidden" name="user_name" value="<?php echo $row['username'] ?>">
<input type="submit" name="show_movies" class="btn btn-primary" value="Show Movies">
</form>
    
</td>
<?php 
} ?> 

</table>

</div>