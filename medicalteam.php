<?php
    include('lib/header.php');
    require_once('functions/user.php');
    require_once('functions/alert.php');


    pageTitle("Doctor Corner");

    dashboard("Medical Team");
    
    $appointmentlist = scandir("db/appointment/");
    $userlist = scandir("db/users/");

    echo "<table align='center' vertical-align='center' style='width: 80%; 
    line-height='30px'; border= 1px solid #dddddd; text-align=left;'>
    <caption><h3>Appointment List</h3></caption>
        <tr style='background-color: #344955; color: white'>
            <th style='padding: 10px'>Full Name</th>
            <th style='padding: 10px'>Appointment Date</th>
            <th style='padding: 10px'>Nature of Appointment</th>
            <th style='padding: 10px'>Initial Complaint</th>
            <th style='padding: 10px'>Department</th>
            <th style='padding: 10px'>Register Date</th>
            <th style='padding: 10px'>Preview</th>
        </tr>";

    $doctorEmail = $_SESSION['loggedIn'].".json";
    //Search for Doctor's department
    for($i =2; $i < count($userlist); $i++){
        
        if($doctorEmail == $userlist[$i]){
            $doctorString = file_get_contents("db/users/". $userlist[$i]);
            $doctorObject = json_decode($doctorString);
            $doctordepartment = $doctorObject -> department;

            for($count=2; $count < count($appointmentlist); $count++){

                //get the list of all appointments
                $appointmentString = file_get_contents("db/appointment/". $appointmentlist[$count]);
                $appointmentObject = json_decode($appointmentString);
                $appointmentdepartment = $appointmentObject -> department;

                //if($appointmentString == )

                //chechk if department patient have appointment with is the same as doctor department
                if($doctordepartment == $appointmentdepartment){

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


                    $_SESSION['patientemail'] = $email;
                    $_SESSION['gender'] = $gender;
                    $_SESSION['fullname'] = $firstname." ".$lastname;
                    $_SESSION['department'] = $department;
                    $_SESSION['designation'] = $designation;

                    echo "<tr>
                    <td style='padding: 10px'>".$firstname." ".$lastname."</td>
                    <td style='padding: 10px'>".$appointmentdate. " ".$appointmenttime."</td>
                    <td style='padding: 10px'>".$nature_of_appointment."</td>
                    <td style='padding: 10px'>".$complaint."</td>
                    <td style='padding: 10px'>".$doctordepartment."</td>
                    <td style='padding: 10px'>".$dateRegister."</td>
                    <td style='padding: 10px'><a href='patientview.php'>"."View"."</a>.</td>".
                    "</tr>";
                }
            }
        }
    }
    echo "</table> </p>";
    echo "<strong><span style='margin-left:10%'>You have no pending appointments!</span></strong>";


?>
<p>

</p>
