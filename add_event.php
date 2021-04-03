<?php session_start();?>
<html> 
    <head>
        <link rel="stylesheet" href="style.css" type="text/css">
        <link rel="icon" type="image/png" href="logo.png">
        <title><?php echo $_POST['eventname']?></title>
    </head>
    <header>
        <h1 class="headertitle"> Community event </h1> <img src='logo.png' height='95px' id="logo"><br>
        <?php echo isset($_SESSION['id']) ? $_SESSION['fname']." ".$_SESSION['lname'].", ".$_SESSION['age'] : "Not logged in";?>
        <center><?php echo date('h:i A  l F dS Y');?></center>
        <form action='logoff.php' method='POST'><input value='Log off' type='submit'></form>
    </header> 
<?php
include('database.php');
$description = $_POST['description'];
$eventplace = $_POST['eventplace'];
$eventname = $_POST['eventname'];
$begins = $_POST['begins'];
$ends = $_POST['ends'];
$minage = $_POST['minage'];
$dir = "/var/www/html/Photos/";
$file = $dir.basename($_FILES["cover"]["name"]);
if(!file_exists($file) && move_uploaded_file($_FILES["cover"]["tmp_name"], $file)) {
    echo "<p id='success'>Photo upload was a success</p>";
} else {
    echo "<p id='error'>File already exists on server</p>";
};
$path = "Photos/".basename($_FILES["cover"]["name"]);
$image = "<img src='$path' width='50%'>";
$begindate = DateTime::createFromFormat("Y-m-d", $begins);
$enddate = DateTime::createFromFormat("Y-m-d", $ends);
$duration = $begindate->diff($enddate);
$eventduration = $duration->days + 1;
$categories = $_POST['categories'];
?>
<div class="poster">
<center><h1><?php echo $eventname?></h1>
<br>
<?php echo $image ?>


<h2><?php 
echo $eventduration == 1 ? "Only on {$begindate->format('l F dS Y')}" : "From {$begindate->format('l F dS Y')} to {$enddate->format('l F dS Y')}";
echo "<br>At $eventplace";?></h2>

<p2> <?php echo $description?></p2><br>

<p3><?php echo $minage == 0 ? "Event for everyone" : "Event only for those above the age of $minage"?></p3></center>
</div>
<?php $host = $_SESSION['id'];?>
<?php $event_id = insertEvent($eventname, $eventplace, $begindate->format('Y-m-d'), $eventduration, $minage, basename($_FILES["cover"]["name"]), $description, $host);
insertCategories($event_id, $categories);?>
<a href='searchevent.php'> <button> Back to search page </button> </a>
    <br>
    <footer>
            <a href='about.html' id='about'> About </a>
            <a href='legal.html' id='legal'> Legal </a><br>
    </footer>

</html>






        