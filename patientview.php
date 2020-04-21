<?
    include("lib/header.php");
    require_once('functions/alert.php');
    require_once('functions/user.php');

    echo "<div class='container'>";

    pageTitle("Patient Data Preview");
    
    if(isset($_SESSION['patientemail']) && !empty($_SESSION['patientemail'])){
        echo "<div class='container'> <table class='table table-striped table-bordered table-hover'>
        <th>Full Name</th><th>Email Address</th><th>Gender</th><th>Department</th><th>Designation</th>
        <th>Date Register</th>
        <tr>";
        
        $userObject = findUser($_GET['id']);

        $firstname = $userObject -> firstname;
        $lastname = $userObject -> lastname;
        $gender = $userObject -> gender;
        $department = $userObject -> department;
        $designation = $userObject -> designation;
        $dateregister = $userObject -> date;
        $email = $userObject -> email;

        echo 
        "<td>".$firstname." ". $lastname ."</td>
        <td>".$email."</td>
        <td>".$gender."</td>
        <td>".$department."</td>
        <td>".$designation."</td>
        <td>".$dateregister."</td>

        </tr></table> </div>";
    
    }
    echo "<p>
            <hr>
        </p>".
    backButton("medicalteam.php");

?>