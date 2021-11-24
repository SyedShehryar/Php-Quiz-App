<?php

include 'config.php';

// Checking if the user is logged  in , otherwise it will not be able to access this page

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
  echo'<div class="container" style="margin:auto ; margin-top:150px; text-align:center; width:40%; border: 2px solid #ddd; padding:30px 30px 30px 30px; font-family: Arial, Helvetica, sans-serif;">
  <h1 style="color:red;">Homepage cannot be accessed without logging in</h1>
  <h3 style="color:black;">Please <a href="/quiz/index.php"> LOGIN </a>if you already have registered</h3>
  <h3 style="color:black;">Not a member already ? <a href="/quiz/register.php">REGISTER NOW</a></h3>
  </div>';
  // show error;
}
else{
// taking email of the logged in user to get the record against that email , as email is the unique property of users

$email = $_SESSION['email'];

// accessing quiz scores of logged in user from the database

$sql_score = "Select * from users where email='$email'";
  $result_score = mysqli_query($conn , $sql_score);
  while($row=mysqli_fetch_assoc($result_score)){

    $score1 = $row['quiz1'];
    $score2 = $row['quiz2'];
    $score3 = $row['quiz3'];

    // taking dat and time of login of logged in user

    $date = $row['dt'];

    // adding up all the scores 

    $final_score = $score1 + $score2 + $score3;

  }
$scores = array ( "1" , $score1 , $score2 , $score3);

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

/* Styling of Table */

    #lessons {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 60%;
  margin: auto;
}

#lessons td, #lessons th {
  border: 1px solid #ddd;
  padding: 8px;
}

#lessons tr:hover {background-color: #ddd;}

#lessons th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: black;
  color: white;
}

    </style>

    <title>Home</title>
  
  </head>

  <body>
<div class="container" id="logout">
  <a class="logout" href="/quiz/logout.php">Logout</a>
  </div>
<!-- Dispalying time and date of last login -->

      <p style="margin-top: 30px; text-align: left; color:grey;" >Last successful login was on: '.$date.'</p>   

<!-- Dispalying username of logged  in user -->

      <p style="margin-top: 35px;" >Welcome <b>'.$_SESSION['name'].' !</b></p>';


// Checking if user has given the last quiz(this means user has given all quizes) then will show the score otherwise will show simple text

if(isset($score3))
{
    echo '<div style="margin-top:30px">
        <p>Congratulations! You finished all quizzes. Your final score is : <b style="font-size:20px">'.$final_score.'/12</b></p>
    </div>';}
else{
     echo'<p> Enjoy learning about topic by taking our lessons and quizzes.<p>';   
    }


// table for displaying lessons and scores

echo'
<div class="container" style="margin-top: 50px; text-align: center;">
    
  <table id="lessons">
  <tr>
    <th>S.NO</th>
    <th>LESSON TITLE</th>
    <th>QUIZ SCORE</th>
  </tr>';

// Accessing lessons from the database

  $sql = "Select * from lessons";
  $result = mysqli_query($conn , $sql);

  while($row=mysqli_fetch_assoc($result)){

    $title = $row['title'];
    $sid = $row['sno'];
    $sno = $row['sno'];
// these will be used to access the score of particular quiz number of the user
    $scr = $scores[$sno];
    $scr1 = $scores[--$sno];
    
  // if the user has given quiz of previous lesson then next lesson will be displayed & and a specific id will be sent in url to the next page acccording the selected lesson 

  if(isset($scr1)){

    echo'<tr>
    <td>'.$sid.'</td>
    <td><a href="/quiz/lesson.php?id='.$sid.'">'.$title.'</a></td>';
  
  // if the user has given quiz of that lesson then quiz score will be displayed otherwise Quiz not taken will be shown

    if(isset($scr)){
      echo'<td>'.$scr.'</td>';
  }
  else{
        
    echo' <td>Quiz not taken</td>';
  }

  }
      
    echo '</tr>';
  }


echo'
</table>


</div>
  
  </body>

  

  </html>';}
  ?>

