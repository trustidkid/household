<?php include('lib/header.php') ?>

<h3>Forgot Password</h3>
<p>Provide email address associated with your account </p>

<form method="POST" action="processForgot.php">

<?php
    if(isset($_SESSION['error'] ) && !empty(isset($_SESSION['error']))){
    echo "<span style='color: red' >" . $_SESSION['error'] . "</span>";
    session_unset();
}
 ?>

<p>
    <label for="email">Email</label><br>
    <input 
    <?php if(isset($_SESSION['loggedIn'])){
        echo "value=". $_SESSION['loggedIn'];
    } ?>
    type="email" name="email" require  placeholder="Email">
</p>

<p>
    <button type="submit">Submit</button>
    
</p>
    
</form>

<?php include('lib/footer.php') ?>