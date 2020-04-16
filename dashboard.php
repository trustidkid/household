<?php 
    include('lib/header.php');

    require_once('functions/user.php');
?>

<p>
<h3>Dashboard</h3>

<? 
//add dashboard data;
dashboard('Super Admin');

$userlist = scandir("db/users/");
//$email = $_SESSION['loggedIn'];

echo "<p> <table style='width='100%'; border= 1px solid #dddddd;
text-align=left; background-color= #dddddd;'> 
    <caption>List of ".$_SESSION['userlevel']."</caption>
    <tr><th>First Name</th> <th>Last Name</th><th>Email Address</th> <th>Gender</th><</tr>";
for($count=2; $count < count($userlist); $count++){

    $staff = file_get_contents("db/users/". $userlist[$count]);
    //echo "<p> file name". $userlist[$count]. "</p>";
    $staffObject = json_decode($staff);
    $designation = $staffObject -> designation; 

    if($designation == $_SESSION['userlevel']){
        $firstname = $staffObject -> firstname;
        $lastname = $staffObject -> lastname;
        $email = $staffObject -> email;
        $gender = $staffObject -> gender;
        
        echo "<tr><td>".$firstname."</td><td>".$lastname."</td>
        <td>".$email."</td><td>".$gender."</td></tr>";
    
    }

}
echo "</table> </p>";

?>


</p>

<? include('lib/footer.php') ?>