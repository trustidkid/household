<?php 
include('lib/header.php'); 
//if user has already logged in
if(isset($_SESSION['loggedIn']) && !empty(isset($_SESSION['loggedIn']))){
    //redirect to dashboard
    header("location: dashboard.php");
}
?>
<p>
<H3><strong> Registeration Form </strong></H3>
</p>

<form method="POST" action="processRegister.php">

<?php
    if(isset($_SESSION['error'] ) && !empty(isset($_SESSION['error']))){
    echo "<span style='color: red' >" . $_SESSION['error'] . "</span>";
    session_unset();
}
 ?>

<p>
    <label for="firstname">First Name</label><br>
    <input 
    <?php
    if(isset($_SESSION['firstname'] ) && !empty(isset($_SESSION['firstname']))){
    echo "value=" . $_SESSION['firstname'] . "</span>";
    session_unset();
}
 ?>
    type="text" name="firstname"  placeholder="First Name">
</p>
<p>
    <label for="lastname">Last Name</label><br>
    <input type="text" name="lastname" value="<?php if(isset($_SESSION['lastname'])){
        echo $_SESSION['lastname'];
        
    } ?>" placeholder="Last Name">
</p>
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
    <label for="email">Gender</label><br>
    <select name="gender">
        <option>Select</option>
        <option <?php if(isset($_SESSION['gender']) && isset($_SESSION['gender'])== "Female"){
            echo "selected";
            
        } ?> >Female</option>
        <option <?php if(isset($_SESSION['gender']) && isset($_SESSION['gender'])== "Male"){
            echo "selected";
            
        } ?>
         >Male</option>
    </select>
</p>
<hr>

<p>
    <Label>Designation</Label><br>
    <select name="designation">
        <option>Select</option>
        <option <?php if(isset($_SESSION['designation']) && isset($_SESSION['designation']) == "Medical Team") 
        echo "selected"; 
        ?> >Medical Team</option>
        <option <?php if(isset($_SESSION['designation']) && isset($_SESSION['designation']) == "Patient") 
        echo "selected"; 
         ?>>Patient</option>
    </select>
</p>

<p>
    <label for="department">Department</label><br>
    <input type="text" name="department" value="<?php if(isset($_SESSION['department'])){
        echo $_SESSION['department'];
        session_destroy();
    }
?>" placeholder="Department">
</p>

<p>
    <button type="submit">Register</button> <button type="reset">Reset</button>
</p>
    
</form>

<?php include('lib/footer.php'); ?>