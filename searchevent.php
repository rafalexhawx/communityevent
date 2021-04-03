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
        <title>Event catalog</title>
    </head>
    <header>
        <h1 class="headertitle"> Community event </h1> <img src='logo.png' height='95px' id="logo"><br>
        <?php echo isset($_SESSION['id']) ? $_SESSION['fname']." ".$_SESSION['lname'].", ".$_SESSION['age'] : "Not logged in";?>
        <center><?php echo date('h:i A  l F dS Y');?></center>
        <form action='logoff.php' method='POST'><input value='Log off' type='submit'></form>
    </header> 
    <br>
    <?php
    $c = requestfromstring("SELECT COUNT(event_id) FROM event")[0]['count'];?>
    <p2> Hosting an event? Add it <a href='add_event_form.php'>here</a> with the <?php echo $c?> other ones</p2>
    <br>
    <p2> Don't know what to sign up to? Here are some <a href='/suggest.php'> suggestions </a></p2>
    <br>
    <p2> Do you still have some events you can rate ? Check <a href='/add_rating_form.php'> here </a></p2>
    <br>
    <?php if($_SESSION['email'] == "admin@communityevent.tech") { echo "<a href='/admin.php'> <button> ADMIN PAGE </button> </a>";}?>
    <br>
    <div class='results'>
    <center> 
    <form action='searchevent.php' method="POST">
        Search <input type="search" name='search' value=""><input value='search' type='submit'>
        Order by:
        <input type='radio' value='name' name='type' checked> Name </input>
        <input type='radio' value='date' name='type'> Date </input> 
        <input type='radio' value='place' name='type'> Place </input>
        <input type='radio' value='rating' name='type'> Rating </input> 
        <input type='radio' value='category' name='type'> Category </input> 
        <select name='cat'>
            <?php 
            $categories = requestfromstring("SELECT * FROM category");
            foreach($categories as $c) {
                echo "<option value=".$c['category_id']."> ".$c['category_name']."</option>";
            }
            ?>
        </select>&emsp;
    </form>
    </center>
        
    <?php
    $search = $_POST['search'];
    $search = strtolower($search);
    $type = $_POST['type'];
    $cat = $_POST['cat'];
    $requeststring = "SELECT event.event_id, event_name, event_place, event_date, event_duration, event_min_age, event_description FROM event WHERE (LOWER(event_name) LIKE '%$search%' OR LOWER(event_description) LIKE '%$search%')";
    $requeststring = $requeststring." AND event_min_age <= ".$_SESSION['age'];
    if($type == 'date') {
        $requeststring = $requeststring." ORDER BY event_date DESC";
    } elseif ($type == 'name') {
        $requeststring = $requeststring." ORDER BY event_name";
    } elseif ($type == 'place') {
        $requeststring = $requeststring." ORDER BY event_place";
    } elseif ($type == 'rating') {
        $requeststring = "
        SELECT event.event_id, event_name, event_place, event_date, event_duration, event_min_age, event_description, AVG(rating) AS rating FROM event, rated
        WHERE event.event_id = rated.event_id
        AND (LOWER(event_name) LIKE '%$search%' OR LOWER(event_description) LIKE '%$search%')
        GROUP BY event.event_name, event.event_id, event_place, event_date, event_duration, event_min_age, event_description
        ORDER BY rating DESC";
    }
    if ($type == 'category') {
        $requeststring = $requeststring."
        INTERSECT 
        SELECT event.event_id, event_name, event_place, event_date, event_duration, event_min_age, event_description FROM event, category, isofcategory
        WHERE isofcategory.event_id = event.event_id
        AND isofcategory.category_id = category.category_id
        AND category.category_id = $cat"; 
    }
    //echo $requeststring;
    $results = requestfromstring($requeststring);
    ?>
    <p style='color:green; display:inline-block'> Upcoming event </p> <p style='color:orange; display:inline-block'> Ongoing event </p> <p style='color:red; display:inline-block'> Event done </p><br>
    <?php
    foreach($results as $event) {
        //var_dump($event); For development purposes only
        displayEventsearch($event);
    }
    ?>
    <br>
    </div>
    <br>
    <footer>
            <a href='about.html' id='about'> About </a>
            <a href='legal.html' id='legal'> Legal </a><br>
    </footer>

</html>

    

