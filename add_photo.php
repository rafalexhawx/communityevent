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
    
    if(isset($_POST['Submit']))
    {


        $user_id = $_SESSION['id'];
        $event_id = $_POST['event_id'];

        $dir = "/var/www/html/Photos/";
        $file = $dir.basename($_FILES["photo"]["name"]);

        if(!file_exists($file) && move_uploaded_file($_FILES["photo"]["tmp_name"], $file)) 
        {
            echo "<p id='success'>Photo upload was a success</p>";
            insertPhoto($user_id, $event_id, basename($_FILES["photo"]["name"]));

            $path = "Photos/".basename($_FILES["photo"]["name"]);
            $image = "<img src='$path' width='50%'>";
?>
            <div class="poster">
            <center><h1>Image uploaded</h1>
            <br>
            <?php echo $image ?>
            </center>
            </div>
<?php
        } 

        else 
        {
            echo "<p id='error'>File already exists on server</p>";
        };
        $event_name = requestfromstring("SELECT event_name FROM event WHERE event_id=$event_id")[0]['event_name'];
    }
?>
    <?php echo "<a href='/showevent.php/?eventname=".$event_name."'>"?> <button> Back to event </button> </a>
    <footer>
        <a href='about.html' id='about'> About </a>
        <a href='legal.html' id='legal'> Legal </a><br>
    </footer>

</html>






        