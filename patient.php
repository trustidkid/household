<? 
    include('lib/header.php');
    require_once('functions/user.php');
    require_once('functions/alert.php');

?>
<?php

print_alert();
pageTitle("Patient Corner");

dashboard('Patient');
echo "<p>
</p>";

if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])){

  echo "<div >
            <p>
                <a href='appointment.php' class='btn btn-warning btn-lg'>
                  <span class='glyphicon glyphicon-random'></span> Book Appointment
                </a>
                <a href='paybill.php' class='btn btn-success btn-lg'>
                  <span class='glyphicon glyphicon-usd'></span> Pay Bill
                </a>
          </p> 

        </div";

}else{
    header("location: login.php");
}

?>
