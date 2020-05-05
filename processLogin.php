<?php

session_start();

//print_r($_POST); die();
$counterror = 0;
$username = $_POST['email'] != "" ? $_POST['email'] : $counterror++;
$password = $_POST['password'] != "" ? $_POST['password'] : $counterror++;

//$username = "";
$userDept = "";
$userlevel = "";
$lastlogintime = "";
$dateregister = "";
$logintime = "";

if( $counterror > 0){

    $_SESSION['error'] = "You have " . $counterror . " error";

    if($counterror > 1) $_SESSION['error'] .= "s";

    $_SESSION['error'] .=  " in your form";

    header("location: login.php");

}else{

    //$logintime = date('D, d M Y H:i:s');
    $logintime = date('d-m-yy H:i:s');

    $allusers = scandir("db/users");
    //$countusers = count($allusers);

    for($counter = 0; $counter < count($allusers); $counter++){
        $currentuser = $username.".json";
        //check for email
        if($allusers[$counter] == $currentuser){
            //echo "inside first loop " ."<br/>";
            
            //compare user password with database
            $userString = file_get_contents("db/users/". $currentuser);
            $userObject = json_decode($userString);
            $passwordfromDb = $userObject -> password;
            $firstname = $userObject -> firstname;
            $lastname = $userObject -> lastname;
            $userlevel = $userObject -> designation;
            $userDept = $userObject -> department;
            $dateregister = $userObject -> date;
            $passwordfromUser = password_verify($password,$passwordfromDb);

            if($passwordfromDb != $passwordfromUser){
                $_SESSION['error'] = "Either username or password is wrong";
                    header('location: login.php');
            }
            else{

                echo 'got here';
                //retrieve the last login time
                $alluserlogin = scandir("db/userlog/");
                for($count = 0; $count < count($alluserlogin); $count++){
                    $currentuser = $alluserlogin[$count];
                    if($currentuser = $username.".json"){
                       // echo $currentuser;
                       // die();
            
                        $loginString = file_get_contents("db/userlog/".$currentuser);
                        $loginObject = json_decode($loginString);
                        $lastlogintime = $loginObject -> logintime;
                        if(!$lastlogintime){
                            $lastlogintime = "First Timer";
                        }
                    }
            
                }
                //update user login time
                $loginobject = [
                    'email' => $username,
                    'logintime' => $logintime,
                ];
                
                //save user login time
                file_put_contents("db/userlog/".$username.".json", json_encode($loginobject));
                //save parameters in a session
                $_SESSION['loggedIn'] = $username;
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;
                $_SESSION['email'] = $username;
                $_SESSION['department']= $userDept;
                $_SESSION['userlevel'] = $userlevel;
                $_SESSION['dateregister'] = $dateregister;
                $_SESSION['lastlogin'] = $lastlogintime;
                $_SESSION['logintime'] = $logintime;
                //$_SESSION['superadmin']= "admin";

                //redirect user to respective page
                if($userlevel == "Super Admin"){
                    header("location: dashboard.php");
                }
                else if($userlevel == "Medical Team"){
                    header("location: medicalteam.php");
                }else{
                    header("location: patient.php");
                }
            }
            //echo 'got here now';
        }
   }
}


?>