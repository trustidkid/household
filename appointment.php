<?php 
include('lib/header.php'); 
include('functions/alert.php');
include('functions/user.php');

//if user has already logged in
if(!isset($_SESSION['loggedIn']) && empty(isset($_SESSION['loggedIn']))){
    header("location: login.php");
}else{
    header("location: appointment.php");
}

?>
<p>
<H3><strong> Appointment Form </strong></H3>
</p>

<form method="POST" action="processAppointment.php">

<?php
   print_alert();
?>

<p>
    <label for="date">Appointment Date</label><br>
    <input 
    <?php
        if(isset($_SESSION['date'] ) && !empty(isset($_SESSION['appointmentdate']))){
        echo "value=" . $_SESSION['appointmentdate'];
    }
    ?>
    
    type="date" name="appointmentdate"  placeholder="Pick Date">
</p>
<p>
    <label for="time">Appointment Time</label><br>
    <input type="text" name="appointmenttime" value="<?php if(isset($_SESSION['time'])){
        echo $_SESSION['time'];
        
    } ?>" placeholder="Appointment Time">
</p>
<p>
    <label for="nature">Nature of Appointment</label><br>
    <input type="text" name="nature_of_appointment" value="<?php if(isset($_SESSION['nature_of_appointment'])){
        echo $_SESSION['nature_of_appointment'];
        
    } ?>" placeholder="Nature of Appointment">
</p>
<p>
    <label for="department">Department</label><br>
    <input type="text" name="department" value="<?php if(isset($_SESSION['department'])){
        echo $_SESSION['department'];
    }
?>" placeholder="Department">
</p>
<p>
    <label for="intial complaint"></label>
    <textarea rows="4" cols="20" name="complaint" placeholder="Write initial complaint here"></textarea>
</p>

<p>
    <button type="submit">Register</button> <button type="reset">Reset</button>
</p>
    
</form>

<?php include('lib/footer.php'); ?>