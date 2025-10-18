<?php
session_start();
include("bd_connect.php");

if(isset($_SESSION['userid'])){
    $stmt = $conn->prepare("DELETE FROM sessions WHERE session_id=?");
    $session_id = session_id();
    $stmt->bind_param("s", $session_id);
    $stmt->execute();
}

session_destroy();
header("Location: login.php");
exit();
