<?php 
    include('lib/header.php');

    require_once('functions/user.php');
    require_once('functions/alert.php');
    
?>
<? 
echo "<div class='container'>";
pageTitle("Admin's Corner");
//add dashboard data;
dashboard('Super Admin');

$userlist = scandir("db/users/");

echo "div style='float:right'>";
//create a table
tableHeader("Medical Team");
//returns the list of medical team
getUserList($userlist,"Medical Team");
echo "</div>";

//create a table
tableHeader("List of Patient");
//returns the list of patient
getUserList($userlist,"Patient");

//returns the list of payments
echo "<table style='width:50%; align:center' class='table table-striped table-bordered table-hover'>
        <caption><h3>Payment History</h3></caption>
        <tr style='background-color: #344955; color: white'>
        <th >Payment Date</th> 
        <th>Patient Email</th>
        <th >Amount</th>
        <th>Details...</th>
        </tr>";
getAllPayment();
echo "</table>";




?>