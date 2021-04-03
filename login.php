<?php
if(session_id() == '' || !isset($_SESSION)) {
    session_start();
}

?>

<html>  
    <head>
        <link rel="stylesheet" href="style.css" type="text/css">
        <title>Login page</title>
        <link rel="icon" type="image/png" href="logo.png">
    </head>
    <header>
        <h1 class="headertitle"> Community event </h1> <img src='logo.png' height='95px' id="logo"><br>
        <?php echo isset($_SESSION['id']) ? $_SESSION['fname']." ".$_SESSION['lname'].", ".$_SESSION['age'] : "Not logged in";?>
        <center><?php echo date('h:i A  l F dS Y');?></center>
    </header> 
    <br>
    <form action="loginprocessor.php" id="loginform" class="userinputform" method="POST">
        Email: <input type="email" name="user" width="100%"><br>
        Password: <input type="password" name="pass" width="100%"><br>
        <input type="submit" value="Log in">
    </form>
    


    <footer>
            <a href='about.html' id='about'> About </a>
            <a href='legal.html' id='legal'> Legal </a><br>
    </footer>

</html>




