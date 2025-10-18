<?php
$servername = "localhost";
$dbname = "captive_portal_wifi";
$dbusername = "root"; // XAMPP default
$dbpassword = "";     // XAMPP default

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
?>
