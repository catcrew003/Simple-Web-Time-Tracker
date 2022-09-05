<?php




// functions lot of functions
function check_login($connect) {
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id = '$id' limit 1";
        $result = mysqli_query($connect, $query);

        if($result && mysqli_num_rows($result) > 0){
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }

        
    }

    // if the result is false, redirect to login page
    header("location: login.php");
    die;
}

function dateDifference($date_1 , $date_2 , $differenceFormat = '<b>%h hour</b>: %i minutes: %s second' )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
   
    $interval = date_diff($datetime1, $datetime2);
    echo $interval->format($differenceFormat);
   
}

function isAdmin($logins){
if($logins == "11111"){
}else{
    echo "hidden";
}}



// everything about connection

$dbhost = "127.0.0.1"; //127.0.0.1
$dbuser = "root";
$dbpass = ""; 
$dbname = "lulzboat"; 


if(!$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){
    die("connection error");
}