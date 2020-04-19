<?php

session_start();

require_once('functions/user.php');
require_once('functions/alert.php');

   $errorcount = 0;

   //if first name is empty increment errorcunt variable
   $appointmentdate = $_POST['appointmentdate'] !="" ? $_POST['appointmentdate'] : $errorcount++;
   $appointmenttime = $_POST['appointmenttime'] != "" ? $_POST['appointmenttime'] : $errorcount++;
   $nature_of_appointment = $_POST['nature_of_appointment'] != "" ? $_POST['nature_of_appointment'] : $errorcount++;
   $complaint = $_POST['complaint'] != "" ? $_POST['complaint'] : $errorcount++;
   $department = $_POST['department'] != "" ? $_POST['department'] : $errorcount++;


   $_SESSION['appointmentdate'] = $appointmentdate;
   $_SESSION['appointmenttime'] = $appointmenttime;
   $_SESSION['nature_of_appointment'] = $nature_of_appointment;
   $_SESSION['complaint'] = $complaint;
   $_SESSION['department'] = $department;

  
   if(isset($_SESSION['loggedIn'])){
        $email = $_SESSION['loggedIn'];
    }

   if( $errorcount > 0 ){
        $_SESSION['error'] = "You have " . $errorcount . " error";

       if($errorcount > 1) $_SESSION['error'] .= "s";
   
       $_SESSION['error'] .=  " in your form";
       header('Location: appointment.php');
   }else{

    //generate appointment ID
    $directory = "db/appointment";
    $allUsers = scandir($directory);
    $newAppointmentID = (count($allUsers)-2) +1; //removes the leading two empty files in the directory

    $dateRegister =date('d-m-yy H:i:s');
    $filename = "ap_".$newAppointmentID;


    //create a json object
    $appointmentObject = [
        'id'=>$newAppointmentID,
        'email' => $email,
        'appointmentdate'=>$appointmentdate,
        'appointmenttime'=> $appointmenttime,
        'nature_of_appointment'=>$nature_of_appointment,
        'complaint'=> $complaint,
        'department' => $department,
        'date' => $dateRegister
    ];
    //echo "got here the  is ". $email;
    //die();
    //check that user has not book appointment same day before
    $appointmentExists = findAppointment($email,$department,$appointmentdate);
    //echo $appointmentExists;
    //die();
    
    if($appointmentExists){
        $content = "Registration failed. appointment already exist";
        set_alert("error", $content);
        header("location: appointment.php");
        //terminate
        die();
    }
    
    //TODO: To ensure patient can save multiple records with same name
    //save user 
    //saveAppointment($filename,$appointmentObject);
    $save = file_put_contents("db/appointment/".$filename.".json",json_encode($appointmentObject));
    //echo $save;
    //die();
    if ($save){
        $content = "Thank you for contacting us! See you at the hospital.";
        set_alert("message",$content);
        //redirect
        header('location: appointment.php');
        die();
    }
    $content = "Something went wrong! We cannot save this appointment at this moment. Contact administrator";
    set_alert("error",$content);
    
   }

   
?>