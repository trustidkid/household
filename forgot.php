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
    <input type="email" name="email" require value="<?php if(isset($_SESSION['email'])){
        echo $_SESSION['email'];
    } ?>" placeholder="Email">
</p>

<p>
    <button type="submit">Submit</button>
    
</p>
    
</form>

<?php include('lib/footer.php') ?>