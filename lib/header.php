<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SNH Hospital</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        
    </head>
    <body style="padding:10px">
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">SNH Hospital</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="#">Information</a></li>
        <li><a href="#">Cases</a></li>
        <li><a href="#">Emergency Numbers</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <?php 

        //if no user is login show register and login link
        if(!isset($_SESSION['loggedIn'])){
           echo " <li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
           echo "<li><a href='forgot.php'><span class='glyphicon glyphicon-user'></span> Forgot Password</a></li>";
        }else if(isset($_SESSION['userlevel']) == "Super Admin"){
          echo "<li><a href='register.php'><span class='glyphicon glyphicon-user'></span> Register</a></li>";
          echo "<li><a href='reset.php'><span class='glyphicon glyphicon-user'></span> Reset Password</a></li>";
          echo " <li><a href='logout.php'><span class='glyphicon glyphicon-log-in'></span> Logout</a></li>";
       }
        else {
            echo "<li><a href='reset.php'><span class='glyphicon glyphicon-user'></span> Reset Password</a></li>";
            echo " <li><a href='logout.php'><span class='glyphicon glyphicon-log-in'></span> Logout</a></li>";
        } ?>   
       
      </ul>
    </div>
  </div>
</nav>