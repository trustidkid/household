<?php 

session_start();
include('lib/header.php'); ?>

<p>Login Page</p>
<p>
    <?php
        if(isset($_SESSION['message'] ) && !empty(isset($_SESSION['message']))){
        echo "<span style='color: green' >" . $_SESSION['message'] . "</span>";
        session_destroy();
    }
    ?>

 </p>

<?php include('lib/footer.php'); ?>