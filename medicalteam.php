<?php
    include('lib/header.php');
    require_once('functions/user.php');
    require_once('functions/alert.php');


    echo "<div class='container'>";
    pageTitle("Doctor's Corner");

    dashboard("Medical Team");
    
    $appointmentlist = scandir("db/appointment/");
    $userlist = scandir("db/users/");
    $paymentlist = scandir("db/payments/");

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
            <th >Payment Status</th>
            <th >Detail</th>
        </tr>";

    $doctordepartment = $_SESSION['department'];

   /* for($i=2; $i < count($paymentlist); $i++){
        $paymentString = file_get_contents("db/payments/".$paymentlist[$i]);
        $paymentObject = json_decode($paymentString);

        //get appointment id from payment table
        $appointmentidfrompayment = $paymentObject -> appointmentid;
        $status = $paymentObject -> status;

    }*/

    for($count=2; $count < count($appointmentlist); $count++){
            
        //get the list of all appointments
        $appointmentString = file_get_contents("db/appointment/". $appointmentlist[$count]);
        $appointmentObject = json_decode($appointmentString);
        $appointmentdepartment = $appointmentObject -> department;

        //chechk if department patient have appointment with is the same as doctor department
        if($doctordepartment == $appointmentdepartment){
            $countpay = count($paymentlist);
                    
            
            //store number of patient
            $countPatient = $count;
            $appointmentidfromDB = $appointmentObject -> id;
            $appointmentdate = $appointmentObject -> appointmentdate;
            $appointmenttime = $appointmentObject -> appointmenttime;
            $nature_of_appointment = $appointmentObject -> nature_of_appointment;
            $complaint = $appointmentObject -> complaint;
            $dateRegister = $appointmentObject -> date;
            $email = $appointmentObject -> email;

            for($i=2; $i < count($paymentlist); $i++){
                $paymentString = file_get_contents("db/payments/".$paymentlist[$i]);
                $paymentObject = json_decode($paymentString);
        
                //get appointment id from payment table
                $appointmentidfrompayment = $paymentObject -> appointmentid;
                $status = $paymentObject -> status;
                
                //get payment status
                $paymentstatus = "<span class='glyphicon glyphicon-remove' style='color:red;'></span>";
                if($appointmentidfrompayment == $appointmentidfromDB && $status == '1' ){
                    $paymentstatus = "<span class='glyphicon glyphicon-ok' style='color:green'></span>";
                    //break out of the inner loop
                    
                    break;
                }
            }

            //get patient data from user table
            $patientObject = findUser($email);
                    $firstname = $patientObject -> firstname ;
                    $lastname = $patientObject -> lastname;
                    $email = $patientObject -> email;
                    $gender = $patientObject -> gender;
                    $department = $patientObject -> department;
                    $designation = $patientObject -> designation;
                    $id = $patientObject -> id;

                    $_SESSION['patientemail'] = $email;

                    echo "<tr>
                    <td >".$firstname." ".$lastname."</td>
                    <td >".$appointmentdate. " ".$appointmenttime."</td>
                    <td >".$nature_of_appointment."</td>
                    <td >".$complaint."</td>
                    <td >".$doctordepartment."</td>
                    <td  >".$dateRegister."</td>
                    <td style='text-align:center'>".$paymentstatus."</span></td>
                    <td style='text-align:center'>
                        <a href='patientview.php?id=$email'>
                        <span class='glyphicon glyphicon-zoom-in'>
                            </a>
                    </td>".
                    "</tr>";
                }
            }
       // }
        
        //die();
  //  }
    echo "</table>";
    
    //display when no patient department matches doctor department
    if($countPatient <= 2 )
    echo  "<strong><span style='color: red'>You have no pending appointments!</span></strong></div>";
    


?>