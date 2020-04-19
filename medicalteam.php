<?php
    include('lib/header.php');
    require_once('functions/user.php');
    require_once('functions/alert.php');


    pageTitle("Doctor Corner");

    dashboard("Medical Team");
    
    $appointmentlist = scandir("db/appointment/");
    $userlist = scandir("db/users/");

echo "<p> <table style='width='100%'; padding:10px; border= 1px solid #dddddd;
text-align=left; background-color= #dddddd;'> 
    <caption>Appointment Lists</caption>
    <tr><th>Full Name</th>
    <th>Appointment Date</th>
    <th>Nature of Appointment</th>
    <th>Initial Complaint</th>
    <th>Department</th>
    <th>Register Date</th>
    <th>Preview</th>
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
                    <td>".$firstname." ".$lastname."</td>
                    <td>".$appointmentdate. " ".$appointmenttime."</td>
                    <td>".$nature_of_appointment."</td>
                    <td>".$complaint."</td>
                    <td>".$doctordepartment."</td>
                    <td>".$dateRegister."</td>
                    <td><a href='patientview.php'>"."View"."</a>.</td>".
                    "</tr>";
                }
            }
        }
    }
    echo "</table> </p>";
    echo "<strong>You have no pending appointments!</strong>";


?>
<p>

</p>
