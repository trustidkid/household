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

    <div class="form-group row">
        <label for="date">Appointment Date</label><br>
        <input 
        <?php
            if(isset($_SESSION['appointmentdate'] ) && !empty(isset($_SESSION['appointmentdate']))){
            echo "value=" . $_SESSION['appointmentdate'];
        }
        ?>
        
        type="date" name="appointmentdate"  placeholder="Pick Date">
    </div>
    <div class="form-group row">
        <label for="time">Appointment Time</label><br>
        <input type="text" id="appointmenttime" name="appointmenttime" value="<?php if(isset($_SESSION['appointmenttime'])){
            echo $_SESSION['appointmenttime'];
            
        } ?>" placeholder="16:40">
    </div>
    <div class="form-group row">
        <label for="nature">Nature of Appointment</label><br>
        <input type="text" name="nature_of_appointment" value="<?php if(isset($_SESSION['nature_of_appointment'])){
            echo $_SESSION['nature_of_appointment'];
            
        } ?>" placeholder="Nature of Appointment">
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
        <label for="intial complaint"></label>
        <textarea rows="4" cols="53"  name="complaint" value="
        <?php if(isset($_SESSION['complaint'])){
            echo $_SESSION['complaint'];
            
        } ?>" placeholder="Write initial complaint here"></textarea>
    </div>

    <div class="form-group row">
        <button type="submit">Register</button> </p> <p><button type="reset">Reset</button>
    </div>
        
    </form>


    
    <script>

    var apptime = document.getElementById('appointmenttime');
    apptime.addEventListener('mouseover', mouseOver);
    function mouseOver(){
        document.getElementByName('refid').style.color = 'red';
    } 
</script>

<?php
backButton("patient.php");

echo "</div>";

