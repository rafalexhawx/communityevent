<html>  
    <head>
        <link rel="stylesheet" href="style.css" type="text/css">
        <title>Sign up</title>
        <link rel="icon" type="image/png" href="logo.png">
        <script type='text/javascript'> 
        function verifypass() {
            var pass1 = document.getElementById('pass');
            var pass2 = document.getElementById('pass2');
            if(pass1.value != pass2.value) {
                alert("Passwords don't match");
                return false;
            } else {
                return true;
            }
        }
        </script>
    </head>
    <header>
        <h1 class="headertitle"> Community event </h1> <img src='logo.png' height='95px' id="logo"><br>
        <?php echo isset($_SESSION) ? $_SESSION['fname']." ".$_SESSION['lname'].", ".$_SESSION['age'] : "Not logged in";?>
        <center><?php echo date('h:i A  l F dS Y');?></center>
    </header> 

    <form action="add_userprocessor.php" method="POST" id='new_user_form' onsubmit="return verifypass()">
        First name <input type='text' size='25' name='fname' required><br>
        Last name <input type='text' size='25' name='lname' required><br>
        Email <input type='email' size='25' name='email' required><br>
        Date of birth <input type='date' name='bday' required><br>
        Password <input type='password' size='25' name='pass' id='pass' required><br>
        Repeat password <input type='password' size='25' id='pass2' required><br>
        <input type='submit' value='Create Account'>
    </form>


    <footer>
            <a href='about.html' id='about'> About </a>
            <a href='legal.html' id='legal'> Legal </a><br>
    </footer>

</html>