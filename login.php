<?php 
include('lib/header.php'); 
require_once('functions/alert.php');
require_once('functions/user.php');

//if user has already logged in
if(isset($_SESSION['loggedIn']) && !empty(isset($_SESSION['loggedIn']))){
    //redirect to dashboard
    header("location: dashboard.php");
}
?>

<div class='container'>

    <p>
        <?php
            print_alert();
        ?>
    </p>
     <h3>Please click the button to login</h3>
    <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
    
    <div id="id01" class="modal">

        <form class="modal-content animate" method="POST" action="processLogin.php">

        <div class="imgcontainer">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
        <img src="image/avatar.png" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <label for="uname"><b>Username</b></label><br>
            <input type="text" value="<? if(isset($_SESSION['email'])) echo $_SESSION['email']; ?>" placeholder="Enter Username" name="email" required><br>

            <label for="email"><strong>Password</strong></label><br>
            <input type="password" name="password" placeholder="Password" require><br>

            <button type="submit" >Login</button><br>
           <!-- <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>-->
        </div>
        <!--<div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                <span class="psw">Forgot <a href="forgot.php">password?</a></span>
        </div> -->
        </form>
    </div>
</div>