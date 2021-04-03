<?php session_start();
include('database.php');
if($_SESSION['email'] != "admin@communityevent.tech") {
    header('location: /index.php');
}?><!--NEVER forget this-->
<html> 
    <head>
        <link rel="stylesheet" href="style.css" type="text/css">
        <link rel="icon" type="image/png" href="logo.png">
        <title>Admin page</title>
    </head>
    <header>
        <h1 class="headertitle"> Community event </h1> <img src='logo.png' height='95px' id="logo"><br>
        <?php echo isset($_SESSION['id']) ? $_SESSION['fname']." ".$_SESSION['lname'].", ".$_SESSION['age'] : "Not logged in";?>
        <center><?php echo date('h:i A  l F dS Y');?></center>
        <form action='http://communityevent.tech/logoff.php' method='POST'><input value='Log off' type='submit'></form>
    </header> 
    <a href='/admin.php'> <button> Back to admin page </button> </a>
    <br>

<?php
    if (isset($_POST['Submit']))
    {
        $parent_id  = $_POST['parent_id'];
        $child_id   = $_POST['child_id'];

        $parent = requestfromstring("SELECT * FROM users WHERE user_id = $parent_id;");
        $child  = requestfromstring("SELECT * FROM users WHERE user_id = $child_id;");
        
        $parent_bday    = $parent[0]['user_bday']; 
        $child_bday     = $child[0]['user_bday'];

        $diff_date = abs(strtotime($parent_bday) - strtotime($child_bday)) / (365*60*60*24);

        // Si la différence d'âge est trop faible, on interdit le lien entre les 2 personnes (ça serait étrange d'avoir un enfant à 14 ans tout de même)
        if ($diff_date < 14) 
        {
            echo "Looks like these persons are only ".intval($diff_date)." years apart... isn't that strange for them to be parent and children ?<br>\n";
        }

        else if ($parent_bday > $child_bday)
        {
            echo "The parent is younger than his child... You probably messed up the order<br>\n";
        }


        else
        {
            $request = requestfromstring("INSERT INTO isparentof VALUES ($parent_id, $child_id);");
            echo $parent[0]['user_fname']." ".$parent[0]['user_lname']." is now a parent of ".$child[0]['user_fname']." ".$child[0]['user_lname']."<br>\n";
        }


    }
?>




    <footer>
            <a href='about.html' id='about'> About </a>
            <a href='legal.html' id='legal'> Legal </a><br>
    </footer>

</html>