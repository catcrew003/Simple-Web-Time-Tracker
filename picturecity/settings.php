<?php
session_start();
    include("functions.php");
    $user_data = check_login($connect); //check if users is log in, redirect to login if not
    $user_id = $user_data['emp_id'];
    
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $oldpass = $_POST['curr_pass'];
        $pass = $_POST['new-pass'];
        $con_pass = $_POST['confirm-pass'];

        if($user_data['password'] === $oldpass){
        if($pass === $con_pass){
            global $user_id;
            $newpass_query = "UPDATE users SET password = '$pass' WHERE (user_id = '$user_id')";
            mysqli_query($connect ,$newpass_query);
            echo "<div class='green'>password successfully changed!</div>";
        }else {
            echo "<div class='red'>password not match!</div>";
        }
    }}


?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        Picture City Timecard
    </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="settings.css">
</head>

<body>
    <header>
        <nav>
            <div class="parent">
                <div class="child1">
                    <h1>Hello, $Name</h1>
                </div>
                <div class="child2">
                    <ul>
                        <li><a href="redirect.php">home</a></li>
                        <li><a href="logout.php">log out</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="user-setting">
                <ul class="form-style">
                    <form method="POST">
                        <li>
                            <label for="password">Current Password:</label>
                            <input type="password" name="curr_pass" placeholder="current password" class="short-form"
                                required>
                        </li>
                        <li><label for="password">New Password</label>
                            <input type="password" name="new-pass" placeholder="New Password" class="short-form"
                                required>
                            <input type="password" name="confirm-pass" placeholder="Confirm New Password"
                                class="short-form" required>
                        </li>
                        <li><input type="submit" value="Reset" class="button"></input></li>
                    </form>
                </ul>
            </div>




        </div>
    </main>
    <script src="" async defer></script>
</body>

</html>