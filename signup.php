<?php session_start();?><!--NEVER forget this-->
<html> 
    <head>
        <link rel="stylesheet" href="/style.css" type="text/css">
        <link rel="icon" type="image/png" href="logo.png">
        <title>Sign up</title>
    </head>
    <header>
        <h1 class="headertitle"> Community event </h1> <img src='/logo.png' height='95px' id="logo"><br>
        <?php echo isset($_SESSION['id']) ? $_SESSION['fname']." ".$_SESSION['lname'].", ".$_SESSION['age'] : "Not logged in";?>
        <center><?php echo date('h:i A  l F dS Y');?></center>
        <form action='/logoff.php' method='POST'><input value='Log off' type='submit'></form>
    </header> 
    <br>
    <a href='/searchevent.php'> <button> BACK </button> </a>
    
    <?php
    include('database.php');
    echo "<br>";
    $id = intval($_POST['event_id']);    
    $event = requestfromstring("SELECT * FROM event WHERE event_id=".$id)[0];
    echo "<p2> Signing you up for ".$event['event_name']."<br>";
    if(!isset($_POST['dateselected'])) {
    $begindate = DateTime::createFromFormat('Y-m-d', $event['event_date']);
    $d = $event['event_duration'];
    $e = date_interval_create_from_date_string("$d days");
    $enddate = DateTime::createFromFormat('Y-m-d', $event['event_date']);
    $enddate = $enddate->add($e);
    $today = date('Y-m-d');
    $daterange = new DatePeriod(
        new DateTime($begindate->format('Y-m-d')),
        new DateInterval('P1D'),
        new DateTime($enddate->format('Y-m-d'))
    );
        echo "<form action='/signup.php' method='POST' onsubmit=\"return confirm('Sign up for these dates? You won\'t be able to change them')\">";
        echo "<p4>Select the dates you want to sign up for</p4>";
        echo "<input type='number' name='event_id' value='".$id."' style='display:none'>";
        foreach($daterange as $date) {
            if($date->format('Y-m-d') >= $today) {echo "<br><input type='checkbox' name='dateselected[]' value='".$date->format('Y-m-d')."'>".$date->format('l F dS Y')."</input>";}
        }
        echo "<br>
        <input type='submit' value='Sign me up'>
        </form>";
    } 
        else {
        $user_id = $_SESSION['id'];
        foreach($_POST['dateselected'] as $date) {
            requestfromstring("INSERT INTO participated(user_id, event_id, date_of_participation)
            VALUES ($user_id, $id, '".$date."')");
        }
        echo "<p2 id='success'> Signed you up for the dates you selected </p2>";
        echo "<a href='/searchevent.php'> <button> Back to search </button> </a>";
    }

    ?>
    
    <br>
    <footer>
            <a href='about.html' id='about'> About </a>
            <a href='legal.html' id='legal'> Legal </a><br>
    </footer>

</html>