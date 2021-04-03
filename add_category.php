<?php session_start();
include('database.php');?>
<html> 
    <head>
        <link rel="stylesheet" href="style.css" type="text/css">
        <link rel="icon" type="image/png" href="logo.png">
        <title>Category Added</title>
    </head>
    <header>
        <h1 class="headertitle"> Community event </h1> <img src='logo.png' height='95px' id="logo"><br>
        <?php echo isset($_SESSION['id']) ? $_SESSION['fname']." ".$_SESSION['lname'].", ".$_SESSION['age'] : "Not logged in";?>
        <center><?php echo date('h:i A  l F dS Y');?></center>
        <form action='logoff.php' method='POST'><input value='Log off' type='submit'></form>
    </header> 
<?php 
    /*
    if (isset($_POST['SubmitExistingCategory']))
    {
        $eventID = $_POST['event_id'];
        $categoryID = $_POST['category_id'];
        $lib_newcategory = 'None';

        insertCategory($eventID, $categoryID);
    }

    else if (isset($_POST['SubmitNewCategory']))
    {
        $eventID = $_POST['event_id'];
        $categoryID = 'None';
        $lib_newcategory = $_POST['category_name'];

        insertCategory($eventID, $categoryID, $lib_newcategory);
    }
    */
requestfromstring("INSERT INTO category(category_name) VALUES ('{$_POST['category_name']}')");
header("location: /add_event_form.php");
?>


    <footer>
        <a href='about.html' id='about'> About </a>
        <a href='legal.html' id='legal'> Legal </a><br>
    </footer>

</html>






        