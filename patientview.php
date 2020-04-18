<?
    session_start();

    include("lib/header.php");
    require_once('functions/alert.php');
    require_once('functions/user.php');

    //get patient ID
    $patientemail = $_SESSION['patientemail'];
    $userList = scandir("db/users/");
    
    if(isset($_SESSION['patientemail']) && !empty($_SESSION['patientemail'])){
        echo "<table>";
        echo "<th>First Name</th>"."<th>Last Name</th>"."<th>Email Address</th>"."<th>Gender/th>"."<th>Department</th>";
        for($j =0; $j < count($userList); $j++ ){

            //get the user
            if($userList[$j] == $patientemail){

                //loop throught the records
                $patientString = file_get_contents("db/users/".$patientemail.".json");
                $patientObject = json_decode($userList);

                $firstname = $patientObject -> firstname;
                $lastname = $patientObject -> lastname;
                $email = $patientObject -> email;
                $gender = $patientObject -> gender;
                $department = $patientObject -> department;

            }

            echo "<tr>
                    <td>".$firstname."</td>
                    <td>".$lastname."</td>
                    <td>".$email."</td>
                    <td>".$gender."</td>
                    <td>".$department."</td>
                </tr>";
        }
        echo "</table>";
    }
    
    echo "<p> <hr> </p>". 
    "<a href='medicalteam.php'><span style='color: grey'><strong>Back</strong></span></a>"

?>