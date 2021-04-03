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
        <title>Add event</title>
    </head>
    <header>
        <h1 class="headertitle"> Community event </h1> <img src='logo.png' height='95px' id="logo"><br>
        <?php echo isset($_SESSION['id']) ? $_SESSION['fname']." ".$_SESSION['lname'].", ".$_SESSION['age'] : "Not logged in";?>
        <center><?php echo date('h:i A  l F dS Y');?></center>
        <form action='logoff.php' method='POST'><input value='Log off' type='submit'></form>
        
    </header> 
    <br>
    <a href='/searchevent.php'> <button> BACK </button> </a>
        <form action="add_event.php" id="add_event_form" method="POST" enctype="multipart/form-data">
            <div class='formtitle'>Add event</div>
            <fieldset>
            <legend>Event information</legend>
            <br>
            <label for="event">Event</label> <input type="text" name="eventname"  size="30" placeholder = "Ex: Soccer games" id="event" required><br><br>
            <label for="place">Place</label> <input type="text" name="eventplace" size="30" placeholder = "Ex: In my garden" id="place" required><br><br>
            <label for="begins">Begins</label> <input type="date" name="begins" id="begins"required><br><br>
            <label for="ends">Ends</label> <input type="date" name="ends" id="ends" required><br><br>
            <label for="age">Age limit</label> <input type="number" min="0" max="100" step="1" name="minage" value="0" id="age"><br><br>
            <label for="photo">Cover photo (.pnj .jpg)</label> <input type="file" name="cover" accept="image/png, image/jpeg, image/jpg" id="photo" ><br><br>
            <label for="description">Description</label><br><textarea name='description' placeholder = "Ex: Games start at 10 a.m., and we won't stop until we are tired !" id="description"></textarea><br><br> 
            </fieldset>

            <fieldset>
            <legend>Categories</legend>
            <table>
            <?php
                $cat = requestfromstring("SELECT * FROM category");
                foreach($cat as $c) {
                    echo "<tr><td><input value='".$c['category_id']."' type='checkbox' name='categories[]'>";
                    echo $c['category_name']."</input></td></tr>";
                }
            ?>
            </table>
            Can't find your category? Try adding it <a href='/add_category_form.php'> here </a>
            </fieldset>
            <center><input value="Submit" type="submit"></center>
        </form>
        
        <br>
    <footer>
            <a href='about.html' id='about'> About </a>
            <a href='legal.html' id='legal'> Legal </a><br>
    </footer>

</html>