<?php session_start();?> <!--Never forget this-->
<html> 
    <head>
        <link rel="stylesheet" href="style.css" type="text/css">
        <link rel="icon" type="image/png" href="logo.png">
        <title>Add Category</title>
    </head>
    <header>
        <h1 class="headertitle"> Community event </h1> <img src='logo.png' height='95px' id="logo"><br>
        <?php echo isset($_SESSION['id']) ? $_SESSION['fname']." ".$_SESSION['lname'].", ".$_SESSION['age'] : "Not logged in";?>
        <center><?php echo date('h:i A  l F dS Y');?></center>
        <form action='logoff.php' method='POST'><input value='Log off' type='submit'></form>
    </header> 
    
    <br>

    <a href='/add_event_form.php'> <button> BACK </button> </a>
    <center>

        <!--------------- New Category --------------->
        <form action="add_category.php" id="add_event_form" method="POST">
            <div class='formtitle'>Add a new Category</div><br>
            New Category   <input type="text" name="category_name" size="30" maxlength="50"required><br>


            <input value="Submit" name="SubmitNewCategory" type="submit">
        </form>
    </center>
    <br>

    <footer>
            <a href='about.html' id='about'> About </a>
            <a href='legal.html' id='legal'> Legal </a><br>
    </footer>

</html>