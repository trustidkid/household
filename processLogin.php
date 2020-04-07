<?php

session_start();
print_r($_POST);
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
        
        //check for email
        if($allusers[$counter] == $username.".json"){
            //echo "inside first loop " ."<br/>";
            $currentuser = $username.".json";
            //compare user password with database
            $userString = file_get_contents("db/users/". $currentuser);
            $userObject = json_decode($userString);
            $passwordfromDb = $userObject -> password;
            $userlevel = $userObject -> designation;
            $userDept = $userObject -> department;
            $dateregister = $userObject -> date;
            $passwordfromUser = password_verify($password,$passwordfromDb);

            if($passwordfromDb == $passwordfromUser){

                //retrieve the last login time
                $alluserlogin = scandir("db/userlog/");
                for($count = 0; $count < count($alluserlogin); $count++){
                    $currentuser = $alluserlogin[$count];
                    if($currentuser = $username.".json"){
            
                        $loginString = file_get_contents("db/userlog/".$currentuser);
                        $loginObject = json_decode($loginString);
                        $lastlogintime = $loginObject -> logintime;
                    }
            
                }

                $loginobject = [
                    'email' => $username,
                    'logintime' => $logintime,
                ];
                
                file_put_contents("db/userlog/".$username.".json", json_encode($loginobject));
            
                //save parameters in a session
                $_SESSION['loggedIn'] = $username;
                $_SESSION['department']= $userDept;
                $_SESSION['userlevel'] = $userlevel;
                $_SESSION['dateregister'] = $dateregister;
                $_SESSION['lastlogin'] = $lastlogintime;
                $_SESSION['logintime'] = $logintime;
                //$_SESSION['superadmin']= "admin";

                header("location: dashboard.php");

                //redirect to dashboard
               /* $_SESSION['loggedIn'] = "You are welcome " . $username . 
                "<span style='color: black'><p> Login Time:  
                ". $logintime ."</p></span>";
                header("location: login.php"); */
            }else{
                $_SESSION['error'] = "Either username or password is wrong";
                header('location: login.php');
            }
        }
   } 
}


?>