<?php
session_start();
if(!isset($_SESSION['userid'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WiFi Access Portal - Welcome</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="flex-wrapper">
        <!-- Welcome Box -->
        <div class="container">
            <h2 class="box-title">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
            <p class="welcome-msg">You are now connected to the WiFi Access Portal.</p>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>
</body>
</html>
