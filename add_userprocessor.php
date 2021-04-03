<?php session_start();?>
<?php
include("database.php");
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$bday = $_POST['bday'];
?>

<html>  
    <head>
        <link rel="stylesheet" href="style.css" type="text/css">
        <title>Template</title>
        <link rel="icon" type="image/png" href="logo.png">
    </head>
    <header>
        <h1 class="headertitle"> Community event </h1> <img src='logo.png' height='95px' id="logo"><br>
        <?php echo isset($_SESSION['id']) ? $_SESSION['fname']." ".$_SESSION['lname'].", ".$_SESSION['age'] : "Not logged in";?>
        <center><?php echo date('h:i A  l F dS Y');?></center>
        <form action='logoff.php' method='POST'><input value='Log off' type='submit'></form>
    </header> 
    <?php 
    echo "$fname $lname born on ";
    $bdayObj = DateTime::createFromFormat('Y-m-d', $bday);
    echo $bdayObj->format('l F dS Y');
    echo " and email: $email <br>";
    echo "Registering you now<br>";
    $exists = requestfromstring("SELECT user_email FROM users WHERE user_email='$email'");
    if(count($exists[0] > 0) && isset($exists[0])) {
        echo "<p id='error'> Email already in use, please use another one </p>";
        echo "<a href='new_user.php'> <button> Click here to go back </button> </a>";
    } else {
        requestfromstring("INSERT INTO users(user_fname, user_lname, user_email, user_password, user_bday) VALUES
    ('$fname', '$lname', '$email', md5('$pass'), '$bday')");
    echo "<p id='success'>All ok until here</p><br>";
    echo "<a href='login.php'> <button> To the login page </button> </a>";
    }
    
    ?>
  


    <footer>
            <a href='about.html' id='about'> About </a>
            <a href='legal.html' id='legal'> Legal </a><br>
    </footer>

</html>