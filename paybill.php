<? 
    include('lib/header.php');

    require_once('functions/user.php');
    require_once('functions/alert.php');

    //returns a transaction reference id
    $value = $alphabet = ['a','b','c','d','e','f','g','h','i','A','B','C','E','F','H',"I",'1','2'.'3','4','5','6','7','8','9','0'];
    $size = 9;
    $transId = generateToken($value, $size);
    //if(strlen($transId) > $size)
    //echo $transId. "<br>"; echo strlen($transId); die();

    echo "<div class='container'>";
    if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])){
        
            echo "<div class='col-sm-12'> 
            ".pageTitle('Bill Process')."
            </div>";
    
            echo "<div class='col-sm-2'>
            </div>  
            <div class='col-sm-8'>";
            echo "<form role='form' method='POST'>
                <div class='form-row'>".print_alert()."
                
                </div>
                <div class='form-row'>
                <input type='text' readonly id='firstname' name='firstname' value=".$_SESSION['firstname'].">
                </div>
                <div class='form-row'>
                    <input type='text' readonly id ='lastname'  name='lastname' value=".$_SESSION['lastname'].">
                </div>
                <div class='form-row'>
                    <input type='text' readonly id='email' name='email' value=".$_SESSION['loggedIn'].">
                </div>
                <div class='form-row'>
                    <input type='text' readonly id='phonenumber' name='phonenumber' value='08038171939'>
                </div>
                <div class='form-row'>
                    <input type='text' readonly id='refid' name='refid' value=".$transId." >
                </div>
                <div class='form-row'>
                    <input type='text' id='amount' name='amount' placeholder='Enter amount to pay'>
                </div>
                <div class='form-row'>
                    
                    <button type='submit' id='submit' name='submit'>Pay Now</button>
                    
                </div>
      </form><p></p>";

      if(isset($_POST['submit'])){

        $amount = $_POST['amount'] != "" ? $_POST['amount'] : set_alert("error","Please enter amount.");
        $appointmentid = $_GET['id'];
        $email = $_SESSION['loggedIn'];
        
        //generate appointment ID
        $directory = "db/payments/";
        $allUsers = scandir($directory);
        $id = (count($allUsers)-2) +1; //removes the leading two empty files in the directory
    
        $paymentdate =date('d-m-yy H:i:s');
        $filename = "pay_".$id;

        $_SESSION['id'] = $id;
        $_SESSION['appointmentid'] = $appointmentid;
        $_SESSION['transid'] = $transId;
        $_SESSION['email'] = $email;
        $_SESSION['paymentdate'] = $paymentdate;
        $_SESSION['amount'] = $amount;


        $curl = curl_init();

        $customer_email = $email;// "user@example.com";
        $amount = $amount; //3000;  
        $currency = "NGN";
        $txref = $transId; //"rave-29933838"; // ensure you generate unique references per transaction.
        $PBFPubKey = "FLWPUBK_TEST-1ec2dc5fac181874c2c2ec4298398fbf-X"; // get your public key from the dashboard.
        $redirect_url = "http://localhost:8080/household/paymentsuccess.php";
        //$payment_plan = "pass the plan id"; // this is only required for recurring payments.


        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode([
            'amount'=>$amount,
            'customer_email'=>$customer_email,
            'currency'=>$currency,
            'txref'=>$txref,
            'PBFPubKey'=>$PBFPubKey,
            'redirect_url'=>$redirect_url,
            'payment_plan'=>$payment_plan
          ]),
          CURLOPT_HTTPHEADER => [
            "content-type: application/json",
            "cache-control: no-cache"
          ],
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        if($err){
          // there was an error contacting the rave API
          die('Curl returned error: ' . $err);
        }

        $transaction = json_decode($response);

        if(!$transaction->data && !$transaction->data->link){
          // there was an error from the API
          print_r('API returned error: ' . $transaction->message);
        }

        // uncomment out this line if you want to redirect the user to the payment page
        //print_r($transaction->data->message);


        // redirect to page so User can pay
        // uncomment this line to allow the user redirect to the payment page
        header('Location: ' . $transaction->data->link);
      }

      backButton("patient.php");
      echo "</div>
      </div>";
        
    }
?>

