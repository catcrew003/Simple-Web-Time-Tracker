<?php


session_start();
        include("functions.php"); //include external php file
        $user_data = check_login($connect); //check if users is log in, redirect to login if not
        header("Location: index.php");