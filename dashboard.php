<?php 
    include('lib/header.php');
?>

<p>
<h3>Dashboard</h3>

<? if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])){
    
    echo "<span style='color: green' >". "You are welcome: ". $_SESSION['loggedIn']. "</span>";
    echo "<p>"."Below are your Recorded Data"."</p>". "<hr>".
    "<p> Time Login:  "."\t".$_SESSION['logintime']."</p>".
    "<p> Department:  "."\t".$_SESSION['department']."</p>".
     "<p> Access Level:  "."\t".$_SESSION['userlevel']."</p>".
    "<p> Date Register: "."\t" . $_SESSION['dateregister']. "</p" ."<br/>".
    //if(isset($_SESSION['lastlogin']) == "") {
    //    echo "<p> Last Login time:". " First Timer ". "</p";
    //} else 
    "<p> Last Login time: " . $_SESSION['lastlogin']. "</p>";
    //session_destroy();
    echo "user still login"  .$_SESSION['loggedIn'];
} 

$stafflist = scandir("db/users/");
//$email = $_SESSION['loggedIn'];

echo "<p> <table style='width='100%'; border= 1px solid #dddddd;
text-align=left; background-color= #dddddd;'> 
    <caption>List of ".$_SESSION['userlevel']."</caption>
    <tr><th>First Name</th> <th>Last Name</th><th>Email Address</th> <th>Gender</th><</tr>";
for($count=2; $count < count($stafflist); $count++){

    $staff = file_get_contents("db/users/". $stafflist[$count]);
    //echo "<p> file name". $stafflist[$count]. "</p>";
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