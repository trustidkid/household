<?php
    include('lib/header.php');
    require_once('functions/user.php');
    require_once('functions/alert.php');

    dashboard("Medical Team");

    $appointmentlist = scandir("db/appointment/");
    $userlist = scandir("db/users/");

echo "<p> <table style='width='100%'; border= 1px solid #dddddd;
text-align=left; background-color= #dddddd;'> 
    <caption>Appointment Lists</caption>
    <tr><th>Full Name</th>
    <th>Appointment Date</th>
    <th>Nature of Appointment</th>
    <th>Initial Complaint</th>
    <th>Department</th>
    <th>Preview</th>
    </tr>";

    $currentUser = $_SESSION['loggedIn'];
    //get Doctor department
    for($i =2; $i < count($userlist); $i++){
        
        if($currentUser == $userlist[$i].".json"){
            $doctorString = file_get_contents("db/users/". $userlist[$i]);
            $doctorObject = json_decode($doctorString);
            $doctordepartment = $appointmentObject -> department;

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
                    
                    //get patient data from user table
                    $patientString = file_get_contents("db/users/".$appointmentlist[$i]);
                    $patientObject = json_decode($patientString);
                    $fullname = $patientObject -> firstname ;
                    $lastname = $patientObject -> lastname;
                    $email = $patientObject -> email;

                    $_SESSION['patientemail'] = $email;

                }
            }

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


echo "</table> </p>";
echo "<strong>You have no pending appointments!</strong>";

?>
<p>

</p>
