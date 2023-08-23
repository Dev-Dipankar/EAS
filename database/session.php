<?php
    //Verifying User Login
    session_start();
    $_SESSION['username'] = "Dipankar";
    $_SESSION['login'] = "You are Logged IN";
    echo "Session Created.";
?>