<? 
    include('lib/header.php');
    require_once('functions/user.php');
    require_once('functions/alert.php');

?>
<?php

echo "<div class='container'>";
print_alert();
pageTitle("Patient's Corner");

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
                  <span class='glyphicon glyphicon-usd'></span> Make Payment
                </a>
          </p> 

        </div";

}else{
    header("location: login.php");
}

?>
