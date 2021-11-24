<?php 

include 'config.php';


$login = false;
$showerror = false;

// When the login form is submitted this code is executed

if ( $_SERVER["REQUEST_METHOD"] == "POST" ){

$email = $_POST["email"];
$password = $_POST["password"];

  $sql = "Select * from users where email='$email' AND password='$password'";
  $result = mysqli_query($conn , $sql);

// checking in the databse if the login credentials are right 
// After succesful login Session starts , and taking some information of logged in users using Session variables to use in next pages

  $num = mysqli_num_rows($result);
  
  if ($num == 1){
    $login = true; 
    $row=mysqli_fetch_assoc($result);
    $name = $row['name'];
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;
    $_SESSION['sno'] = $sno;

// Updating the time of login , when user logs in

    $sql_date="UPDATE users SET dt= now() WHERE email = '".$email."' ";
    $date_result = mysqli_query($conn , $sql_date);

// redirecting to homepage after succesful login

    header("location: userpage.php");
  
  }

// if it doesnot exists it will show an error

else{
  $showerror = "Incorrect Credentials";
}

}


?>

<!doctype html>
<html lang="en">
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    
<style>


body {font-family: Arial, Helvetica, sans-serif;}

/* styling for login form */

form {border: 3px solid #f1f1f1;}



input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: black;
  color: white;
  padding: 14px 20px;
  margin: 30px 0;
  border: none;
  cursor: pointer;
  width: 50%;
}

button:hover {
  opacity: 0.8;
}

.container {
  padding: 50px;
}

span.password {
  float: right;
  padding-top: 16px;
}

.login{
  width: 60%;
  margin: auto;
  text-align: center;
}

@media screen and (max-width:350px) {
  span.password {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}

/* styling for alert message */

.alert {
      border: solid;
      border-width: 1px;
      border-color: black;
      padding: 20px;
      background-color: #ba0000;
      margin-bottom: 5px;
      color: white;
    }

    .successalert {
      border: solid;
      border-width: 1px;
      border-color: black;
      padding: 20px;
      background-color: green;
      margin-bottom: 5px;
      color: white;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}

</style>
  
<title>Login</title>
  </head>
  <body>

<!-- upon succesful login it will show this message and then redirect to home page -->
    
      <?php
    
    if ($login){
      echo'<div class="successalert">
      <span class="closebtn">&times;</span>
      Logged in Successfully!
    </div>';
    }
?>

<!-- upon unsuccesful login attempt it will show this message and user will not be able to login -->

<?php
    if ($showerror){
      echo'
      <div class="alert">
  <span class="closebtn">&times;</span>
  '.$showerror.'.
</div>';
      }
?>
    
    <div class="container login" >
    
    <h2 style="margin-bottom: 50px;">LOGIN FORM</h2>

<form action="/quiz/index.php" method="post">

  <div class="container" >

  
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

        
    <button type="submit">Login</button>

    <p> Not a member ? <a href="/quiz/register.php">REGISTER NOW</a></p>
    
  </div>
    
</form>
</div>
</body>
</html>
   
