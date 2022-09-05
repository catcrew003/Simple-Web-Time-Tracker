<?php
session_start();
        include("functions.php"); //include external php file
        $user_data = check_login($connect); //check if users is log in, redirect to login if not
        date_default_timezone_set('Asia/Manila');
            
            
            
        $emp_id = $user_data['emp_id'];
            if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit'] === "Punch In"){

                $user_id = $user_data['user_id'];
                global $emp_id;

                
                //time
                $date = date("m.d.y");
                $time_in = date('H:i:s');
                
                
                
                //get data
                $take_query = "select * from time_stamp where (date = '$date') AND (emp_id = '$emp_id') limit 1";
                $curr_data = mysqli_query($connect, $take_query);
                    if($curr_data && mysqli_num_rows($curr_data) > 0){
                        $today_punch = mysqli_fetch_assoc($curr_data);

                        if($today_punch['time_in'] !== "" && $today_punch['lunch_in'] == ""){
                            $lunchin = "UPDATE time_stamp SET lunch_in = '$time_in' WHERE (date = '$date') AND (emp_id = '$emp_id')";
                            mysqli_query($connect ,$lunchin);
                            header("Location: confirm.php");
                        }
                        else if($today_punch['lunch_in'] !== "" && $today_punch['lunch_out'] == ""){
                            $lunchout = "UPDATE time_stamp SET lunch_out = '$time_in' WHERE (date = '$date') AND (emp_id = '$emp_id')";
                            mysqli_query($connect ,$lunchout);
                            header("Location: confirm.php");
                        }
                        else if($today_punch['lunch_out'] !== "" && $today_punch['time_out'] == ""){

                            $time_out = "UPDATE time_stamp SET time_out = '$time_in' WHERE (date = '$date') AND (emp_id = '$emp_id')";
                            mysqli_query($connect ,$time_out);
                            header("Location: confirm.php");
                            

                        }
                        
                    } else {
                        $timein_query = "insert into time_stamp (date,emp_id,time_in) values ('$date','$emp_id', '$time_in')";
                        mysqli_query($connect ,$timein_query);
                        header("Location: confirm.php");

                    }
            }
            
// getting all data to display  
$take_allquery = "select * from time_stamp where emp_id = '$emp_id' ORDER BY date DESC";
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
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <nav>
            <div class="parent">
                <div class="child1">
                    <h1>Hello, <?php echo $user_data['emp_id'];?></h1>
                </div>
                <div class="child2">
                    <ul>
                        <li><a href="settings.php">settings</a></li>
                        <li><a href="logout.php">log out</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>


        <div class="divtable">
            <div class="blocktable">
                <table class="timetable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time In</th>
                            <th>Lunch In</th>
                            <th>Lunch Out</th>
                            <th>Time Out</th>
                            <th>Total Hours</th>
                        </tr>
                    </thead>

                    <tbody><?php foreach($alluser_data as 
                    $i  => $user_data): ?>
                        <tr>
                            <td><?php echo $user_data['date']?? "no data found" ?></td>
                            <td><?php echo $user_data['time_in']?? "no data found" ?></td>
                            <td><?php echo $user_data['lunch_in']?? "no data found" ?></td>
                            <td><?php echo $user_data['lunch_out']?? "no data found" ?></td>
                            <td><?php echo $user_data['time_out']?? "no data found" ?></td>

                            <td> <?php if($user_data['time_in'] !== "" && $user_data['time_out'] !== "")
                            {   $time_in = $user_data['time_in'];
                                $time_out = $user_data['time_out'];
                                
                                dateDifference($time_in, $time_out);
                                }?>
                            </td>

                        </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="divbutton">
            <form method="POST">
                <div class="divbutton">
                </div>
                <input type="submit" id="punchin" name="submit" value="Punch In" class="button"></input>
            </form>
        </div>

    </main>
</body>

</html>