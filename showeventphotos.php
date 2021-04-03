<?php session_start();
include('database.php');
if(!isset($_SESSION['id'])) {
    header("location: login.php");
}
?><!--NEVER forget this-->
<html> 
    <head>
        <link rel="stylesheet" href="style.css" type="text/css">
        <link rel="icon" type="image/png" href="logo.png">
        <title>Rating Added</title>
    </head>
    <header>
        <h1 class="headertitle"> Community event </h1> <img src='logo.png' height='95px' id="logo"><br>
        <?php echo isset($_SESSION['id']) ? $_SESSION['fname']." ".$_SESSION['lname'].", ".$_SESSION['age'] : "Not logged in";?>
        <center><?php echo date('h:i A  l F dS Y');?></center>
        <form action='logoff.php' method='POST'><input value='Log off' type='submit'></form>
    </header> 

<?php
    $event_id = $_POST['event_id'];

    $requeststring = "SELECT event_name
                      FROM event
                      WHERE event_id = $event_id;";
    $request = requestfromstring($requeststring);

    $event_name = $request[0]['event_name'];

    $requeststring = "SELECT photo_file
                      FROM coverphoto
                      NATURAL JOIN photo
                      WHERE event_id = $event_id;";
    $request = requestfromstring($requeststring);

    $cover_photo = $request[0]['photo_file'];


    $requeststring = "SELECT user_fname, 
                             user_lname, 
                             photo_file 
                      FROM isphotoof 
                      NATURAL JOIN postedby 
                      NATURAL JOIN photo 
                      NATURAL JOIN users 
                      WHERE event_id = $event_id;";

    $request = requestfromstring($requeststring);

    $event_photos = $request;

    echo "<center>";
    echo "<div class='poster'>";
    echo "<h1>".$event_name."</h1>";
    echo "<p><img src='Photos/".$cover_photo."' alt='Photos'/></p></div>";

    foreach ($event_photos AS $photo)
    {
        echo "<p><img src='Photos/".$photo['photo_file']."' alt='Photos'/><br>";
        echo "Posted by ".$photo['user_fname']." ".$photo['user_lname']."</p>";
    }

    echo "</center>";
?>
    <footer>
        <a href='about.html' id='about'> About </a>
        <a href='legal.html' id='legal'> Legal </a><br>
    </footer>

</html>






        