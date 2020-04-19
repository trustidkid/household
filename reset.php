<?php

include('lib/header.php');
require_once('functions/user.php');
require_once('functions/alert.php');

   if(!is_user_loggedIn() && !is_token_set()){
        $_SESSION['error'] = "You are not authorised to view this page";
        header("location: login.php");
    }
    
?>
<div class='container'>

<h3>Reset Password</h3>
<p>Reset password associated with your account: <? checkEmail();?> </p>
<form role="form" method="POST" action="processReset.php">
        <?php
            print_alert();
        ?>
        
        <div class="form-group row">
                <label for="email">Email</label><br>
                <input 
                <? 
                    checkEmail();
                ?>
                type="email" name="email" placeholder="Email" require>
        </div>

        <div class="form-group row">
            <?php if(!is_user_loggedIn()){?>
            <input
                <? 
                    if(is_token_set_session()){
                        echo "value= '".$_SESSION['token']."'";
                    }else{
                        echo "value= '".$_GET['token']."'";
                    }
                ?>
            type="hidden" name="token">
            <?php }?>
        </div>

        
        <div class="form-group row">
            <label for="email">Enter New Password</label><br>
            <input type="password" name="password" placeholder="Password" require>
        </div>

        <div class="form-group row">
            <button type="submit">Reset Password</button>
        
        </div>
    
    </form>
    </div>
</div>