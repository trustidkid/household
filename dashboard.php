<?php 

    include('lib/header.php');
?>

<p>
<h3>Dashboard</h3>

<? if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])){
    echo "<span style='color: green' >". "You are welcome: ". $_SESSION['loggedIn']. "</span>";
    echo "<p>"."Below are your Recorded Data"."</p>";
    echo "<p> Department:  ".$_SESSION['department']."</p>";
    echo "<p> Access Level:  ".$_SESSION['userlevel']."</p>";
    echo "<p> Date of Registration: " . $_SESSION['dateofreg']. "</p";
    echo "<p> Last Login Time:  ".$_SESSION['lastlogin']."</p>";
    //session_destroy();
} ?>
</p>

<? include('lib/footer.php') ?>