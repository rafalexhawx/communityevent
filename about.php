<?php session_start();
include("database.php");?><!--NEVER forget this-->
<html> 
    <head>
        <link rel="stylesheet" href="/style.css" type="text/css">
        <link rel="icon" type="image/png" href="logo.png">
        <title>About</title>
    </head>
    <header>
        <h1 class="headertitle"> Community event </h1> <img src='logo.png' height='95px' id="logo"><br>
        <?php echo isset($_SESSION['id']) ? $_SESSION['fname']." ".$_SESSION['lname'].", ".$_SESSION['age'] : "Not logged in";?>
        <center><?php echo date('h:i A  l F dS Y');?></center>
        <?php if(isset($_SESSION['email'])) {echo "<form action='http://communityevent.tech/logoff.php' method='POST'><input value='Log off' type='submit'></form>";}?>
    </header> 
    <br>
    <div class='devs'>
    <h1> The developers </h1><br>
    <div class='developper'>
        <h2> Alex ROBIC </h2>
        <p> Alex is a young student in computer science and mathematics with international ambitions and tons of project ideas in mind. A regular of MUN conferences, Alex sees his future in DC. 
            At only 19 years old, this programmer is also an aspiring novelist with a story close to those of Tom Clancy and Asimov. <br>
            Alex's main contributions to this project were:
            <ul>
                <li>Adding users</li>
                <li>Adding events</li>
                <li>Login mechanics</li>
                <li>Admin page</li>
                <li>Page template</li>
                <li>Legal / About pages</li>
                <li>Search page / event display</li>
                <li>Event suggestions</li>
                <li>Various other debugging and integration tasks</li>
            </ul>
    </div>
    <div class='developper' style='background-color:lightblue'>
        <h2>Johnson VILAYVANH</h2>
        <p> Johnson is also a young student in computer science and mathematics, with internal ambitions... not that much, not yet at least.<br>
            Holder of a degree in economics at Pantheon-Sorbonne University, at 23 years old, he's still wondering where he's heading towards in the next years...<br>
            Johnson's main contributions to this project were:
            <ul>
                <li>Adding categories</li>
                <li>Adding photos</li>
                <li>Adding ratings</li>
                <li>Parental links</li>
                <li>Various other debugging tasks</li>
                <br><br><br><br>
            </ul>
    </div>
    </div>
    <p2> For the full report of the project, click <a href='/Rapport rendu final BDD (ROBIC, VILAYVANH).pdf' download> here </a> </p2><br>
    <?php
    $users = count(requestfromstring("SELECT * FROM users"));
    $events = count(requestfromstring("SELECT * FROM event"));
    $ratings = count(requestfromstring("SELECT * FROM rated"));
    echo "Right now, there are $users users signed up on the website, 
    $events events registered and in total $ratings ratings were written";
    ?>
    <br>
    <a href='/index.php'> Back to home page </a>
    <footer>
            <a href='about.html' id='about'> About </a>
            <a href='legal.html' id='legal'> Legal </a><br>
    </footer>

</html>

    

