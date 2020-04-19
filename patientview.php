<?
    include("lib/header.php");
    require_once('functions/alert.php');
    require_once('functions/user.php');

    
    $patientemail = $_SESSION['patientemail'];
    $gender = $_SESSION['gender'];
    $fullname = $_SESSION['fullname'];
    $department = $_SESSION['department'];
    $designation = $_SESSION['designation'];
    
    
    pageTitle("Patient Data Preview");
    
    if(isset($_SESSION['patientemail']) && !empty($_SESSION['patientemail'])){
        echo "<div class='container'> <table class='table table-striped table-bordered table-hover'>
        <th>Full Name</th><th>Email Address</th><th>Gender</th><th>Department</th><th>Designation</th>
        <tr>
                <td>".$fullname."</td>
                <td>".$patientemail."</td>
                <td>".$gender."</td>
                <td>".$department."</td>
                <td>".$designation."</td>

        </tr></table> </div></p>";
    
    }
    echo "<p>
            <hr>
        </p>".
    backButton("medicalteam.php")."</div>";

?>