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

  echo "<div style='margin-left:10%; display:block; width: 200px; background-color: #f9aa33;'>
          <a href='appointment.php'>Book Appointment</a>
        </div"."||||".
      "<div style='margin-right:40%'><a href='paybill.php'>Pay Bill</a></div";

}else{
    header("location: login.php");
}

?>
