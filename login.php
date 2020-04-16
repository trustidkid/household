<?php 
include('lib/header.php'); 
require_once('functions/alert.php');
require_once('functions/user.php');

//if user has already logged in
if(isset($_SESSION['loggedIn']) && empty(isset($_SESSION['loggedIn']))){
    //redirect to dashboard
    header("location: dashboard.php");
}
?>

<p>
    <?php
        print_alert();
    ?>
</p>
<p>Login Page</p>

<form method="POST" action="processLogin.php">

<p>
    <label for="email">Email</label><br>
    <input type="email" name="email" value="<?php if(isset($_SESSION['email'])){
        echo $_SESSION['email'];
    } ?>" placeholder="Email">
</p>
<p>
    <label for="email">Password</label><br>
    <input type="password" name="password" placeholder="Password" require>
</p>

<p>
    <button type="submit">Login</button> <button type="reset">Reset</button>
    
</p>
<p><a href="forgot.php">Forgot Password</a></p>
    
</form>

<?php include('lib/footer.php'); ?>