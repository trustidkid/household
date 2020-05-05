<?
    include("lib/header.php");
    require_once('functions/alert.php');
    require_once('functions/user.php');

    echo "<div class='container'>";

    pageTitle("Appointment Preview");
    
    if(isset($_GET['id']) && !empty($_GET['id'])){
        
        $appointmentObject = getSingleAppointment($_GET['id']);

        $date = $appointmentObject -> appointmentdate;
        $department = $appointmentObject -> department;
        $time = $appointmentObject -> appointmenttime;
        $complaint = $appointmentObject -> complaint;
        $natureofappointment = $appointmentObject -> nature_of_appointment;

        echo 
        "<form role='form'>
    <div class='form-group row'>
        <label for='date'>Appointment Date</label><br>
        <input 
        
        type='text' name='appointmentdate' readonly value=".$date." ".$time.">
    </div>
    
    <div class='form-group row'>
        <label for='nature'>Nature of Appointment</label><br>
        <input type='text' name='nature_of_appointment' readonly value=".$natureofappointment.">
    </div>
    <div class='form-group row'>
        <label for='department'>Department</label><br>
        <input type='text' readonly  value=".$department.">
    </div>
    <div class='form-group row'>
    
        <label for='intial complaint'>Initial Complaint</label><br>
        
        <textarea rows='4' readonly cols='53'>".$complaint."</textarea>
    </div>
        
    </form>";
    
    }
    echo "<p>
       
        </p>".
    backButton("dashboard.php");

?>