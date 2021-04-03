<?php
include('database.php');
session_start();
$user = $_POST["user"];
$pass = $_POST["pass"];
$correct = requestfromstring("SELECT * FROM users
WHERE user_email = '$user' AND md5('$pass') = user_password")[0];

if(!isset($correct)) {
    echo "Incorrect password";
    header('location: login.php');
} else {
$id = $correct['user_id'];
$_SESSION['id'] = $id;
$_SESSION['fname'] = $correct['user_fname'];
$_SESSION['lname'] = $correct['user_lname'];
$_SESSION['email'] = $correct['user_email'];
$bdayObj = DateTime::createFromFormat('Y-m-d', $correct['user_bday']);
$today = new DateTime;
$age = $today->diff($bdayObj)->y;
$_SESSION['age'] = $age;
header('location: /searchevent.php');
exit();
}
?>