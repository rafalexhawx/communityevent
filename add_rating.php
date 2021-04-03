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
    if (isset($_POST['Submit']))
    {
        $user_id = $_SESSION['id'];
        $event_id = $_POST['event_id'];
        $date_of_rating = $_POST['date_of_rating'];
        $comment = $_POST['comment'];
        $rating = $_POST['rating'];


        $requeststring = "INSERT INTO rated (user_id, event_id, date_of_rating, comment_text, rating)
                          VALUES ($user_id, $event_id, '$date_of_rating', '$comment', $rating);";

        $request = requestfromstring($requeststring);

        echo "Rating accepted<br>\n";
    }
    echo "<p>
          <a href='/add_rating_form.php'> Rate another event </a>
          </p>";
          $event_name = requestfromstring("SELECT event_name FROM event WHERE event_id=$event_id")[0]['event_name'];
    ?>
        <?php echo "<a href='/showevent.php/?eventname=".$event_name."'>"?> <button> Back to event </button> </a>
        
    <footer>
        <a href='about.html' id='about'> About </a>
        <a href='legal.html' id='legal'> Legal </a><br>
    </footer>

</html>






        