<?php 
    include('lib/header.php');
?>

<p>
<h3>Dashboard</h3>

<? if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']) && $_SESSION['userlevel'] == 'Super Admin'){
    
    echo "<p>" ."<span style='color: green' >". "You are welcome: ". $_SESSION['loggedIn']. "</span>"."</p>".
    "<p>"."<a href='register.php'><span class='glyphicon glyphicon-user'></span> Register</a>"."</p"."<p>".
    "<hr style='border: 2px solid'>"."<p>";

    echo "<div class='card bg-info text-white'>";
    echo "<div class='card-header'><strong>Record Book</strong></div>";
    echo "<div class='card-body'>Time In:- " . $_SESSION['logintime']. "</div>
    <hr>
    <div class='card-body'>Role:- ".$_SESSION['userlevel']."</div>
    <hr>
    <div class='card-body'>Department:- ".$_SESSION['department']."</div>
    <hr>
    <div class='card-body'>Date Register:- ".$_SESSION['dateregister']."</div>
    <hr>
    <div class='card-body'>Last Login Time:- ".$_SESSION['lastlogin']."</div>
    <hr>
  </div>";

}

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