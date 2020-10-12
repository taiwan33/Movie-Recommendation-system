<html lang="en">
<head>
    <link rel="stylesheet" href="css.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    
</body>
</html>

<?php

include("header.php");
include("db.php");
$flag=0;

    if(isset($_POST['submit']))
    {

       $result= mysqli_query($con,"insert into users(username)values('$_POST[username]')");
if($result)
{
    $flag=1;
}
    }

?>

<div class="panel_panel-default">
    <div class ="panel-heading">
    <h2>
    <a class="btn btn-success" href="add_movies.php">Add Movies</a>
     <a class="btn btn-info pull-right"  href="index.php">Home</a>
    </h2><br></br> 
</div>

<?php 

if($flag) { ?>

<div class="alert-alert-success">User Successfully Inserted in the database</div>
<?php  } ?>


<div class="panel-body">
<form action="add_user.php" method ="POST">
<br/>
<div class="form-group">
<label for="username"> User Name</label>
<input type="text" name="username" id="username" class="form-control" required>
<br></br> 
</div>
<div class="form-group">
<input type="submit" name="submit" value="submit" class="btn btn-primary" required>
</div>