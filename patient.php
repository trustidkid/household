<? 
    include('lib/header.php');
    require_once('functions/user.php');

?>
<?php

//add dashboard data
dashboard('Patient');

echo "<div><a href='appointment.php'>Book Appointment</a></div <br>". "<div><a href='paybill.php'>Pay Bill</a></div";

?>
