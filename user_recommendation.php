<?php

include("db.php");

$movies=mysqli_query($con,"SELECT * from user_movies");


while ($movie=mysqli_fetch_array($movies))

{


    $users=mysqli_query($con,"SELECT username from users where id=$movie[user_id]");
    $username=mysqli_fetch_array($users);

    $matrix[$username['username']][$movie['movie_name']]=$movie['movie_rating'];

}



echo"<pre>";

print_r($matrix);
echo"</pre>";
?>