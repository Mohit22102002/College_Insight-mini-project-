<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['username']))
{
    header("location: welcome.php");
    exit;
}
require_once "config.php";

$username = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            header("location: welcome.php");
                            
                        }
                    }

                }

    }
}    


}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Form Design</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link rel="stylesheet" href="project_login_style.css">
</head>
<body> 
    <header>
        <div class="container-fluid"> 
            <nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
   
    <a class="navbar-brand" href="#"><img src="Education_logo.png"><!--adds book icon before college insight-->
    Share your doubts</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <div class="mr-auto"> </div> <!--alligns the following header to right(mr=margin right)-->
      <ul class="navbar-nav">
        <li class="nav-item ">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item dropdown"> <!--Creates a nested navigation items for page-->
            <div class="dropdown">
          <a class="nav-link" href="#">Pages</a>
          <div class="dropdown-content">
            <a href="#">PYQ papers</a>
            <a href="#">Study material</a>
            <a href="#">Available clubs</a>
            <a href="#">Overview of open electives, minor and honor syllabus</a>
            </div>
            
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Email</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About us</a>
        </li>
      </ul>
  </div>
</div>
</nav>
        </div>
   <!--Exit header-->
        <div class="container text-center">  <!--Next div-->
            <div class="row"> <!--single row -->
                <div class="col-md-7 col-sm-12"><!--takes space of seven columns in one column total space available is of 12 columns(md-medium size devices sd- small size devices)-->
                <h6>Take the first step of your academic study with us </h6>
                <h1>COLLEGE INSIGHT</h1>
                <p>Get your all doubts cleared</p>
                <a href="#get">Get started</a>
                </div>  <!--bootstrap button px and py are padding-->
                <div class="col-md-5 col-sm-12  h-55">
                <img src="Project_img_1.jpg" alt="College Insight" width="1500px" height="500px" > 
                </div>
            </div>
        </div>
    </header>

   <form action="" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <div class="sign">
     <h6>or <a href="localhost\PHP\register.php">sign up</a></h6>
     </div>
  </div>
</div>
</form>
    
<footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h6>Shri Rambeobaba college of Engineering and Management</h6>
            <img src="college.jpg" width="200px" height="200px">
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Creators</h6>
                    <p>Mohit Darvekar<p>
          <p>Email:darvekarmm@rknec.edu<br>Mob:+91 9156883791</p>
                    <p>Mohit Malghade</p>
                    <p>Email:malghademr@rknec.edu<br>Mob:+91 7276556330</p>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Quick Links</h6>
           <a href="#">PYQ papers</a><br>
          <a href="#">Study material</a><br>
          <a href="#">Available clubs</a><br>
          <a href="#">Overview of open electives, minor and honor syllabus</a>
          <a href="#">Share doubts</a>
          </div>
        </div>
        <hr>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Copyright &copy; 2022 All Rights Reserved
            </p>
          </div>
        </div>
      </div>
</footer>
</body>

</html>
