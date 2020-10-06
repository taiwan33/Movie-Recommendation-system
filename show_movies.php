
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


<?php

$username = $_GET['user_name'];

$result=mysqli_query($con,"SELECT * FROM user_movies WHERE user_id='$_GET[user_id]'"); 
//echo $abc;
//die();

if(mysqli_num_rows($result)>0){
?>
<h3>Movies added by <?php echo $username ?></h3>

<table class="table table-striped">
<th> Movie Name </th>
<th>Movie rating</th>


<?php 


while($row=mysqli_fetch_array($result))
{
?>
<tr>


<td><?php echo $row ['movie_name']; ?></td>
<td><?php echo $row ['movie_rating']; ?></td>
</tr>


<?php 
} ?> 

</table>
<?php }else{
    echo "No movies added by ".$username;
} ?>

</div>
