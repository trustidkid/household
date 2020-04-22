<?php
    include('lib/header.php');
    require_once('functions/user.php');
    require_once('functions/alert.php');


    echo "<div class='container'>";
    pageTitle("Doctor Corner");

    dashboard("Medical Team");
    
    $appointmentlist = scandir("db/appointment/");
    $userlist = scandir("db/users/");

    echo "
        <table class='table table-striped table-bordered table-hover'>
        <caption><h3>Appointment List</h3></caption>
        <tr style='background-color: #344955; color: white'>
            <th >Full Name</th>
            <th >Appointment Date</th>
            <th>Nature of Appointment</th>
            <th >Initial Complaint</th>
            <th >Department</th>
            <th >Register Date</th>
            <th >Preview</th>
        </tr>";

    $doctorEmail = $_SESSION['loggedIn'].".json";
    //Search for Doctor's department
    for($i =2; $i < count($userlist); $i++){
        
        if($doctorEmail == $userlist[$i]){
            $doctorString = file_get_contents("db/users/". $userlist[$i]);
            $doctorObject = json_decode($doctorString);
            $doctordepartment = $doctorObject -> department;

            for($count=2; $count < count($appointmentlist); $count++){
                $countPatient ="";
                //get the list of all appointments
                $appointmentString = file_get_contents("db/appointment/". $appointmentlist[$count]);
                $appointmentObject = json_decode($appointmentString);
                $appointmentdepartment = $appointmentObject -> department;

                //if($appointmentString == )

                //chechk if department patient have appointment with is the same as doctor department
                if($doctordepartment == $appointmentdepartment){

                    $countPatient = $count;
                    $appointmentdate = $appointmentObject -> appointmentdate;
                    $appointmenttime = $appointmentObject -> appointmenttime;
                    $nature_of_appointment = $appointmentObject -> nature_of_appointment;
                    $complaint = $appointmentObject -> complaint;
                    $dateRegister = $appointmentObject -> date;
                    $email = $appointmentObject -> email;
                    
                    //get patient data from user table
                    $patientString = file_get_contents("db/users/".$email.".json");
                    $patientObject = json_decode($patientString);
                    $firstname = $patientObject -> firstname ;
                    $lastname = $patientObject -> lastname;
                    $email = $patientObject -> email;
                    $gender = $patientObject -> gender;
                    $department = $patientObject -> department;
                    $designation = $patientObject -> designation;
                    $id = $patientObject -> id;

                    echo "<tr>
                    <td >".$firstname." ".$lastname."</td>
                    <td >".$appointmentdate. " ".$appointmenttime."</td>
                    <td >".$nature_of_appointment."</td>
                    <td >".$complaint."</td>
                    <td >".$doctordepartment."</td>
                    <td >".$dateRegister."</td>
                    <td>
                        <a href='patientview.php?id=$email'>
                            view
                            </a>
                    </td>".
                    "</tr>";
                }
            }
        }
        
        //die();
    }
    echo "</table>";
    //display when no patient department matches doctor department
    if($countPatient < 1)
    echo  "<strong><span style='color: red'>You have no pending appointments!</span></strong></div>";
    


?>