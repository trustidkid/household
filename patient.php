<? 
    include('lib/header.php');
    require_once('functions/user.php');
    require_once('functions/alert.php');

?>
<?php

echo "<div class='container'>";

pageTitle("Patient's Corner");
print_alert();

//returns patient login data
dashboard('Patient');
echo "<p>
</p>";
echo "<table class='table table-striped table-bordered table-hover'>
      <caption><h3>Payment History</h3></caption>
      <th>Payment date</th>
      <th>Email</th>
      <th>Amount Paid</th>
      <th>View appointment</th>";

if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])){

  echo "<div >
            <p>
                <a href='appointment.php' class='btn btn-warning btn-lg'>
                  <span class='glyphicon glyphicon-random'></span> Book Appointment
                </a>
                
          </p></div>";
          
        
  //list of payment made so far
  $email = $_SESSION['loggedIn'];
  //payment folder
  $folder = scandir('db/payments/');
  $patientObject = getPaymentPerUser($folder,$email);

  $appointmentlist = scandir("db/appointment/");
  echo "<div>
      <table class='table table-striped table-bordered table-hover'>
      <caption><h3>Appointments</h3></caption>
      <tr style='background-color: #344955; color: white'>

          <th>Appointment Date</th>
          <th>Nature of Appointment</th>
          <th >Initial Complaint</th>
          <th>Department</th>
          
          <th >Pay</th>
      </tr>";
  //returns the list of booked appointment
  $appointmentObject = getUserAppointment($appointmentlist,$email);

}else{
    header("location: login.php");
}

?>

