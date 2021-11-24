<?php 

// including the config.php file , that contains the code for database connection

include 'config.php';

$showalert = false;
$showerror = false;

// When the form is submitted this code is executed

if ( $_SERVER["REQUEST_METHOD"] == "POST" ){

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirmpassword = $_POST["confirmpassword"];

// Check whether this username exists

$existSql = "SELECT * from `users` where email = '$email'";
$result = mysqli_query($conn, $existSql);
$numExistRows = mysqli_num_rows($result);

// if it exists it will show an error

if($numExistRows > 0){

    $exists = true;
    $showerror = "You already have an account";
}

// if it doesnot exists before & password and confirm password is same then it will add the record to the database

else{
  $exists = false;
if (($confirmpassword == $password) && $exists == false){

  $sql = "INSERT INTO `users` (`name`, `email`, `password`, `dt`) VALUES ('$name', '$email', '$password', current_timestamp())";
  $result = mysqli_query($conn , $sql);

  if ($result){
    $showalert = true;
    header("location:index.php");
  }

}

// if passwords do not match it will show an error

else {

  $showerror = "Passwords do not match";
}
}
}
?>

<!-- HTML -->

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
      padding-top: 20px;
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
      color: black;
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

    <title>Register</title>

  </head>

  <body>

      <!-- upon succesful registration it will show this message and then redirect to login page -->

    <?php
    if ($showalert){

      echo'<div class="successalert">
      <span class="closebtn">&times;</span>
      Account Created Successfully!
    </div>';
      
// After delay of 5 seconds redirecting to login page

    //   echo'<script type="text/javascript">
    // setTimeout(function() { location.replace("login.php")},5000);
    //   </script>';
      
    }
?>
<!-- if registration fails it will show this error message -->
<?php
    if ($showerror){
      echo'<div class="alert">
      <span class="closebtn">&times;</span>
      '.$showerror.'.
    </div>';
      }
?>
    

    <div class="container login" >
    
    <h2 style="margin-bottom: 50px;">REGISTRATION FORM</h2>

<form action="/quiz/register.php" method="post">

  <div class="container" >

  <label for="name"><b>Name</b></label>
    <input type="text" placeholder="Enter Name" name="name" required>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <label for="confirmpassword"><b>Confirm Password</b></label>
    <input type="password" placeholder="Confirm Password" name="confirmpassword" required>
        
    <button type="submit">Register</button>

    
    <p> Already a member ? <a href="/quiz/index.php">LOGIN</a></p>
  
  </div>
    
  
</form>
</div>
    

  </body>
</html>