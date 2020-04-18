<? 
    include('lib/header.php');
    require_once('functions/user.php');
    require_once('functions/alert.php');

?>
<?php

print_alert();

dashboard('Patient');
if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])){

  $_SESSION['email'] = $_SESSION['loggedIn'];

  echo "<div><a href='appointment.php'>Book Appointment</a></div <br>". "<div><a href='paybill.php'>Pay Bill</a></div";

}else{
    header("location: login.php");
}

?>
