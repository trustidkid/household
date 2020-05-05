<?php
    require_once('alert.php');

    function is_user_loggedIn(){

        if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])){
            return true;
        }
        return false;

    }

    //check if token is set for user not logged in
    function is_token_set(){
       return is_token_set_session() || is_token_set_get();
    }

    function is_token_set_session(){
        return isset($_SESSION['token']);
    }

    function is_token_set_get(){
        return isset($_GET['token']);
    }


    function checkEmail(){
        if(isset($_SESSION['email']) && !empty($_SESSION['email'])) {
            echo $_SESSION['email'];
        }
    }

    /**
     * Check if an appointment already exist
     * $email: The user mail
     * $department: Department he intend to book appointment with
     * $appointmentdate: The date of the appointment
     */
    function paymentExists($paymentid){

        $allpayment = scandir("db/payments/");
        
        for($counter = 1; $counter <= count($allpayment); $counter++){
            $filename = "pay_".$counter.".json";
            $paymentString = file_get_contents("db/payments/". $filename);
            $paymentObject = json_decode($paymentString);
            $paymentfromDB = $paymentObject -> paymentid;

            if($paymentfromDB == $paymentid){
                return $appointmentObject;
           }
        }
        return false;
    }
    /**
     * Get a single appointment
     */

    function getSingleAppointment($id){
        if(!$id || $id == ""){
            set_alert("error", "User email not found");
            header("location: dashboard.php");
            die();
        }

        $allappointment = scandir("db/appointment/");
        
        for($counter = 1; $counter <= count($allappointment); $counter++){
            $filename = "ap_".$counter.".json";
            $appointmentString = file_get_contents("db/appointment/". $filename);
            $appointmentObject = json_decode($appointmentString);
            $idfromDb = $appointmentObject -> id;

            if($id == $idfromDb){
                return $appointmentObject;
           }
        }
        return false;
    }

    /**
     * Check if an appointment already exist
     * $email: The user mail
     * $department: Department he intend to book appointment with
     * $appointmentdate: The date of the appointment
     */
    function findAppointment($email = "", $department, $appointmentdate ){
        if(!$email){
            set_alert("error", "User email not found");
            die();
        }

        $allappointment = scandir("db/appointment/");
        
        for($counter = 1; $counter <= count($allappointment); $counter++){
            $filename = "ap_".$counter.".json";
            $appointmentString = file_get_contents("db/appointment/". $filename);
            $appointmentObject = json_decode($appointmentString);
            $appointmentdatefromDb = $appointmentObject -> appointmentdate;
            $departmentfromDb = $appointmentObject -> department;
            $emailfromDb = $appointmentObject -> email;

            if($appointmentdatefromDb == $appointmentdate && $departmentfromDb == $department && $email == $emailfromDb){
                return $appointmentObject;
           }
        }
        return false;
    }

    /**
     * Get all apppointments under user account
     * $email: the user email account
     */
    function getUserAppointment($folder,$email){
        for($count=2; $count < count($folder); $count++){
            
            //get the list of all appointments
            $appointmentString = file_get_contents("db/appointment/". $folder[$count]);
            $appointmentObject = json_decode($appointmentString);
            $emailfromDB = $appointmentObject -> email;
            
            if($emailfromDB == $email){
                
                    $id= $appointmentObject -> id;
                    $appointmentdate = $appointmentObject -> appointmentdate;
                    $appointmenttime = $appointmentObject -> appointmenttime;
                    $department = $appointmentObject -> department;
                    $nature_of_appointment = $appointmentObject -> nature_of_appointment;
                    $complaint = $appointmentObject -> complaint;
              
                    echo "
                    <tr>     
                        <td >".$appointmentdate. " ".$appointmenttime."</td>
                        <td >".$nature_of_appointment."</td>
                        <td >".$complaint."</td>
                        <td >".$department."</td>
                                    
                        <td>
                          <a href='paybill.php?id=$id' class='btn btn-warning btn-sm' >
                          <span class='glyphicon glyphicon-check'>Pay</span>
                          </a>
                        </td>
                    </tr></div>";
            }
       }
}

    function findUser($email = ""){

        if(!$email){
            set_alert("error", "User email not found");
            die();
        }

        $allusers = scandir("db/users/");
        
        for($counter = 0; $counter < count($allusers); $counter++){
            $currentuser = $email.".json";
            //check for email
            if($allusers[$counter] == $currentuser){

                //compare user password with database
                $userString = file_get_contents("db/users/". $currentuser);
                $userObject = json_decode($userString);
    
                return $userObject;
            }
        }
        return false;
    }

    function savePayment($paymentObject){

        file_put_contents("db/payments/".$paymentObject['email'].".json", json_encode($paymentObject));
    }

    function saveUser($userObject){

        file_put_contents("db/users/".$userObject['email'].".json", json_encode($userObject));
    }

    function saveAppointment($filename,$AppointmentObject){
        file_put_contents("db/users/".$filename.".json", json_encode($AppointmentObject));
    }

    function updateRecord($email){

                
                        $userString = file_get_contents("db/users/".$email);
                        $userObject = json_decode($userString); 
                        
                        //modify the password
                        $userObject -> password = password_hash($password, PASSWORD_DEFAULT);
                        //delete the existing file
                        unlink("db/users/".$email);
                        //unlink("db/users/".$userObject['email'].".json");
                        

                        //save the updated user data to the database
                        file_put_contents("db/users/".$email.".json",json_encode($userObject));
                
            
    }

    //Displays initial user data on the dashboard
    function dashboard($role = ""){
        if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && $_SESSION['userlevel'] == $role){
            echo "<table class='table table-striped table-bordered table-hover'>

                    <caption><h3>Basic Data</h3></caption>
                    <tr style='background-color: #344955; color: white'>
                        <th >Login Time</th>
                        <th >Role</th>
                        <th >Department</th>
                        <th>Date Register</th>
                        <th style='padding: 10px'>Last Login Time</th>
                    </tr>
                    <tr>
                        <td >".$_SESSION['logintime']."</td>
                        <td >".$_SESSION['userlevel']."</td>
                        <td>".$_SESSION['department']."</td>
                        <td >".$_SESSION['dateregister']."</td>
                        <td>".$_SESSION['lastlogin']."</td>
                    </tr>
                </table><div>";   
        }
        return false;
    }

    function checkUserRole(){
        if(isset($_SESSION['loggedIn']) && !empty(isset($_SESSION['loggedIn']))){
            //check user role
            
            if($_SESSION['userlevel']=='Patient'){
                header("location: patient.php");
                die();
            }
            if($_SESSION['userlevel']=='Medical Team'){
                header("location: medicalteam.php");
                die();
            }
    
        }
    }

    function sendMail(){
        $mail->setFrom('no-reply@snh.com', 'SNH Hospital');
        $mail->addReplyTo('info@msnh.com', 'SNH');
        $mail->addAddress($email, 'user'); 
        $mail->addCC('yemi.bili07@gmail.com', 'client');
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->Body = $message;

        if($mail->send()){
            set_alert("message","Password reset was successful for account ".$email);
            header("location: logout.php");
        }else{
            $content = "Something went wrong. We cannot proceed further. Please try again later ".$username;
            set_alert("error",$content);
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            header("location: reset.php");
        }
    }

    function tableHeader($caption){
       echo "<table class='table table-striped table-bordered table-hover'>
    <caption><h3>".$caption."</h3></caption>
    <tr style='background-color: #344955; color: white'>
        <th >First Name</th> 
        <th>Last Name</th>
        <th >Email Address</th>
        <th >Gender</th>
        <th>Designation</th>
    </tr>";
    }

    /**
     * $userlist: The table
     * $userDesignation: specify the type of user level eg. patient or medical team
     */
    //returns list of user with similar role
    function getUserList($userlist, $userDesignation){
        for($count=2; $count < count($userlist); $count++){

            $staff = file_get_contents("db/users/". $userlist[$count]);
            //echo "<p> file name". $userlist[$count]. "</p>";
            $staffObject = json_decode($staff);
            $designation='';
            //TODO: To seperate staff from patient on the list
            $designation = $staffObject -> designation;
        
           if( $designation == $userDesignation){
                $firstname = $staffObject -> firstname;
                $lastname = $staffObject -> lastname;
                $email = $staffObject -> email;
                $gender = $staffObject -> gender;
                
                echo "<tr>
                        <td>".$firstname."</td>
                        <td >".$lastname."</td>
                        <td >".$email."</td>
                        <td >".$gender."</td>
                        <td>".$designation."</td>
                    </tr>";
            }
        }
        echo "</table>";
    }

    function getPaymentPerUser($folder, $useremail){

        for($count=2; $count < count($folder); $count++){

            $foldername = file_get_contents("db/payments/". $folder[$count]);
            $folderObject = json_decode($foldername);
            if($folderObject -> email == $useremail){
                $id = $folderObject -> appointmentid;
                $date = $folderObject -> paymentdate;
                $amount = $folderObject -> amount;
                echo "<tr>
                        <td>".$date."</td>
                        <td >".$useremail."</td>
                        <td>".$amount."</td>
                        <td>
                            <a href='appointment.php?id=$id'>
                                        view
                            </a>
                        </td>
                        
                    </tr>";
            }
            
        }

    }

    /**
     * Get the list of payment made by patients
     */

function getAllPayment(){
    $folder = scandir("db/payments");
        
    for($count=2; $count < count($folder); $count++){

        $paymentString = file_get_contents("db/payments/". $folder[$count]);
        $paymentObject = json_decode($paymentString);
        $paymentdate = $paymentObject -> paymentdate;
        $patientemail = $paymentObject -> email;
        $amount = $paymentObject -> amount;
        $appointmentid = $paymentObject -> appointmentid;
        echo "
        <tr>       
            <td>".$paymentdate."</td>
            <td >".$patientemail."</td>
            <td style='text-align:center; width:10%'>".$amount."</td>
            <td style='text-align:center; width:5%'>
                <a href='viewappointment.php?id=$appointmentid'>
                <span class='glyphicon glyphicon-zoom-in'></span>
                </a>
            </td>        
        </tr>";
        }
        
     }

    function pageTitle($title){
        $userlogin ="";
        if($_SESSION['loggedIn'])
            $userlogin = $_SESSION['loggedIn'];
        else $userlogin;
        echo "<div class='container'><div class='nav navbar-nav navbar-right'>
            <span style='color: grey; font-size:16px'>".$userlogin. "</span>
            </div>".
            "<p>
             <h3><span style='color:#344955;'>".$title."</span></h3>
            <hr> 
        </p>";
    }

    function backButton($page){
        echo "<a href='$page' class='btn btn-info btn-lg'>&laquo; Back</a>";
    }

    /**
     * This method generate token
     * $arrayAlphabet: array of number of character (number or alphabet)
     * $tokenSize: length of characters to generate
     * */
    function generateToken($arrayAlphabet, $tokenSize){
        $token = "";
        for($i = 0; $i <= $tokenSize; $i++){
            //pick a number between 0 and total numbers in letters
            $index = mt_rand(0,count($arrayAlphabet)-1);
            $token .= $arrayAlphabet[$index];

        }
        
        return $token;
    }
?>