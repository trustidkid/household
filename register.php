<?php 
include('lib/header.php'); 
include('functions/alert.php');
include('functions/user.php');

//if user has already logged in
checkUserRole();

?>
<div class='container'>
    <p>
    <? pageTitle("Registration Form");?>
    </p>

    <form role="form" method="POST" action="processRegister.php">

    <?php
    print_alert();
    ?>

    <p>
        <label for="firstname">First Name</label><br>
        <input 
        <?php
            if(isset($_SESSION['firstname'] ) && !empty(isset($_SESSION['firstname']))){
            echo "value=" . $_SESSION['firstname'];
        }
        ?>
        
        type="text" name="firstname"  placeholder="First Name">
    </p>
    <p>
        <label for="lastname">Last Name</label><br>
        <input type="text" name="lastname" value="<?php if(!empty(isset($_SESSION['lastname']))){
            echo $_SESSION['lastname'];
            
        } ?>" placeholder="Last Name">
    </p>
    <p>
        <label for="email">Email</label><br>
        <input type="email" name="email" value="<?php if(!empty(isset($_SESSION['email']))){
            echo $_SESSION['email'];
            
        } ?>" placeholder="Email">
    </p>
    <p>
        <label for="email">Password</label><br>
        <input type="password" name="password" placeholder="Password" require>
    </p>
    <p>
        <label for="gender">Gender</label><br>
        <select name="gender">
            <option>Select</option>
            <option <?php if(!empty(isset($_SESSION['gender'])) && isset($_SESSION['gender'])== "Female"){
                echo "selected";
                
            } ?> >Female</option>
            <option <?php if(!empty(isset($_SESSION['gender'])) && isset($_SESSION['gender'])== "Male"){
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
            <option <?php if(!empty(isset($_SESSION['designation'])) && isset($_SESSION['designation']) == "Super Admin") 
            echo "selected"; 
            ?> >Super Admin</option>
            <option <?php if(!empty(isset($_SESSION['designation'])) && isset($_SESSION['designation']) == "Medical Team") 
            echo "selected"; 
            ?> >Medical Team</option>
            <option <?php if(!empty(isset($_SESSION['designation'])) && isset($_SESSION['designation']) == "Patient") 
            echo "selected"; 
            ?>>Patient</option>
        </select>
    </p>

    <p>
        <label for="department">Department</label><br>
        <input type="text" name="department"  placeholder="Department">
    </p>

    <p>
        <button type="submit">Register</button> <p> <button type="reset">Reset</button></p>
    </p>
        
    </form>

<? backButton("dashboard.php") ?>
</div>