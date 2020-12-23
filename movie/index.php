<?php
session_start(); ?>
<html lang="en">
<head>
    <link rel="stylesheet" href="css.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies Path</title>
    <link rel="stylesheet" type="text/css" href="css.css">  
</head>
<body>


<?php
    // include("session.php");
    include("header.php");
    include("db.php");
    // echo $_SESSION['id'];
    // echo $_SESSION['username'];

    //For search
$search='';
if(isset($_GET["search"])){
  $search = $_GET["search"];
}
?>

<form action="user_recommendation1.php" method="GET">

</form>
<a class="btn"  href="user_recommendation.php"><h2> For Recommended movies  </h2></a>

<div align="right">
<form action="index.php" method="GET">

  <input id="search" name="search" type="text" placeholder="Search movie here" value = "<?php echo $search ?>" required>
  <input id="submit" type="submit" value="Search">
  
</form><br>
<a href="logout.php"><button>logout </button></a>
</div>


<div class="line">
<?php 

if(isset($_POST['submit'])){

  $query = "insert into users(user_id,movie_id,movie_rating,movie_name) values('$_SESSION[id]','$_POST[movie_id]','$_POST[movie_rating]','$_POST[movie_name]')";
  $result=mysqli_query($con,$query);
}

//For pagination
if(isset($_GET['page'])){
  $page = $_GET['page'];
}else{
  $page = 1;
}
$sql = "SELECT cover_pic,poster_path,movie_id,homepage,movie_name,movies_genres,vote_count,vote_average,runtime,release_date,overview,original_language,popularity 
FROM mytable WHERE movie_name LIKE '%".$search."%'"; 

if($_SESSION['above_14']==0){
  $sql = $sql. " AND (movies_genres LIKE '%Adventure%' OR movies_genres LIKE '%Science Fiction%' OR movies_genres LIKE '%Animation%')";
}


$sql = $sql."ORDER BY  popularity DESC LIMIT 20 OFFSET ".(($page-1)*20);

$result = mysqli_query($con,$sql);




if (mysqli_num_rows($result)>0){


    while($row = mysqli_fetch_assoc($result)){
    



      
        $genre = $row["movies_genres"];
        $language = $row["original_language"];

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
        $genre = str_replace("{'id': 10770, 'name': 'TV Movie'},","TV Movie",$genre);
        $genre = str_replace("{'id': 10769, 'name': 'Foreign'},","Foreign",$genre);

        $language = str_replace("en","English",$language);
        $language = str_replace("fr","France",$language);
        $language = str_replace("it","Italic",$language);
      ?>


<div> 
  <img width="40%" width="210" height="315" src="<?php echo $row['cover_pic'] ?>"/><br>
<?php 
      echo  $row["movie_name"]."<br>";
      // echo "Movie Genres: " .$genre. "<br>";
      // echo "Release Date: ".$row["release_date"]. "<br>";
      // echo "Run Time: " .$row["runtime"]." min". "<br>";
      // echo "Overview: ".$row["overview"]."<br>";
      // echo "Vote Count: " .$row["vote_count"]."<br>";
      // echo "Average Vote: ".$row["vote_average"]."<br>";
      // echo "Original language: ".$language."<br>";
      // echo "Popularity: " .$row["popularity"]."<br>";
      // $str = substr($row["poster_path"], 1); 
    ?>  
     

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<button onclick="popup()">Details </button>
<script>
function popup(){
  
  swal("<?php echo "Movie Genres: " .$genre;
  echo "Release Date: ".$row["release_date"]. "<br>";
     echo "Run Time: " .$row["runtime"]." min". "<br>";
      echo "Overview: ".$row["overview"]."<br>";
      echo "Vote Count: " .$row["vote_count"]."<br>";
      echo "Average Vote: ".$row["vote_average"]."<br>";
      echo "Original language: ".$language."<br>";
      echo "Popularity: " .$row["popularity"]."<br>";?>");


}
</script>
    <form action="index.php" method="POST">
    <input type="hidden" name="movie_id" value="<?php echo $row["movie_id"]?>"/>
    <input type="hidden" name="movie_name" value="<?php echo $row["movie_name"]?>"/>
    <label for="movie_rating"> Movie Rating </label>
    <select name="movie_rating" >
      <option value="1">Very bad</option>
      <option value="2">Bad</option>
      <option value="3">Average</option>
      <option value="4">Good</option>
      <option value="5" selected>Very Good</option>
    </select> <div class="form-group">
<input type="submit" name="submit" value="submit" class="btn btn-primary" required>
</form> </div>
</div>
<?php 
}    }?>
</div>



<?php
$query = "SELECT movie_id FROM mytable";
$result = mysqli_query($con,$query);
$count = mysqli_num_rows($result);
$pageCount = ceil($count/20);
?>

<center>
<div class="page">
<?php if($page>1){?>
  <a href="index.php?page=1">First page</a>
<a href="index.php?page=<?php echo $page-1 ?>">Previous</a>
<?php } ?>
<?php 
$start = $page-5;
if($start<1){
  $start = 1;
}
$end = $page+5;
if($end>$pageCount){
  $end = $pageCount;
} 
for($i=$start;$i<=$end;$i++){
  $fontSize = 20;
  if($i==$page){
    $fontSize = 32;
  }
?>
<a href="index.php?page=<?php echo $i ?>"><span style="font-size:<?php echo $fontSize ?>px"><?php echo $i ?></span></a>
<?php } ?>
<?php if($page<$pageCount){ ?>
<a href="index.php?page=<?php echo $page+1 ?>">Next</a>
<a href="index.php?page=<?php echo $pageCount ?>">Last Page</a>
<?php } ?>
</div>
</center>

  </div>  <div class="btn2">
    <a href="#top" class="btn2" aria-label="Scroll to Top">Top 🔝</a>
  </div>
</body>
</html>

