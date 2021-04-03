<?php session_start();
include("database.php");?><!--NEVER forget this-->
<html> 
    <head>
        <link rel="stylesheet" href="/style.css" type="text/css">
        <link rel="icon" type="image/png" href="/logo.png">
        <title>Our suggestions for <?php echo $_SESSION['fname']." ".$_SESSION['lname']?></title>
    </head>
    <header>
        <h1 class="headertitle"> Community event </h1> <img src='logo.png' height='95px' id="logo"><br>
        <?php echo isset($_SESSION['id']) ? $_SESSION['fname']." ".$_SESSION['lname'].", ".$_SESSION['age'] : "Not logged in";?>
        <center><?php echo date('h:i A  l F dS Y');?></center>
        <form action='/logoff.php' method='POST'><input value='Log off' type='submit'></form>
    </header> 
    <a href='/searchevent.php'> <button> BACK </button> </a>
    <br>
    <h2> Here are some suggested events based on the ones you already signed up to </h2>
    <?php
    $requeststring = "SELECT DISTINCT event.event_id FROM event, category,
    --GET categories user signed up to
    (SELECT DISTINCT category_id AS cat_id FROM category
    NATURAL JOIN participated --Links event and user
    NATURAL JOIN users --Links user and participation
    NATURAL JOIN isofcategory --Links event and category
    WHERE user_email = '{$_SESSION['email']}') AS favcategories,
    --GET events user didn't sign up to that aren't done yet
    --or still haven't happened
    (SELECT event_id AS event_id FROM event
    WHERE event_id NOT IN (
    SELECT DISTINCT event_id FROM event
    NATURAL JOIN participated
    NATURAL JOIN users
    WHERE user_email = '{$_SESSION['email']}')
    AND event_date + event_duration -1 > CURRENT_DATE) AS notparticipating
    --GET events and their categories
    WHERE category.category_id = favcategories.cat_id
    AND event.event_id = notparticipating.event_id
    AND event.event_min_age <= ".$_SESSION['age'];
    $suggested = requestfromstring($requeststring);
    ?>
    <div class='results'>
        <?php foreach($suggested as $event) {
            $e = requestfromstring("SELECT * FROM event WHERE event_id = {$event['event_id']}")[0];
            displayEventsearch($e);
        }
        ?>
    </div>
    <br>
    <footer>
            <a href='/about.html' id='about'> About </a>
            <a href='/legal.html' id='legal'> Legal </a><br>
    </footer>

</html>

    

