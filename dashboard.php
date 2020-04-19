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

echo "<p> <table align='center' vertical-align='center' style='width: 80%; 
line-height='30px' border= 1px solid #dddddd;
text-align=left;'> 
    <caption><h3>Staff / Patient List</h3></caption>
    <tr style='background-color: #344955; color: white'>
        <th style='padding: 10px'>First Name</th> 
        <th style='padding: 10px' >Last Name</th>
        <th style='padding: 10px' >Email Address</th>
        <th style='padding: 10px' >Gender</th>
        <th style='padding: 10px'>Designation</th>
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
        
        echo "<tr style='padding: 15px;'>
                <td style='padding: 5px;'>".$firstname."</td>
                <td style='padding: 10px'>".$lastname."</td>
                <td style='padding: 10px'>".$email."</td>
                <td style='padding: 10px'>".$gender."</td>
                <td style='padding: 10px'>".$designation."</td>
            </tr>";
    
    }

}
echo "</table> </p>";

?>


</p>

<? include('lib/footer.php') ?>