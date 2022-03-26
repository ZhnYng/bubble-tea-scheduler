<?php
session_start();
include "../config/db_connect.php";
$get_date = "SELECT * FROM `" . $_SESSION['username']."`";
$result = mysqli_query($conn, $get_date);
$date = array();
$month = array();
$year = array();
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        array_push($date, $row["Date"]);
        array_push($month, $row["Month"]);
        array_push($year, $row["Year"]);
    }
    $const_initial_date = date_create(strval(end($date)) . "-" . strval(end($month)) . "-" . strval(end($year)));
    $initial_date = date_create(strval(end($date)) . "-" . strval(end($month)) . "-" . strval(end($year)));
    $next_date = date_add($initial_date, date_interval_create_from_date_string('7 days'));
    $next_date = date_format($next_date, 'd-m-Y');

    //Check if next date has passed
    $next_date = new DateTime($next_date);
    $now = new DateTime();
    while($next_date < $now){
        $next_date->add(new DateInterval('P7D'));
    }
}else{
    echo "no results error ";
}

function remove_first_zero($first_zero_num){
    $first_zero_num = (int)$first_zero_num;
    $first_zero_num = (string)$first_zero_num;
    return $first_zero_num;
}

//Get only the date of $next_date
$d_next_date = remove_first_zero($next_date->format('d')); //This gets only the date in from $next_date which contains d-m-Y
$m_next_date = remove_first_zero($next_date->format('m')); //This gets only the month in from $next_date which contains d-m-Y
$Y_next_date = remove_first_zero($next_date->format('Y')); //This gets only the year in from $next_date which contains d-m-Y

//Retrieve the last time the user had bubble tea
$d_initial_date = remove_first_zero($const_initial_date->format('d'));   //Gets the date
$m_initial_date = remove_first_zero($const_initial_date->format('m'));   //Gets the month
$Y_initial_date = remove_first_zero($const_initial_date->format('Y'));   //Gets the year

//Create a session for change date to be able to recognise that user came from home page
$_SESSION["beentohomepage"] = true
?>

<style><?php include 'home.css'; ?></style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <title>Home</title>
</head>
<body>
    <div class="wrapper">
        <div class="left-column">
            <div class="hero-image">
                <img src="../images/PinClipart.com_catering-clip-art_5398038.png" alt="bubble tea"><br>
            </div>
            <div class="nav-bar">
                <a href="../home page/home.php">Home</a>
                <a href="../landing/landing.php">Log out</a>
                <a href="../html_pages/date.html">Change date</a>
            </div>
            <div class="content-box-desktop">
                <h1>Next bubble tea on</h1>
                <h3><?php echo $next_date->format('d-m-Y') ?></h3>
                <br>
                <h3>Previous bubble tea</h3>
                <h5><?php echo $const_initial_date->format('d-m-Y') ?></h5>
            </div>
        </div>
        <div class="content">
            <div class="content-box">
                <h1>Next bubble tea on</h1>
                <h3><?php echo $next_date->format('d-m-Y') ?></h3>
            </div>
            <div class="content-box">
                <h1>Previous bubble tea</h1>
                <h3><?php echo $const_initial_date->format('d-m-Y') ?></h3>
            </div>
            <div class="calendar">
                    <div class="month">
                        <a class="prev-arrow">&#8249</a>
                        <div class="date">
                            <h3></h3>
                        </div>
                        <a class="next-arrow">&#8250</a>
                    </div>
                    <div class="weekdays">
                        <div>Sun</div>
                        <div>Mon</div>
                        <div>Tue</div>
                        <div>Wed</div>
                        <div>Thu</div>
                        <div>Fri</div>
                        <div>Sat</div>
                    </div>
                    <div class="days">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer"></div>
    <script><?php include 'home.js'; ?></script>
</body>
</html>