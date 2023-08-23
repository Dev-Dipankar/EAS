<?php
    //Session Start
    session_start();
    if(isset($_SESSION['username'])){
        echo "Welcome ". $_SESSION['username'];
        echo "<br>". $_SESSION['login'];
        echo "<br>";
    }
    else{
        echo "Please Login to continue";
    }
?>