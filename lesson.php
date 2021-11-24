<?php

include 'config.php';

// getting the lesson id selected by the user 

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
  // header("location: index.php ");
  // exit;
  echo'<div class="container" style="margin:auto ; margin-top:150px; text-align:center; width:40%; border: 2px solid #ddd; padding:30px 30px 30px 30px; font-family: Arial, Helvetica, sans-serif;">
  <h1 style="color:red;">Lessons cannot be accessed without logging in</h1>
  <h3 style="color:black;">Please <a href="/quiz/index.php"> LOGIN </a>if you already have registered</h3>
  <h3 style="color:black;">Not a member already ? <a href="/quiz/register.php">REGISTER NOW</a></h3>
  </div>';

}

else{

  $id = $_GET['id'];
// Accesssing lesson content of the particular lesson requested by the user from the database 

$sql = "Select * from lessons where sno='$id'";
$result = mysqli_query($conn , $sql);

  $row=mysqli_fetch_assoc($result);
 
  $title = $row['title'];
  $content = $row['content'];



echo'

<!doctype html>
<html lang="en">
  <head>
  <style>
        
        body {font-family: Arial, Helvetica, sans-serif;}
       
        .logout{
  background-color: black;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: auto;
  
}

#logout{
  text-align: right;
}
        .link:link, .link:visited {
  background-color: black;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

.link:hover, .link:active {
  background-color: White;
  border-width: 1px;
  border-style: solid;
  border-color: black;
  color:black
}
  </style>

    <title>Lesson - <?php echo $title ?></title>
  
  </head>
  
  <body>

  <div class="container" id="logout">
  <a class="logout" href="/quiz/logout.php">Logout</a>
  </div>

 <!-- Displaying the lesson title and content -->

<div class="container" style="text-align:center; margin:auto; margin-top:70px; background-color:black; color:white; padding:0.25px; width:30%">

<h3>'.$title.'</h3>

</div>

<div class="container" style="text-align:center; margin:auto; margin-top:50px; width:70%">

<p> '.$content.' ?> </p>

</div>

<div class="container" style="text-align:center; margin-top:50px">

<!-- <a href="/quiz/quiz.php?qid='.$id.'"> Take Quiz </a> -->

<a class="link" href="/quiz/quiz.php?qid='.$id.'">Take Quiz</a>

<p style="font-size: small;"> Go Back to <a href="/quiz/userpage.php">HOMEPAGE</a></p>

</div>

    
  </body>
</html>';
}
?>