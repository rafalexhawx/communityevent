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
    <a href='/searchevent.php'> <button> Back to main page </button> </a>
    <br>

    <div class='adminpage'>
    <h3> Add parental links </h3>
    <table>
    <?php
    $users = requestfromstring("SELECT * FROM users");
    $today = date('Y-m-d');

?> 
    <form action="/add_parental_links.php" id="add_event_form" method="POST" enctype="multipart/form-data">
        Parent <select name="parent_id">
<?php 
        foreach ($users as $parent) 
        {

            $age = (strtotime($today) - strtotime($parent['user_bday'])) / (365*60*60*24);
?>  
            <option value = "<?php echo $parent['user_id'] ?>" > <?php echo $parent['user_fname']." ".$parent['user_lname']." (".intval($age)." years old)"; ?> </option>
<?php
        };
?>   
        </select><br>

        Child <select name="child_id">
<?php 
        foreach ($users as $child) 
        {
            $age = (strtotime($today) - strtotime($child['user_bday'])) / (365*60*60*24);
?>          
            <option value = "<?php echo $child['user_id'] ?>" > <?php echo $child['user_fname']." ".$child['user_lname']." (".intval($age)." years old)"; ?> </option>
<?php
        };
?>
            </select><br>
            <input value="Submit" name="Submit" type="submit">
        </form>
    </table>
    </div>


    <div class='adminpage'>
    <h3> Delete a parental link </h3>
    <table>
    <?php
    $parental_link = requestfromstring("SELECT parent_id,
                                               u1.user_fname AS parent_fname,
                                               u1.user_lname AS parent_lname,
                                               u1.user_bday  AS parent_bday,
                                               child_id,
                                               u2.user_fname AS child_fname,
                                               u2.user_lname AS child_lname,
                                               u2.user_bday  AS child_bday
                                        FROM isparentof,
                                             users u1,
                                             users u2
                                        WHERE u1.user_id = parent_id
                                        AND u2.user_id = child_id;");

        echo "<thead><tr><th>Parent</th><th>Child</th><th></th></tr></thead>";
        echo "<tbody>";
    foreach($parental_link as $parental) {
        echo "<tr>";
        echo "<td>".$parental['parent_fname']." ".$parental['parent_lname']."</td>";
        echo "<td>".$parental['child_fname']." ".$parental['child_lname']."</td>";
        echo "<td><a href='/deleteparentallink.php/?parent_id=".$parental['parent_id']."&child_id=".$parental['child_id']."'> <button> DELETE </button> </a></td></tr>";
    }                                              
        echo "</tbody>";
    ?>
    </table>
    </div>



    <div class='adminpage'>
    <h3> Delete a whole event </h3>
    <table>
    <?php
    $events = requestfromstring("SELECT * FROM event");
    foreach($events as $event) {
        echo "<tr><td>";
        echo $event['event_name']." at ".$event['event_place']."</td><td>";
        echo "<a href='/deleteevent.php/?event_id=".$event['event_id']."'> <button> DELETE </button> </a></td></tr>";
    }
    ?>
    </table>
    </div>


    <div class='adminpage'>
    <h3> Delete a category </h3>
    <table>
    <?php
    $categories = requestfromstring("SELECT * FROM category");
    foreach($categories as $cat) {
        echo "<tr><td>";
        echo $cat['category_name']."</td><td>";
        echo "<a href='/deletecategory.php/?cat_id=".$cat['category_id']."'> <button> DELETE </button> </a></td></tr>";
    }
    ?>
    </table>
    </div>


    <div class='adminpage'>
    <h3> Delete a user </h3>
    <table>
    <?php
    foreach($users as $u) {
        if($u['user_email'] != "admin@communityevent.tech") {
        echo "<tr><td>";
        echo $u['user_fname']." ".$u['user_lname']."</td><td>";
        echo "<a href='/deleteuser.php/?user_id=".$u['user_id']."'> <button> DELETE </button> </a></td></tr>";
    }
    }
    ?>
    </table>
    </div>

    <div class='adminpage'>
    <h3> Delete a rating </h3>
    <table>
    <?php
    $rating = requestfromstring("SELECT eventrating_id,
    									event_name, 
    								    user_fname, 
    								    user_lname, 
    								    date_of_rating, 
    								    comment_text, 
    								    rating 
							  	FROM rated 
							  	NATURAL JOIN event 
							  	NATURAL JOIN users
							  	ORDER BY event_name;");

    foreach($rating as $r) 
    {
        echo "<tr><td><b>";
        echo $r['event_name']." by ".$r['user_fname']." ".$r['user_lname']." on ".$r['date_of_rating']." (".$r['rating']."/5)</b><br>\n";
        echo $r['comment_text']."</td><td>";
        echo "<a href='/deleterating.php/?eventrating_id=".$r['eventrating_id']."'> <button> DELETE </button> </a></td></tr>";
    }
    
    ?>
    </table>
    </div>

    <br>
    <div class='adminpage'>
    <h3> Delete a photo </h3>
    <table>
    <?php
    $photos = requestfromstring("SELECT DISTINCT * FROM photo");
    foreach($photos as $p) {
        echo "<tr><td>";
        echo "<img height='25%' src='/Photos/".$p['photo_file']."'></td>";
        echo "<td> <a href='/deletephoto.php/?photo_id=".$p['photo_id']."'> <button> DELETE </button> </a></td></tr>";
    }
    ?>
    </table>
    </div>
    <footer>
            <a href='about.html' id='about'> About </a>
            <a href='legal.html' id='legal'> Legal </a><br>
    </footer>

</html>
