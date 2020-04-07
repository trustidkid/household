<?php

session_start();
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
    $_SESSION['error'] = "Name cannot be blank or shouldn't have number";
    header('location: register.php');
    die();
}
if(strlen($lastname) < 2 || strlen($firstname) < 2)  {
    $_SESSION['error'] = "Provided name is too short";
    header('location: register.php');
    die();
}

if( strlen($splitemail[0]) < 5 || strpos($splitemail[1],".") == 0) {
    $_SESSION['error'] = "Email cannot be less than 5 characters and/or not a valid email";
    header('location: register.php');
    die();
}

   $_SESSION['firstname'] = $firstname;
   $_SESSION['lastname'] = $lastname;
   $_SESSION['email'] = $email;
  // $_SESSION['password'] = $password;
   $_SESSION['gender'] = $gender;
   $_SESSION['designation'] = $designation;
   $_SESSION['department'] = $department;


   if( $errorcount > 0 ){
       //redirect back to register page

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

    $dateRegister = date('d-m-yy H:i:s');


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

    $_SESSION['user']= $userObject;

    //check user exist
    for($counter =0; $counter < count($allUsers); $counter++){

        //check for email
        if($allUsers[$counter] == $email.".json"){

            $_SESSION['error'] = "Registration failed. User already exist";
            header("location: register.php");
            //terminate the loop
            die();

        }
    }

    file_put_contents("db/users/".$email.".json", json_encode($userObject));
    //file_put_contents("db/userlog/".$username.".json", json_encode($loginobject));

    $_SESSION['message'] = "Registration was successful, you can now login! ". $firstname;
    //redirect
    header('location: login.php');
    
   }

   
?>