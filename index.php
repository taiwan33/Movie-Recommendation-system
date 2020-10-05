<?php

include("header.php");
include("db.php");


?>

<div class="panel panel-default">
    <div class="panel-heading">

    <div class ="panel-heading">
    <h2>
    <a class="btn btn-success" href="add_users.php">Add Users</a>
     <a class="btn btn-info pull-right"  href="index.php"> Back </a>
    </h2><br></br> 
</div>

</div>
</div>

<div class="panel-body">

<table class="table table-striped">
<th> User Name </th>
<th>Add Movies</th>

<?php 

$result=mysqli_query($con,"select * from users"); 


while($row=mysqli_fetch_array($result))
{
?>
<tr>


<td><?php echo $row ['username']; ?></td>
<td>

<form action ="add_movies.php">

<input type="submit" name="add_movies" class="btn btn-primary" value="Add Movies">
</form>
<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
    
</td></tr>
<?php 
} ?> 

</table>

</div>