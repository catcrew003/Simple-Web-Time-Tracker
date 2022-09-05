<?php 

session_start(); 
include("functions.php"); //include external php file 
$user_data=check_login($connect); //check if users is log in, redirect to login if not 



// getting all data to display  
// if($_SERVER['REQUEST_METHOD'] == 'POST')
// {
    global $alluser_data;
    global $take_allquery;
    global $take_all;

    $option = isset($_POST['employee_id']) ? $_POST['employee_id'] : false ?? 0;
    if ($option) {
    //    echo htmlentities($_POST['employee_id']);
        
        if(htmlentities($_POST['employee_id']) == 'All Employees'){
            $take_allquery = "select * from time_stamp ORDER BY date DESC";
            $take_all = mysqli_query($connect, $take_allquery);
            $alluser_data = mysqli_fetch_all($take_all, MYSQLI_ASSOC);
        }else{
            $identity = htmlentities($_POST['employee_id']);
            $take_allquery = "select * from time_stamp WHERE emp_id = '$identity' ORDER BY date DESC";
            $take_all = mysqli_query($connect, $take_allquery);
            $alluser_data = mysqli_fetch_all($take_all, MYSQLI_ASSOC);
        }
    } else {
        $take_allquery = "select * from time_stamp ORDER BY date DESC";
        $take_all = mysqli_query($connect, $take_allquery);
        $alluser_data = mysqli_fetch_all($take_all, MYSQLI_ASSOC);
    }
    // $search = $_POST['search'];
// $emp_id = $_POST['employe_id'];
// if(isset($search)){
//  echo "set to $emp_id";
// }
// }





// ALL USERS in USER table --
$take_alluserquery = "SELECT * FROM users EXCEPT SELECT * FROM users WHERE emp_id = 11111";
$take_alluser = mysqli_query($connect, $take_alluserquery);
$alluser_user = mysqli_fetch_all($take_alluser, MYSQLI_ASSOC);
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
    <link rel="stylesheet" href="admin.css">
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
                        <li><a href="admin-settings.php">settings</a></li>
                        <li><a href="logout.php">log out</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>

        <div class="search">
        <form method="POST">
        <select name="employee_id" id="employee_id" >
            <option value="All Employees" selected>All Employees</option>
            <?php foreach($alluser_user as $i => $employee_data): ?>
            <option value="<?php echo $employee_data['emp_id']?>"><?php echo $employee_data['emp_id']?></option>
            <?php endforeach; ?>
            </select>
        <input type="submit" value="search" name="search" class="search-btn"></input>
        <label>Currently Selected: <?php echo htmlentities($_POST['employee_id'] ?? "All Employees");?></label>
            </form>    
        </div>


        <div class="divtable">
            <div class="blocktable">
                <table class="timetable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Employee ID</th>
                            <th>Time In</th>
                            <th>Lunch In</th>
                            <th>Lunch Out</th>
                            <th>Time Out</th>
                            <th>Total Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php foreach($alluser_data as $i  => $user_data): ?>
                            <tr>
                            <td><?php echo $user_data['date']?? "no data found" ?></td>
                            <td><?php echo $user_data['emp_id']?? "no data found" ?></td>
                            <td><?php echo $user_data['time_in']?? "no data found" ?></td>
                            <td><?php echo $user_data['lunch_in']?? "no data found" ?></td>
                            <td><?php echo $user_data['lunch_out']?? "no data found" ?></td>
                            <td><?php echo $user_data['time_out']?? "no data found" ?></td>
                            <td><?php if($user_data['time_in'] !== "" && $user_data['time_out'] !== "")
                            { $time_in = $user_data['time_in'];
                                $time_out = $user_data['time_out'];
                                dateDifference($time_in, $time_out);
                                }?></td>
                            </tr>
                            <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script src="" async defer></script>
</body>

</html>