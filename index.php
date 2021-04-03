<?php session_start();
include('database.php');?><!--NEVER forget this-->
<html> 
    <head>
        <link rel="stylesheet" href="style.css" type="text/css">
        <link rel="icon" type="image/png" href="logo.png">
        <title>Community event</title>
    </head>
    <header>
        <h1 class="headertitle"> Community event </h1> <img src='logo.png' height='95px' id="logo"><br>
        <?php echo isset($_SESSION['id']) ? $_SESSION['fname']." ".$_SESSION['lname'].", ".$_SESSION['age']."<form action='logoff.php' method='POST'><input value='Log off' type='submit'></form>" : "Not logged in";?>
        <center><?php echo date('h:i A  l F dS Y');?></center>
        
    </header> 
    <?php 
    if(isset($_SESSION['id'])) {
        header("location: searchevent.php");
    }
    ?>
    <br>
    <center><h2> A convenient tool to manage small scale local events </h2></center><br>
    <div class='devs'>
    <div class='index'>
    <center><a href='new_user.php'> <img src='stockevent.jpg'> <br><p2> Create account </p2> </a></center></div>
    <center><div class='index'> <a href='login.php'> <img src='stockevent2.jpg'> <br><p2> Login </p2> </a> </center></div>
    </div>
    <?php $c = requestfromstring("SELECT event_id, COUNT(DISTINCT user_id) FROM participated
    GROUP BY event_id
    ORDER BY count DESC
    LIMIT 1")[0]['count'];
    ?>
    <center> <h3> Our most popular event as of today with <?php echo $c?> participants</h3>
    <div class='devs'>
    <?php
    //Most popular event
    $requeststring = "SELECT event_id, COUNT(DISTINCT user_id) FROM participated
    GROUP BY event_id
    ORDER BY count DESC
    LIMIT 1";
    $mostpopular = requestfromstring($requeststring)[0][0];
    $event = requestfromstring("SELECT * FROM event WHERE event_id = $mostpopular")[0];
    displayEvent($event);
    ?>
    </div>
    </center>
    <?php
    $r = requestfromstring("SELECT event.event_id, event_name, event_place, event_date, event_duration, event_min_age, event_description, AVG(rating) AS rating FROM event, rated
    WHERE event.event_id = rated.event_id
    GROUP BY event.event_name, event.event_id, event_place, event_date, event_duration, event_min_age, event_description
    ORDER BY rating DESC")[0];
    ?>
    <center> <h3> Our best rated event as of today with a rating of <?php echo round($r['rating'], 2)?>/5</h3>
    <div class='devs'>
    <?php
    displayEvent($r);
    ?>
    </div>
    </center>
    <br>
    

    <footer>
            <a href='about.html' id='about'> About </a>
            <a href='legal.html' id='legal'> Legal </a><br>
    </footer>

</html>

    

