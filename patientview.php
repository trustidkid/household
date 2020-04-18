<?
    include("lib/header.php");
    require_once('functions/alert.php');
    require_once('functions/user.php');

    
    $patientemail = $_SESSION['patientemail'];
    $gender = $_SESSION['gender'];
    $fullname = $_SESSION['fullname'];
    $department = $_SESSION['department'];
    $designation = $_SESSION['designation'];
    
    
    echo "<p>
             <h3>Patient Data Preview</h3>
            <hr> 
        </p>";
    
    if(isset($_SESSION['patientemail']) && !empty($_SESSION['patientemail'])){
        echo "<p><table style='border:1px solid, color:red'>
        <th>Full Name</th><th>Email Address</th><th>Gender</th><th>Department</th><th>Designation</th>
        <tr>
                <td>".$fullname."</td>
                <td>".$patientemail."</td>
                <td>".$gender."</td>
                <td>".$department."</td>
                <td>".$designation."</td>

        </tr></table></p>";
    
    }
    echo "<p>
            <hr>
        </p>";
    echo "<a href='medicalteam.php'><img src=''/><span style='color: grey'><strong>Back</strong></span></a>";

?>