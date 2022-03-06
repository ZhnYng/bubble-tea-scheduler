<?php
session_start();
if(isset($_POST['submit-bubble-tea'])){
    include '../config/db_connect.php';
    $date = $_POST['date'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    // $query = "INSERT INTO recentBubbleTea(Date, Month, Year) VALUES('$date', '$month', '$year')";
    $query = "INSERT INTO `" . $_SESSION['username'] . "`(Date, Month, Year) VALUES('$date', '$month', '$year')";
    
    if($_SESSION["beentohomepage"]){
        if(mysqli_query($conn, $query)){
            include '../home page/home.php';
        }else{
            echo "Try again";
        }
    }else{
        if(mysqli_query($conn, $query)){
            include '../html_pages/form_submitted.html';
        }
        else{
            include '../html_pages/date.html';
            echo("<h3 style='color:red; text-align:center';>" . "Try again" . "</h3>");
        }
    }
}else{
    echo("submit failed");
}
?>