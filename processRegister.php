<?php
   $errorcount = 0;

   //if first name is empty increment errorcunt variable
   $firstname = $_POST['firstname'] !="" ? $_POST['firstname'] : $errorcount++;
   $lastname = $_POST['lastname'] != "" ? $_POST['lastname'] : "last name empty";
   $email = $_POST['email'] != "" ? $_POST['email'] : $errorcount++;
   $password = $_POST['password'] != "" ? $_POST['password'] : $errorcount++;
   $gender = $_POST['gender'] != "" ? $_POST['gender'] : $errorcount++;
   $designation = $_POST['designation'] != "" ? $_POST['designation'] : $errorcount++;
   $department = $_POST['department'] != "" ? $_POST['password'] : $errorcount++;

   if( $errorcount ){
       //redirect back to register page

       $_SESSION['error'] = "you have '. $errorcount. ' error in your form";
       header('Location: register.php');
   }else{

    echo "success!"; 
    
   }

   
?>