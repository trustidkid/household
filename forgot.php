<?php include('lib/header.php') ?>

    <div class='container'>
        <h3>Forgot Password</h3>
        <p>Provide email address associated with your account </p>

        <form role="form" method="POST" action="processForgot.php">

            <?php
                if(isset($_SESSION['error'] ) && !empty(isset($_SESSION['error']))){
                echo "<span style='color: red' >" . $_SESSION['error'] . "</span>";
                session_unset();
            }
            ?>

            
            <div class="form-group row">
                <label for="email">Enter Email</label><br>
                <input 
                    <?php if(isset($_SESSION['loggedIn'])){
                        echo "value=". $_SESSION['loggedIn'];
                    } ?>
                type="email" name="email" placeholder="Email" require>
            </div>

            <div class="form-group row">
                <button type="submit">Submit</button>
                
            </div>
            
        </form>

    </div>