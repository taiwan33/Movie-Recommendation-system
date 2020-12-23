<?php 
session_start();
include("header.php");
?>
<html lang="en"><head>
    <link rel="stylesheet" href="css.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoviePath</title>
    <link rel="stylesheet" type="text/css" href="css.css">  
</head>

<body>
<div class="center"><h2>Your Recommendeded Movies are:</h2></div>
<div class="left"><a class="btn"  href="index.php">Home</a></div>
<div class="right"><a class="btn" href="logout.php"><button>logout </button></a><br>
</div>
<?php
include("db.php");
include("recommend.php");


$movies=mysqli_query($con, "SELECT * FROM users");


$matrix=array();
while($movie=mysqli_fetch_array($movies)){

    $users=mysqli_query($con, "SELECT username from login_form where id=$movie[user_id]");
    $username = mysqli_fetch_array($users);
    $matrix[$username['username']][$movie['movie_name']]=$movie['movie_rating'];

}
$recommendedMovies = getRecommendation($matrix,$username['username']);

$allMoviesResult = mysqli_query($con, "SELECT * FROM mytable");
$allMovies = array();
while($movie=mysqli_fetch_array($allMoviesResult)){
    $allMovies[] = $movie;  
    
}

$recommendedMoviesDetails = array();
foreach($recommendedMovies as $key=>$value){
    $movie = $allMovies[array_search($key, array_column($allMovies,'movie_name'))];
    if($_SESSION["above_14"]==1){
        $recommendedMoviesDetails[] = $movie;
    }else{
        if ((strpos($movie["movies_genres"], 'Science Fiction') !== false) 
        || (strpos($movie["movies_genres"], 'Animation') !== false)
        || (strpos($movie["movies_genres"], 'Adventure') !== false)) {
            $recommendedMoviesDetails[] = $movie;
        }
    }
}


foreach($recommendedMoviesDetails as $movie){
    
    $genre = $movie["movies_genres"];
    $language = $movie["original_language"];
    
    $genre = str_replace("{'id': 28, 'name': 'Action'}","Action",$genre);
    $genre = str_replace("{'id': 12, 'name': 'Adventure'}","Adventure",$genre);
    $genre = str_replace("{'id': 14, 'name': 'Fantasy'}","Fantasy",$genre);
    $genre = str_replace("{'id': 878, 'name': 'Science Fiction'}","Science Fiction",$genre);
    $genre = str_replace("{'id': 80, 'name': 'Crime'}","Crime",$genre);
    $genre = str_replace("{'id': 18, 'name': 'Drama'}","Drama",$genre);
    $genre = str_replace("{'id': 53, 'name': 'Thriller'}","Thriller",$genre);
    $genre = str_replace("{'id': 16, 'name': 'Animation'}","Animation",$genre);
    $genre = str_replace("{'id': 37, 'name': 'Western'}","Western",$genre);
    $genre = str_replace("{'id': 35, 'name': 'Comedy'}","Comedy",$genre);
    $genre = str_replace("{'id': 10749, 'name': 'Romance'}","Romance",$genre);
    $genre = str_replace("{'id': 9648, 'name': 'Mystery'}","Mystery",$genre);
    $genre = str_replace("{'id': 27, 'name': 'Horror'}","Horror",$genre);
    $genre = str_replace("{'id': 10752, 'name': 'War'}","War",$genre);
    $genre = str_replace("{'id': 36, 'name': 'History'}","History",$genre);
    $genre = str_replace("{'id': 10402, 'name': 'Music'}","Music",$genre);
    $genre = str_replace("{'id': 10751, 'name': 'Family'}","Family",$genre);
    $genre = str_replace("{'id': 99, 'name': 'Documentary'}","Documentary",$genre);

    $language = str_replace("en","English",$language);
    $language = str_replace("fr","France",$language);
 


    ?>
   

     <img width="20%" src="<?php echo $movie['cover_pic'] ?>"/><br><br>
    <?php

    echo "Movie Name : " .$movie["movie_name"]."<br/>";
    echo "Movies Genres: " .$genre."<br/>";
    echo "Release Date: " .$movie["release_date"]."<br/>";
    echo "Original Language: ".$language."<br/>";
    echo "Runtime: ".$movie["runtime"]." min"."<br/>";
    echo "Overview: ".$movie["overview"]."<br/>";
    echo "Vote Count: " .$movie["vote_count"]."<br/>";
    echo "Vote Average : " .$movie["vote_average"]."<br/>";
    echo "popularity: ".$movie["popularity"]."<br/>";
    
 ?>
Homepage: <a target="_blank" href="<?php echo $movie["homepage"] ?>"><?php echo $movie["homepage"] ?></a><br><br><br>
<?php } ?>
  </div>  

    <a href="#top" class="btn2" aria-label="Scroll to Top">  Top 🔝</a>

  </body>
</html>
