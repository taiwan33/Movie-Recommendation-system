
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

include("db.php");
include("recommend.php");
include("header.php");

$movies=mysqli_query($con,"SELECT * from user_movies");

$matrix=array();
while ($movie=mysqli_fetch_array($movies))

{


    $users=mysqli_query($con,"SELECT username from users where id=$movie[user_id]");
    $username=mysqli_fetch_array($users);

    $matrix[$username['username']][$movie['movie_name']]=$movie['movie_rating'];

}

$query="SELECT username from users where id=".$_GET['user_id'];

    $users=mysqli_query($con,$query);
    $username=mysqli_fetch_array($users);
    $matrix[$username['username']][$movie['movie_name']]=$movie['movie_rating'];


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


<?php

$username = $_GET['user_name'];

$result=mysqli_query($con,"SELECT * FROM user_movies WHERE user_id='$_GET[user_id]'"); 
//echo $abc;
//die();

if(mysqli_num_rows($result)>0){
?>
<h3> Movies suggested for <?php echo $username ?> are - </h3>

<table class="table_table-striped">

<tr>
<h2><td> Movie Name </td></h2>
<td> Movie rating </td>
<td> Already Watched </td>


</tr>

<?php 

$recommendation=array();

$recommendation=getRecommendation($matrix,$username);


foreach($recommendation as $movie=>$rating)
{
?>

<tr><div class="form-group">
    <td><?php echo $movie ?></td>
    <td><?php 
    if($rating>4){
        echo "You will surely like this movie";
    }else if($rating>2){
        echo "You may like this movie";
    }else{
        echo "You may not like this movie";
    }
    ?></td>

<td>
<form action="add_movies.php" method="post">
<input type="hidden" name="movie_name" value="<?php echo $movie ?>"/>
<select name="movie_rating" >
  <option value="1">Very bad</option>
  <option value="2">Bad</option>
  <option value="3">Average</option>
  <option value="4">Good</option>
  <option value="5" selected>Very Good</option>
  </td>
  <td><div class="form-group">
<input type="submit" name="submit" value="submit" class="btn btn-primary" required>
</form>
</div></td>
</select> 
</div>
</tr>


<?php } ?> 

</table>
<?php }else{
    echo "No movies added by ".$username;
} ?>



</div>


