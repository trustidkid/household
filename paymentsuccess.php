<? 
    include("lib/header.php");
    require_once("functions/alert.php");
    require_once("functions/user.php");

    /**
 * PHPMAILER SETUP START
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//require "user/composer/autoload_real.php";
//require "/usr/local/bin/composer/autoload.php";
require_once 'vendor/autoload.php';

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = 'smtp.mailtrap.io';
$mail->SMTPAuth = true;
$mail->Username = '854743967f9a4e'; 
$mail->Password = 'b0306ceb161ca1';
$mail->SMTPSecure = 'tls';
$mail->Port = 2525;

/**
 * PHPMAILER SETUP END
 */

 echo "<div>".print_alert()."</div><br><div>".backButton("patient.php")."</div>";

if (isset($_GET['txref'])) {

    
    $id = $_SESSION['id'];
    $appointmentid = $_SESSION['appointmentid'];
    $transId = $_SESSION['transid'];
    $email = $_SESSION['email'];
    $paymentdate = $_SESSION['paymentdate'];
    $amountfromDB = $_SESSION['amount'];

    $ref = $_GET['txref'];
    //echo $ref;
    $amount = $amountfromDB;// ""; //Correct Amount from Server
    $currency = "NGN"; //Correct Currency from Server

      $query = array(
          "SECKEY" => "FLWSECK_TEST-393e6fa1643d867b0725e1c26b5c2983-X",
          "txref" => $ref
      );

      $data_string = json_encode($query);
              
      $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');                                                                      
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

      $response = curl_exec($ch);

      $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
      $header = substr($response, 0, $header_size);
      $body = substr($response, $header_size);

      curl_close($ch);

      $resp = json_decode($response, true);

      $paymentStatus = $resp['data']['status'];
      $chargeResponsecode = $resp['data']['chargecode'];
      $chargeAmount = $resp['data']['amount'];
      $chargeCurrency = $resp['data']['currency'];

      if (($chargeResponsecode == "00" || $chargeResponsecode == "0") &&
       ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
        // transaction was successful...
           // please check other things like whether you already gave value for this ref
        // if the email matches the customer who owns the product etc
        //Give Value and return to Success page
        if($ref == $transId){
              
              //generate appointment ID
              $directory = "db/payments/";
              $allUsers = scandir($directory);
              $id = (count($allUsers)-2) +1; //removes the leading two empty files in the directory
          
              $paymentdate =date('d-m-yy H:i:s');
              $filename = "pay_".$id;

              $paymentObject = [
                'id' => $id,
                'appointmentid' => $appointmentid,
                'transid' => $transId,
                'email' => $email,
                'paymentdate' => $paymentdate,
                'amount' => $amount,
                'status' => 1
              ];
            
            //save user 
              $save = file_put_contents("db/payments/".$filename.".json",json_encode($paymentObject));
              if($save){

                $subject = "Payment was successful";
                $message = "Your payment has been received. "."<br>"."Thank you";

                $mail->setFrom('no-reply@snh.com', 'SNH Hospital');
                $mail->addReplyTo('info@msnh.com', 'SNH');
                $mail->addAddress($email, 'user'); 
                $mail->addCC('yemi.bili07@gmail.com', 'client');
                $mail->Subject = $subject;
                $mail->isHTML(true);
                $mail->Body = $message;

                if($mail->send()){
                    set_alert("message","Payment was successful");
                    header("location: patient.php");
                }else{
                    $content = "Something went wrong. We cannot proceed further. Please try again later ".$username;
                    set_alert("error",$content);
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                    header("location: patient.php");
                }

              }else{
                  set_alert("error","Payment cannot be saved");
              }

            }
            
            header("location: patient.php");
            } else {
                //Dont Give Value and return to Failure page
                header("location: error.php");
            }
      }
     // else {
       //   die('No reference supplied');
  //}

  //backButton("patient.php");
?>
