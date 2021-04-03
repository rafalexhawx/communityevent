<?php
session_start();
session_destroy();
echo "logged off";
header("location: index.php");
?>