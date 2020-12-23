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

<div class="panel-body">


<?php

$username = $_GET['user_name'];

$result=mysqli_query($con,"SELECT * FROM user_movies WHERE user_id='$_GET[user_id]'"); 


if(mysqli_num_rows($result)>0){
?>
<h3>Movies added by <?php echo $username ?></h3>

<table class="table_table-striped">
<th> Movie Name </th>
<th>Movie rating</th>
<th> Movie Genres</th>


<?php 


while($row=mysqli_fetch_array($result))
{
?>
<tr>


<td><?php echo $row ['movie_name']; ?></td>
<td><?php 
    $rating = $row['movie_rating'];
    if($rating>4){
        echo "Brillent Movie";
    }else if($rating>2){
        echo "One Time Watch";
    }else{
        echo "Not Good Enough";
    }
    ?>
<td><?php 
    $genres= $row ['movie_genres']; 
    if($genres==1){
        echo"crime";
    }elseif($genres==2){
        echo"comedy";
    }elseif($genres==2){
        echo"Action";
    }
    elseif($genres==3){
        echo"Romantic";
    }
    elseif($genres==4){
        echo"Adventure";
    }
    elseif($genres==5){
        echo"Drama";
    }
    elseif($genres==6){
        echo"Horror";
    }
    elseif($genres==7){
        echo"Sci-Fi";
    }
    elseif($genres==8){
        echo"Thriller";
    }
    
    
    ?></td>

</td>
</tr>


<?php 
} ?> 

</table>
<?php }else{
    echo "No movies are added by ".$username; echo" You need to add movies first ";
} ?>

</div>
