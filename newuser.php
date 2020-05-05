<?php 
include('lib/header.php'); 
include('functions/alert.php');
include('functions/user.php');

//if user has already logged in
checkUserRole();

?>
<div class='container'>
    <p>
        <h3>Registration Form</h3>
    </p>

    <form role="form" method="POST" action="processRegister.php">

    <?php
    print_alert();
    ?>

    <div class="form-group row">
        <label for="firstname">First Name</label><br>
        <input 
        <?php
            if(isset($_SESSION['firstname'] ) && !empty(isset($_SESSION['firstname']))){
            echo "value=" . $_SESSION['firstname'];
        }
        ?>
        
        type="text" name="firstname"  placeholder="First Name">
    </div>
    <div class="form-group row">
        <label for="lastname">Last Name</label><br>
        <input type="text" name="lastname" value="<?php if(!empty(isset($_SESSION['lastname']))){
            echo $_SESSION['lastname'];
            
        } ?>" placeholder="Last Name">
    </div>
    <div class="form-group row">
        <label for="email">Email</label><br>
        <input type="email" name="email" value="<?php if(!empty(isset($_SESSION['email']))){
            echo $_SESSION['email'];
            
        } ?>" placeholder="Email">
    </div>
    <div class="form-group row">
        <label for="email">Password</label><br>
        <input type="password" name="password" placeholder="Password" require>
    </div>
    <div class="form-group row">
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
    </div>
    <hr>

    <div class="form-group row">
        <Label>Designation</Label><br>
        <select name="designation">
            <option>Select</option>
            <option <?php if(!empty(isset($_SESSION['designation'])) && isset($_SESSION['designation']) == "Medical Team") 
            echo "selected"; 
            ?> >Medical Team</option>
            <option <?php if(!empty(isset($_SESSION['designation'])) && isset($_SESSION['designation']) == "Patient") 
            echo "selected"; 
            ?>>Patient</option>
        </select>
    </div>

    <div class="form-group row">
        <label for="department">Department</label><br>
        <select name="department">
            <option selected="selected">Select</option>
            <option <?php if(!empty(isset($_SESSION['department'])) && isset($_SESSION['department'])== "Services"){
                echo "selected";
                
            } ?> >Services</option>
            <option <?php if(!empty(isset($_SESSION['department'])) && isset($_SESSION['department'])== "Laboratory"){
                echo "selected";
                
            } ?>
            >Laboratory</option>
        </select>
    </div>

    <div class="form-group row">
        <button type="submit">Register</button> <br>
    </div>
        <div class="form-group row">
        <button type="reset">Reset</button></p>
    </div>
        
    </form>

<? backButton("dashboard.php") ?>
</div>