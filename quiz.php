<?php

include 'config.php';

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
  // header("location: index.php ");
  // exit;
  echo'<div class="container" style="margin:auto ; margin-top:150px; text-align:center; width:40%; border: 2px solid #ddd; padding:30px 30px 30px 30px; font-family: Arial, Helvetica, sans-serif;">
  <h1 style="color:red;">Quiz cannot be accessed without logging in</h1>
  <h3 style="color:black;">Please <a href="/quiz/index.php"> LOGIN </a>if you already have registered</h3>
  <h3 style="color:black;">Not a member already ? <a href="/quiz/register.php">REGISTER NOW</a></h3>
  </div>';
}
else{
$email = $_SESSION['email'];

$score = 0;
if ( $_SERVER["REQUEST_METHOD"] == "POST" ){
  // echo"request method post";

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
  #quiz {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 60%;
    margin: auto;
  }
  
      .quiz{
        border: 1px solid #ddd;
        width: 60%;
        margin: auto;
        text-align: center;
  
      }
  
      #quiz td{
    padding: 5px;
    margin-bottom: 5px;
    text-align: left;
  }
  
  #quiz th {
   
    text-align: left;
    padding: 0px;
  }
  
      </style>
  
      <title>Quiz</title>
      <meta charset="UTF-8">
    </head>
  
    <body>
  
  <div class="container" id="logout">
    <a class="logout" href="/quiz/logout.php">Logout</a>
    </div>
     
      <div class="container quiz">
      <div class="container" style="text-align:center; margin:auto; margin-bottom:50px;">
  
  
  <form>
      
  <table id="quiz">';
  
  
  // Getting the id to display the quiz accordin to the chosen lesson
  
  $qid = $_GET['qid'];
  
  foreach($_POST as $key => $value) {
    // "Your answer for Q.no: '$key' was '$value'";
$sql = "Select * from quizes where sno='$key'";
$result = mysqli_query($conn , $sql);
$row=mysqli_fetch_assoc($result);
$ans = $row['ans'];
$qid = $row['qid'];
$sno = $row['sno'];
$qno = $row['qno'];
$ques = $row['ques'];
$opt1 = $row['opt1'];
$opt2 = $row['opt2'];
$opt3 = $row['opt3'];

// checking the correct and incorrect answers
  echo 
  
  '<tr>
  <th> <h4>'.$qno.' - '.$ques.'</h4> </th>
  </tr>';
// Checking option 1
  if($value == $ans && $value == $opt1){
    $score++;  
  echo'<tr>
  <td style="color:green; font-weight: bold;">
   <input required type="radio" id="option1" name="'.$sno.'" class="radiooptions" value="'.$opt1.'"/> '.$opt1.'<span style="font-size:20px;">&#9989;</span></br></td></tr>';
  }
  elseif($value !== $ans && $value == $opt1){ 
    echo'<tr>
  <td style="font-weight: bold; color:red">
   <input required type="radio" id="option1" name="'.$sno.'" class="radiooptions" value="'.$opt1.'"/> '.$opt1.'<span style="font-size:20px;">&#10060;</span></br></td></tr>';
  }
  
  elseif($value !== $ans && $ans == $opt1){ 
    echo'<tr>
  <td style="font-weight: bold; color:green">
   <input required type="radio" id="option1" name="'.$sno.'" class="radiooptions" value="'.$opt1.'"/> '.$opt1.'</br>
   </td></tr>';
  }
  else{
    echo'<tr>
  <td>
   <input required type="radio" id="option1" name="'.$sno.'" class="radiooptions" value="'.$opt1.'"/> '.$opt1.'</br></td></tr>';
  }

  

  // Checking option 2
  
  if($value == $ans && $value == $opt2){

    $score++;  
  echo'<tr>
  <td style="font-weight: bold; color:green">
   <input  required type="radio" id="option1" name="'.$sno.'" class="radiooptions" value="'.$opt2.'"/> '.$opt2.'<span style="font-size:20px;">&#9989;</span></br>
   </td></tr>';
  }
  elseif($value !== $ans && $value == $opt2){ 
    echo'<tr>
  <td style="font-weight: bold; color:red">
   <input required type="radio" id="option1" name="'.$sno.'" class="radiooptions" value="'.$opt2.'"/> '.$opt2.'<span style="font-size:20px;">&#10060;</span></br>
   </td></tr>';
  }
  elseif($value !== $ans && $ans == $opt2){ 
    echo'<tr>
  <td style="font-weight: bold; color:green">
   <input required type="radio" id="option1" name="'.$sno.'" class="radiooptions" value="'.$opt2.'"/> '.$opt2.'</br>
   </td></tr>';
  }
  else{
    echo'<tr>
  <td>
   <input required type="radio" id="option1" name="'.$sno.'" class="radiooptions" value="'.$opt2.'"/> '.$opt2.'</br>
   </td></tr>';
  }
  
  

  // Checking option 3
  
  if($value == $ans && $value == $opt3){

    $score++;  
  echo'<tr style="font-weight: bold; color:green">
  <td>
   <input required type="radio" id="option1" name="'.$sno.'" class="radiooptions" value="'.$opt3.'"/> '.$opt3.'<span style="font-size:20px;">&#9989;</span></br>
   </td></tr>';
  }
  elseif($value !== $ans && $value == $opt3){ 
    echo'<tr style="font-weight: bold; color:red">
  <td>
   <input required type="radio" id="option1" name="'.$sno.'" class="radiooptions" value="'.$opt3.'"/> '.$opt3.'<span style="font-size:20px;">&#10060;</span></br>
   </td></tr>';
  }
  elseif($value !== $ans && $ans == $opt3){ 
    echo'<tr>
  <td style="font-weight: bold; color:green">
   <input required type="radio" id="option1" name="'.$sno.'" class="radiooptions" value="'.$opt3.'"/> '.$opt3.'</br>
   </td></tr>';}
  else{
    echo'<tr>
  <td>
   <input required type="radio" id="option1" name="'.$sno.'" class="radiooptions" value="'.$opt3.'"/> '.$opt3.'</br>
   </td></tr>';
  }
  
  }  

  echo'
  </table>
  </form>
  <div style="text-align:center; margin-top:50px; color:black">
          <h3>YOU SCORED : '.$score.'/4</h3>
      </div>
  
  <div style="text-align:center"><p >Go back to <a href="/quiz/userpage.php">Homepage</a><p></div>
  </div>
  </div>
    </body>
  </html>
  ';
// Updating the quiz score in database

if($qid == '1'){
  $sqlscr = "UPDATE users SET quiz1= '".$score."' WHERE email = '".$email."' ";
  $result = mysqli_query($conn, $sqlscr);}
  
  if($qid == '2'){
      $sqlscr = "UPDATE users SET quiz2= '".$score."' WHERE email = '".$email."' ";
      $result = mysqli_query($conn, $sqlscr);}
      
  if($qid == '3'){
      $sqlscr = "UPDATE users SET quiz3= '".$score."' WHERE email = '".$email."' ";
      $result = mysqli_query($conn, $sqlscr);}
  
  }


else{

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
#quiz {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 60%;
  margin: auto;
}

  .submit {
      background-color: black;
      color: white;
      padding: 14px 20px;
      margin-top: 20px;
      margin-bottom: 50px;
      border: none;
      cursor: pointer;
      width: 20%;
    }
    
    .submit:hover {
      background-color: white;
      color: black;
      border: 1px solid black;
    }

    .reset {
      background-color: white;
      color: black;
      padding: 14px 20px;
      margin-top: 20px;
      margin-bottom: 50px;
      border: 1px solid black;
      cursor: pointer;
      width: 20%;
    }
    
    .reset:hover {
      background-color: black;
      color: white;
    }

    .quiz{
      border: 1px solid #ddd;
      width: 60%;
      margin: auto;
      text-align: center;

    }

    #quiz td{
  padding: 5px;
  margin-bottom: 5px;
  text-align: left;
}

#quiz th {
 
  text-align: left;
  padding: 0px;
}

    </style>

    <title>Quiz</title>

  </head>

  <body>

<div class="container" id="logout">
  <a class="logout" href="/quiz/logout.php">Logout</a>
  </div>
   
    <div class="container quiz">
    <div class="container" style="text-align:center; margin:auto; margin-top:20px; margin-bottom:20px; background-color:black; color:white; padding:0.25px; width:30%">

<h3>QUIZ</h3>

</div>';
$qid = $_GET['qid'];
echo'
<form action="quiz.php?qid='.$qid.'" method="POST" >
    

<table id="quiz">';


// Getting the id to display the quiz accordin to the chosen lesson

$qid = $_GET['qid'];

// Accessing the quiz content from the database according to the requested id

$sql = "Select * from quizes where qid='$qid'";
$result = mysqli_query($conn , $sql);

while($row=mysqli_fetch_assoc($result)){
 
  $qno = $row['qno'];
  $sno = $row['sno'];
  $ques = $row['ques'];
  $opt1 = $row['opt1'];
  $opt2 = $row['opt2'];
  $opt3 = $row['opt3'];
  $ans = $row['ans'];

// dispalying quiz content

echo 

'<tr>
<th> <h4>'.$qno.' - '.$ques.'</h4> </th>
</tr>

<tr>
<td>
 <input required type="radio" id="option1" name="'.$sno.'" class="radiooptions" value="'.$opt1.'"/> '.$opt1.'</br>

<input required type="radio" id="option1" name="'.$sno.'" class="radiooptions" value="'.$opt2.'"/> '.$opt2.'</br>

<input required type="radio" id="option1" name="'.$sno.'" class="radiooptions" value="'.$opt3.'"/> '.$opt3.'</br>
</td>
</tr>';}

echo'
</table>

<button class="submit" type="submit">Submit</button>
<button class="reset" type="reset">Reset</button>

</form>
<div style="text-align:center;"><p >Go back to <a href="/quiz/userpage.php">Homepage</a><p></div>
  </div>
</div>

  
  </body>
</html>
';
}
}
?>