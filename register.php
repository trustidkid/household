<?php include('lib/header.php'); 

//start session to make the page record session
session_start();

$_SESSION['test'] = "testing";
//$_SESSION['error'] ;
print_r($_SESSION);

?>
<p>
<strong> Registeration Form </strong>
</p>

<form method="POST" action="processRegister.php">

<?php
    if(isset($_SESSION['error'] ) && !empty(isset($_SESSION['error']))){
    echo "<span style='color: red' >" . $_SESSION['error'] . "</span>";
}
 ?>

<p>
    <label for="firstname">First Name</label><br>
    <input type="text" name="firstname" value="" placeholder="First Name">
</p>
<p>
    <label for="lastname">First Name</label><br>
    <input type="text" name="lastname" value="" placeholder="First Name">
</p>
<p>
    <label for="email">Email</label><br>
    <input type="email" name="email" value="" placeholder="Email">
</p>
<p>
    <label for="email">Password</label><br>
    <input type="password" name="password" value="" placeholder="Password">
</p>
<p>
    <label for="email">Gender</label><br>
    <select name="gender">
        <<option>Select</option>
        <option >Female</option>
        <option >Male</option>
    </select>
</p>
<hr>

<p>
    <Label>Designation</Label>
    <select name="designation">
        <<option>Select</option>
        <option>Medical Team</option>
        <option>Patient</option>
    </select>
</p>

<p>
    <label for="department">department</label><br>
    <input type="text" name="department" value="" placeholder="Department">
</p>

<p>
    <button type="submit">Register</button> <button type="reset">Reset</button>
</p>
    
</form>

<?php include('lib/footer.php'); ?>