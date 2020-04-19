<?php 
    include('lib/header.php');

    require_once('functions/user.php');
    require_once('functions/alert.php');
    
?>

<p>


<? 
pageTitle("Admin Corner");
//add dashboard data;
dashboard('Super Admin');

$userlist = scandir("db/users/");

echo "<div class='container'> <table class='table table-striped table-bordered table-hover'>
    <caption><h3>Staff / Patient List</h3></caption>
    <tr style='background-color: #344955; color: white'>
        <th >First Name</th> 
        <th >Last Name</th>
        <th >Email Address</th>
        <th >Gender</th>
        <th>Designation</th>
    </tr>";
for($count=2; $count < count($userlist); $count++){

    $staff = file_get_contents("db/users/". $userlist[$count]);
    //echo "<p> file name". $userlist[$count]. "</p>";
    $staffObject = json_decode($staff);
    $designation='';
    //TODO: To seperate staff from patient on the list
    $designation = $staffObject -> designation;

   if($designation == "Medical Team" || $designation == "Patient"){
        $firstname = $staffObject -> firstname;
        $lastname = $staffObject -> lastname;
        $email = $staffObject -> email;
        $gender = $staffObject -> gender;
        
        echo "<tr>
                <td>".$firstname."</td>
                <td >".$lastname."</td>
                <td >".$email."</td>
                <td >".$gender."</td>
                <td>".$designation."</td>
            </tr>";
    
    }

}
echo "</table> </div>";

?>


</p>

<? include('lib/footer.php') ?>