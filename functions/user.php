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

    function findUser($email = ""){

        if(!$email){
            set_alert("error", "User email not found");
            die();
        }

        $allusers = scandir("db/users/");
        
        for($counter = 0; $counter < count($allusers); $counter++){
            $email = $email.".json";
            //check for email
            if($allusers[$counter] == $email){

                //compare user password with database
                $userString = file_get_contents("db/users/". $email);
                $userObject = json_decode($userString);
    
                return $userObject;
            }
        }
        return false;
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
        <th >Last Name</th>
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

    function pageTitle($title){
        echo "<div class='nav navbar-nav navbar-right'>
            <span style='color: grey; font-size:16px'>". $_SESSION['loggedIn']. "</span>
            </div>".
            "<p>
             <h3><span style='color:#344955;'>".$title."</span></h3>
            <hr> 
        </p>";
    }

    function backButton($page){
        echo "<a href='$page' class='btn btn-info btn-lg'>&laquo; Back</a>";
    }
?>