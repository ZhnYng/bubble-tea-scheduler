<?php
session_start();
if(isset($_POST['submit-login'])){
    include '../config/db_connect.php';
    $_SESSION['username'] = $_POST['username'];
    $password = $_POST['password'];
    $get_usernames = "SELECT * FROM accounts";
    $result = mysqli_query($conn, $get_usernames);
    $all_usernames = array();
    $all_passwords = array();
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
            array_push($all_usernames, $row["Username"]);
            array_push($all_passwords, $row["Password"]);
        }
    }else{
        echo "no results";
    }
    $userID = array_search($_SESSION['username'], $all_usernames);
    if(password_verify($password, $all_passwords[$userID])){
        header("Location: http://bubble-tea-scheduler.rf.gd/home%20page/home.php");
        exit;
    }else{
        include "../login/login.html";
        echo "<h3 style='color:red; text-align:center';>" . "Username or Password is wrong" . "</h3>";
    }
}
mysqli_close($conn);
?>