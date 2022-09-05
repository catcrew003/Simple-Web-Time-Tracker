<?php
session_start();
include("functions.php");


//////////////////////////////////////////////////

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $emp_id = $_POST['emp_id'];
        $password = $_POST['password'];

    if(!empty($emp_id) && !empty($password)){


    $query = "Select * from users where user_id = '$emp_id' limit 1";
    $result = mysqli_query($connect ,$query);
    
    if($result){
        
        if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            
            if($user_data['password'] === $password){
                $_SESSION['user_id'] = $user_data['user_id'];

                if($user_data['user_id'] == "11111"){
                    header('Location: admin.php');
                    die;
                }else{
                    header('Location: index.php');
                      die; }

                }
                
            }
            
        }
    }
}



?>

<!-- FRONT END HERE -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Picture City Attendance</title>
    <link href="login.css" rel="stylesheet">
</head>

<body>
    <main>
        <div class="container">
            <div class="logo">
                <image src="logo.png" class="logo" alt="picture city logo"></image>
            </div>
            <div class="login__form">
                <form method="POST" class="login">
                    <div class="login__input">
                        <input type="text" name="emp_id" pattern="[0-9]*" placeholder="Employee ID" class="input"
                            required>
                    </div>
                    <div class="login__input">
                        <input type="password" name="password" placeholder="Password" class="input" required>
                    </div>
                    <div class="button-peg">

                    </div>
                    <div class="submit__button input">
                        <input type="submit" value="Log In" class="button">
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer></footer>
</body>

</html>