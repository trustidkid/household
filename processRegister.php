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

   $_SESSION['firstname'] = $firstname;
   $_SESSION['lastname'] = $lastname;
   $_SESSION['email'] = $email;
  // $_SESSION['password'] = $password;
   $_SESSION['gender'] = $gender;
   $_SESSION['designation'] = $designation;
   $_SESSION['department'] = $department;

   if( $errorcount > 0 ){
       //redirect back to register page

       $_SESSION['error'] = "you have " . $errorcount. " error in your form";
       header('Location: register.php');
   }else{
    //save to a fill

    //create a json object
    $userObject = [
        'id'=>1,
        'firstname'=>$firstname,
        'lastname'=> $lastname,
        'email'=>$email,
        'password'=> $password,
        'gender'=> $gender,
        'designation' => $designation,
        'department' => $department
    ];

    $_SESSION['user']= $userObject;

    file_put_contents("db/users/".$firstname.$lastname.".json", json_encode($userObject));

    $_SESSION['message'] = "Registration was successful, you can now login!". $firstname;
    //redirect
    header('location: login.php');
    
   }

   
?>