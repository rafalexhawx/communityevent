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
        <title>Rating</title>
    </head>
    <header>
        <h1 class="headertitle"> Community event </h1> <img src='logo.png' height='95px' id="logo"><br>
        <?php echo isset($_SESSION['id']) ? $_SESSION['fname']." ".$_SESSION['lname'].", ".$_SESSION['age'] : "Not logged in";?>
        <center><?php echo date('h:i A  l F dS Y');?></center>
        <form action='logoff.php' method='POST'><input value='Log off' type='submit'></form>
    </header> 
    
    <br>
    <a href='/searchevent.php'> <button> BACK </button> </a>
<?php 
    if (isset($_POST['Submit']))
    {
?>  
        <br>
        <center>

            <form action="add_rating.php" id="add_event_form" method="POST">
                <?php 
                    $user_id = $_SESSION['id'];
                    $event_id = $_POST['event_id'];
                
                    $requeststring = ("SELECT event_name 
                                       FROM event
                                       WHERE event_id = $event_id;");
                    $event_name = requestfromstring($requeststring);

                    echo "<h2>Event selected : ".$event_name[0]['event_name']."</h1>";
                    displayParticipatedDateEvent($user_id, $event_id);
                ?>

                Rating: <input type="number" min="1" max="5" step="1" name="rating" required><br>
                Comment: <br><textarea name='comment' height='50px' ></textarea><br> 

                <input type="hidden" name="event_id" value= <?php echo $event_id; ?>>
                <input value="Submit" name="Submit" type="submit">
            </form>
            <br>
            <form action="add_rating_form.php"  method="POST">
                <input value="Rate another event" name="Submit" type="submit">
            </form>
        </center>
<?php  
    }

    else
    {
        echo "<p>
              <form action='/add_rating_form.php' method='POST'> 
              <input value='Rate another event' type='submit'> 
              </form>
              </p>";
    }
?>
    <footer>
            <a href='about.html' id='about'> About </a>
            <a href='legal.html' id='legal'> Legal </a><br>
    </footer>

</html>