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

//create a table
tableHeader("Medical Team");
//returns the list of medical team
getUserList($userlist,"Medical Team");


//create a table
tableHeader("List of Patient");
//returns the list of patient
getUserList($userlist,"Patient");
?>