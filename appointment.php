<?php 
include('lib/header.php'); 
include('functions/alert.php');
include('functions/user.php');

//if user has already logged in
?>
<? 
    if(!isset($_SESSION['loggedIn']) && empty(isset($_SESSION['loggedIn']))){
        header("location: login.php");
    }
?>
<div class='container'>
    <p>
        <? pageTitle("Appointment Registration"); ?>
    </p>

    <form method="POST" role="form" action="processAppointment.php">
    <p>
    <?php
    print_alert();
    ?>
    </p>

    <p>
        <label for="date">Appointment Date</label><br>
        <input 
        <?php
            if(isset($_SESSION['appointmentdate'] ) && !empty(isset($_SESSION['appointmentdate']))){
            echo "value=" . $_SESSION['appointmentdate'];
        }
        ?>
        
        type="date" name="appointmentdate"  placeholder="Pick Date">
    </p>
    <p>
        <label for="time">Appointment Time</label><br>
        <input type="text" name="appointmenttime" value="<?php if(isset($_SESSION['appointmenttime'])){
            echo $_SESSION['appointmenttime'];
            
        } ?>" placeholder="16:40">
    </p>
    <p>
        <label for="nature">Nature of Appointment</label><br>
        <input type="text" name="nature_of_appointment" value="<?php if(isset($_SESSION['nature_of_appointment'])){
            echo $_SESSION['nature_of_appointment'];
            
        } ?>" placeholder="Nature of Appointment">
    </p>
    <p>
        <label for="department">Department</label><br>
        <input type="text" name="department" placeholder="Department">
    </p>
    <p>
        <label for="intial complaint"></label>
        <textarea rows="4" cols="53" name="complaint" value="
        <?php if(isset($_SESSION['complaint'])){
            echo $_SESSION['complaint'];
            
        } ?>" placeholder="Write initial complaint here"></textarea>
    </p>

    <p>
        <button type="submit">Register</button> </p> <p><button type="reset">Reset</button>
    </p>
        
    </form>


<?php
backButton("patient.php");

echo "</div>";
include('lib/footer.php'); ?>

