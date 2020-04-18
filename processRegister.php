<?php

session_start();

require_once('functions/user.php');
require_once('functions/alert.php');

   $errorcount = 0;

   //if first name is empty increment errorcunt variable
   $firstname = $_POST['firstname'] !="" ? $_POST['firstname'] : $errorcount++;
   $lastname = $_POST['lastname'] != "" ? $_POST['lastname'] : "last name empty";
   $email = $_POST['email'] != "" ? $_POST['email'] : $errorcount++;
   $password = $_POST['password'] != "" ? $_POST['password'] : $errorcount++;
   $gender = $_POST['gender'] != "" ? $_POST['gender'] : $errorcount++;
   $designation = $_POST['designation'] != "" ? $_POST['designation'] : $errorcount++;
   $department = $_POST['department'] != "" ? $_POST['password'] : $errorcount++;

   $splitemail = explode("@",$email);

   //check name contains number
   if(preg_match('~[0-9]~',$firstname) || preg_match('~[0-9]~',$lastname) || $firstname =="" || $lastname==""){
    $content = "Name cannot be blank or shouldn't have number";
    set_alert("error", $content);
    header('location: register.php');
    die();
}
if(strlen($lastname) < 2 || strlen($firstname) < 2)  {
    $content = "Provided name is too short";
    set_alert("error", $content);
    header('location: register.php');
    die();
}

if( strlen($splitemail[0]) < 5 || strpos($splitemail[1],".") == 0) {
    $content = "Email cannot be less than 5 characters and/or not a valid email";
    set_alert("error", $content);
    header('location: register.php');
    die();
}

   $_SESSION['firstname'] = $firstname;
   $_SESSION['lastname'] = $lastname;
   $_SESSION['email'] = $email;
   $_SESSION['gender'] = $gender;
   $_SESSION['designation'] = $designation;
   $_SESSION['department'] = $department;


   if( $errorcount > 0 ){
       //redirect back to register page
       // $content = "You have " . $errorcount . " error";
       // set_alert("error", $content);
        $_SESSION['error'] = "You have " . $errorcount . " error";

       if($errorcount > 1) $_SESSION['error'] .= "s";
   
       $_SESSION['error'] .=  " in your form";
       header('Location: register.php');
   }else{
    //save to a file

    //auto generate ID
    $directory = "db/users";
    $allUsers = scandir($directory);
    $newUser  = (count($allUsers)-2) +1; //removes the leading two empty files in the directory

    $dateRegister =date('d-m-yy H:i:s');


    //create a json object
    $userObject = [
        'id'=>$newUser,
        'firstname'=>$firstname,
        'lastname'=> $lastname,
        'email'=>$email,
        'password'=> password_hash($password,PASSWORD_DEFAULT),
        'gender'=> $gender,
        'designation' => $designation,
        'department' => $department,
        'date' => $dateRegister
    ];

    //check user exist
    $userExists = findUser($email);
    
    if($userExists){

        $content = "Registration failed. User already exist";
        set_alert("error", $content);
        header("location: register.php");
        //terminate
        die();
    }
    
    //save user
    saveUser($userObject);
    $content = "Registration was successful, you can now login! ". $firstname;
    set_alert("message",$content);
    //redirect
    header('location: register.php');
    
   }

   
?>