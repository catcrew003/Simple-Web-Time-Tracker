<?php
session_start();
    include("functions.php");
    $user_data = check_login($connect); //check if users is log in, redirect to login if not

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        
        //reset user password
        if(isset($_POST['reset'])){
            $user_empid = $_POST['emp_id'];
            $query_emp_id = "Select * from users where emp_id = '$user_empid' limit 1";
            $result = mysqli_query($connect ,$query_emp_id);
            
            if($result){
                if($result && mysqli_num_rows($result) > 0){
                    $user_empid = $_POST['emp_id'];
                    $user_newpass = $_POST['pass_reset'];
                    $user_newuserpasscon = $_POST['conpass_reset'];

                if($user_newpass === $user_newuserpasscon){
                $newpass_query = "UPDATE users SET password = '$user_newpass' WHERE (user_id = '$user_empid')";
                mysqli_query($connect ,$newpass_query);
                echo "<div class='green'>password successfully changed!</div>";
                header("Location: admin-confirm.php");
            }else{
                echo "<div class='red'>the password did not match! try again</div>";
        }
            }    else{
                echo "<div class='red'>can't reset password. wrong employee ID please try again</div>";
        }

        }}
        

        // add new user
        
        if(isset($_POST['submit'])){
        $new_empname = $_POST['new_empname'];
        $new_empid = $_POST['new_empid'];
        $newuser_password = $_POST['newuser_password'];

        if(!empty($new_empid) && !empty($newuser_password)){

            $query = "insert into users (user_id,emp_id,password) values ('$new_empid','$new_empname','$newuser_password')";
            mysqli_query($connect ,$query);
            echo "<div class='green'>new account successfully added!</div>";
            header("Location: admin-confirm.php");
        }
    }} 


    $take_allquery = "select * from users ORDER BY user_id";
    $take_all = mysqli_query($connect, $take_allquery);
    $alluser_data = mysqli_fetch_all($take_all, MYSQLI_ASSOC);
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
                    <h1>Hello, admin</h1>
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
                            <label for="password">Employee ID:</label>
                            <input type="text" name="emp_id" placeholder="#####" class="short-form" required>
                        </li>
                        <li><label for="password">Password Reset</label>
                            <input type="password" name="pass_reset" placeholder="New Password" class="short-form"
                                required>
                            <input type="password" name="conpass_reset" placeholder="Confirm New Password"
                                class="short-form" required>
                        </li>
                        <li><input type="submit" name="reset" value="Reset" class="button"></input></li>
                    </form>
                </ul>
            </div>
            <div class="add-user">
                <ul class="form-style">
                    <form method="POST">
                        <li><label for="new-name">Employee Name:</label>
                            <input type="text" name="new_empname" placeholder="Primitivo Mejares" class="long-form"
                                pattern="[A-Za-z\s]*" required>
                        </li>
                        <li><label for="new-name">Employee No:</label>
                            <input type="text" name="new_empid" placeholder="#######" class="long-form" pattern="[0-9]*"
                                required>
                        </li>
                        <li><label for="password">Password</label><input type="password" name="newuser_password"
                                placeholder="Password" class="long-form" required>
                        </li>
                        <li><input type="submit" name="submit" value="Create User" class="button"></input></li>
                    </form>
                </ul>
            </div>



        </div>
    </main>
    <script src="" async defer></script>
</body>

</html>