<?php session_start();
include("database.php");?><!--NEVER forget this-->
<html> 
    <head>
        <link rel="stylesheet" href="style.css" type="text/css">
        <link rel="icon" type="image/png" href="logo.png">
        <title>Legal</title>
    </head>
    <header>
        <h1 class="headertitle"> Community event </h1> <img src='logo.png' height='95px' id="logo"><br>
        <?php echo isset($_SESSION['id']) ? $_SESSION['fname']." ".$_SESSION['lname'].", ".$_SESSION['age'] : "Not logged in";?>
        <center><?php echo date('h:i A  l F dS Y');?></center>
        <?php if(isset($_SESSION['email'])) {echo "<form action='http://communityevent.tech/logoff.php' method='POST'><input value='Log off' type='submit'></form>";}?>
    </header> 
    <br>
    Community event is an open source software. It can be freely updated/modified/downloaded and used for commercial purposes.
    <br>
    <a href='/downloadce.php' target="_blank"> <button> Download CommunityEvent </button> </a> <br>
    <a href='/index.php'> Back to home page </a>
    <footer>
            <a href='about.html' id='about'> About </a>
            <a href='legal.html' id='legal'> Legal </a><br>
    </footer>

</html>

    

