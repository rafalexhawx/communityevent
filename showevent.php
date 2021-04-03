<?php session_start();?><!--NEVER forget this-->
<html> 
    <head>
        <link rel="stylesheet" href="/style.css" type="text/css">
        <link rel="icon" type="image/png" href="logo.png">
    </head>
    <header>
        <h1 class="headertitle"> Community event </h1> <img src='/logo.png' height='95px' id="logo"><br>
        <?php echo isset($_SESSION['id']) ? $_SESSION['fname']." ".$_SESSION['lname'].", ".$_SESSION['age'] : "Not logged in";?>
        <center><?php echo date('h:i A  l F dS Y');?></center>
        <form action='/logoff.php' method='POST'><input value='Log off' type='submit'></form>
    </header> 
    <br>
    <a href='/searchevent.php'> <button> BACK </button> </a>
    <br>
    <?php
include('database.php');
$user_id = $_SESSION['id'];
$name = $_GET['eventname'];
$event = requestfromstring("SELECT * FROM event WHERE event_name='$name'");

displayEvent($event[0]);
?>
<title> <?php echo $event[0]['event_name'];?> </title>

<?php
$id = $event[0]['event_id'];
$ratings = requestfromstring("SELECT * FROM rated WHERE event_id = $id");
?>

<p2> Got more photos of this event? Add them here (png or jpg): </p2><form action="/add_photo.php" method="POST" enctype="multipart/form-data"><input type="file" name="photo" accept="image/png, image/jpeg, image/jpg"><input type="hidden" name="event_id" value= <?php echo $id; ?>><input value="Upload" name="Submit" type="submit"></form>

<?php


CanYouRate_Event($user_id, $id);

if(count($ratings) == 0) { //No ratings found
    echo "<p id='error'> No ratings found</p>";
} else {
    displaysRating($id);
}


?>
    <?php
    $event = $event[0];
    $r = "SELECT * FROM participated WHERE user_id=".$_SESSION['id']." AND event_id=".$id;
    $participations = requestfromstring($r);
    $begindate = DateTime::createFromFormat('Y-m-d', $event['event_date']);
    $d = $event['event_duration'];
    $e = date_interval_create_from_date_string("$d days");
    $enddate = DateTime::createFromFormat('Y-m-d', $event['event_date']);
    $enddate = $enddate->add($e);
    $today = date('Y-m-d');
    $participants = requestfromstring("SELECT event_id, COUNT(DISTINCT user_id) FROM participated
    GROUP BY event_id
    HAVING event_id=".$id)[0];
    $c = isset($participants) ? $participants['count'] : 0;
    if(!count($participations) && $today < $enddate->format('Y-m-d')) {
        echo "<p2 id='success'> $c participating so far, go join them </p2>";
        echo "<form action='/signup.php' method='POST'> <input type='number' name='event_id' value='".$id."' style='display:none'> <input value='Sign up' type='submit'> </form>";
    } else {
        echo "<p2 id='error'> Can't sign up </p2>";
        echo "<p2> $c Participants </p2>";
    }
    ?>
    <br>
    <footer>
            <a href='/about.html' id='about'> About </a>
            <a href='/legal.html' id='legal'> Legal </a><br>
    </footer>

</html>

    

