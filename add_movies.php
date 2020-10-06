<?php
    session_start();
    if(isset($_POST['user_id']))
    {
        $_SESSION['user_id']=$_POST['user_id'];
    }


include("header.php");
include("db.php");
$flag=0;

if(isset($_POST['submit']))
{
    
        $query = "insert into user_movies(user_id,movie_name,movie_rating)values('$_SESSION[user_id]','$_POST[movie_name]','$_POST[movie_rating]')";
        // echo $query;
        // die();
    $result= mysqli_query($con,$query);
    if($result)
    {
    $flag=1;
    }
}

?>

<div class="panel panel-default">
    <div class ="panel-heading">
    <h2>
    <a class="btn btn-success" href="add_user.php">Add User</a>
     <a class="btn btn-info pull-right"  href="index.php">Back</a>
    </h2><br></br> 
</div>

<?php 

if($flag) { ?>

<div class="alert alert-success">Movie Successfully Inserted in the database</div>
<?php  } ?>


<div class="panel-body">
<form action="add_movies.php" method ="POST">


<div class="form-group">
<label for="username"> Movie name </label>
<input type="text" name="movie_name" id="movie_name" class="form-control" required>
<br></br> 
</div>

<div class="form-group">
<label for="username">Movie Rating </label>
<input type="float" name="movie_rating" id="movie_rating" class="form-control" required>
<br></br> 
</div>

<div class="form-group">
<input type="submit" name="submit" value="submit" class="btn btn-primary" required>
</div>

</form>
