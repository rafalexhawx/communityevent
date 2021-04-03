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
    <center>

        <form action="add_photo.php" id="add_event_form" method="POST" enctype="multipart/form-data">
<?php 
            displayListTable('event_id', 'event_name', 'event', 'Event');
?>  
            Cover photo: (.png .jpg) <input type="file" value = "Test" name="photo" accept="image/png, image/jpeg, image/jpg"><br>
            <input value="Submit" name="Submit" type="submit">
        </form>
    </center>
    <br>

    <footer>
            <a href='about.html' id='about'> About </a>
            <a href='legal.html' id='legal'> Legal </a><br>
    </footer>

</html>