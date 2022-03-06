<?php
session_start();
if(isset($_POST['submit-create-account'])){
    include '../config/db_connect.php';
    $_SESSION['username'] = $_POST['username'];
    $password = $_POST['confirm-password'];

    //Check that username is unique
    $get_usernames = "SELECT Username FROM accounts";
    $result = mysqli_query($conn, $get_usernames);
    $all_usernames = array();
    while($row = mysqli_fetch_assoc($result)){
        array_push($all_usernames, $row["Username"]);
    }
    if(count(array_keys($all_usernames, $_SESSION['username'])) >= 1){
        include "../signup/signup.html";
        echo "<h3 style='color:red; text-align:center';>" . "Username has been used" . "</h3>";
        return;
    }

    //Create unique table
    $query = "CREATE TABLE `" . $_SESSION['username'] . "`(Date int(11), Month int(11), Year int(11));";
    //Hash password
    $password = password_hash($password, PASSWORD_DEFAULT);
    //insert account info to database
    $query .= "INSERT INTO accounts(Username, Password) VALUES('" . $_SESSION['username'] . "', '$password')";
    if(mysqli_multi_query($conn, $query)){
        include '../html_pages/date.html';
    }else{
        include '../signup/signup.html';
        echo "<h3 style='text-align: center; color: red'>Check the form</h3>";
    }

    //Get account ID
    // $idAndUsername = "SELECT UserID FROM accounts";
    // $result = mysqli_query($conn, $idAndUsername);
    // $all_userID = array();
    // if(mysqli_num_rows($result)>0){
    //     while($row = mysqli_fetch_assoc($result)){
    //         array_push($all_userID, $row["UserID"]);
    //     }
    // }else{
    //     echo "no result";
    // }

}else{
    echo("submit failed");
}
?>