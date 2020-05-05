<?php
    
    function set_alert($type = "message", $content = ""){
        switch($type){
            case "message":
                $_SESSION['message'] = $content;
            break;

            case "error":
                $_SESSION['error'] = $content;
            break;

            case "info":
                $_SESSION['info'] = $content;
            break;

            default:
                $_SESSION['message'] = $content;
            break;
        }
    }

    function print_alert(){
        $type = ['message', 'error', 'info'];
        $color = ['green','red','grey'];

        for($i = 0; $i<count($type); $i++){
            if(isset($_SESSION[$type[$i]]) && !empty(isset($_SESSION[$type[$i]]))){
                echo "<span style='color:".$color[$i]."' >" . $_SESSION[$type[$i]] . "</span>";
            }
            $_SESSION[$type[$i]] = "";
        }
        
    }
?>