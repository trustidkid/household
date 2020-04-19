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
        if(isset($_SESSION['email'])) {
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

    function saveUser($userObject){

        file_put_contents("db/users/".$userObject['email'].".json", json_encode($userObject));
    }

    function saveAppointment($filename,$AppointmentObject){
        file_put_contents("db/users/".$filename.".json", json_encode($AppointmentObject));
    }

    function updateRecord($userObject){

    }

    //TODO: To add boostrap to the dashboard.
    //To display initial user data on the dashboard
    function dashboard($role = ""){
        if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && $_SESSION['userlevel'] == $role){
    
            echo "<div class='container'><p>" ."<span style='color: green; font-size:16px' >". "You are welcome ". $_SESSION['email']. "</span>"."</p>";
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
                        <td style='padding: 10px'>".$_SESSION['logintime']."</th>
                        <td >".$_SESSION['userlevel']."</th>
                        <td>".$_SESSION['department']."/th>
                        <td >".$_SESSION['dateregister']."</th>
                        <td>".$_SESSION['lastlogin']."</th>
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

    function pageTitle($title){
        echo "<p>
             <h3><span style='color:#344955; margin-left:10%'>".$title."</span></h3>
            <hr> 
        </p>";
    }

    function backButton($page){
       // echo "<a href='$page'><img src=''/><span style='color: #f9aa33'><strong>Back</strong></span></a>";
        echo "<a href='$page' class='previous'>&laquo; Back</a>";
    }
?>