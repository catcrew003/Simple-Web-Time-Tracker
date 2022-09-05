<?php
session_start();
        include("functions.php"); //include external php file
        $user_data = check_login($connect); //check if users is log in, redirect to login if not
        
        if($user_data['user_id'] == "11111"){
            header('Location: admin.php');
            die;
        }else{
            header('Location: index.php');
            die;
        }