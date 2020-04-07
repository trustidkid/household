<?php 
include('lib/header.php'); 

//if user has already logged in
if(isset($_SESSION['loggedIn']) && empty(isset($_SESSION['loggedIn']))){
    //redirect to dashboard
    header("location: dashboard.php");
}
?>

<p>
    <?php
        if(isset($_SESSION['message'] ) && !empty(isset($_SESSION['message']))){
        echo "<span style='color: green' >" . $_SESSION['message'] . "</span>";
       // session_destroy();
    }
    ?>

 </p>
<p>Login Page</p>

<form method="POST" action="processLogin.php">

<?php
    if(isset($_SESSION['error'] ) && !empty(isset($_SESSION['error']))){
    echo "<span style='color: red' >" . $_SESSION['error'] . "</span>";
   // session_unset();
}
 ?>

<p>
    <label for="email">Email</label><br>
    <input type="email" name="email" value="<?php if(isset($_SESSION['email'])){
        echo $_SESSION['email'];
    } ?>" placeholder="Email">
</p>
<p>
    <label for="email">Password</label><br>
    <input 
        <?php if(isset($_SESSION['password']) && !empty(isset($_SESSION['password']))) echo "value=".$_SESSION['password']; ?>
     type="password" name="password" placeholder="Password" require>
</p>

<p>
    <button type="submit">Login</button> <button type="reset">Reset</button>
    
</p>
<p><a href="forgot.php">Forgot Password</a></p>
    
</form>


<?php include('lib/footer.php'); ?>