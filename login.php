<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("bd_connect.php");

$message = '';

// Clean up old sessions (older than 30 minutes)
$conn->query("DELETE FROM sessions WHERE login_time < NOW() - INTERVAL 30 MINUTE");

if(isset($_POST['login'])){
    $user_input = trim($_POST['username']);
    $pass_input = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, username, password_hash, role, max_sessions FROM users WHERE username=?");
    $stmt->bind_param("s", $user_input);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        if($row['password_hash'] === $pass_input){
            // Check existing sessions
            $stmt2 = $conn->prepare("SELECT session_id, login_time FROM sessions WHERE user_id=?");
            $stmt2->bind_param("i", $row['id']);
            $stmt2->execute();
            $res2 = $stmt2->get_result();
            $sessions = $res2->fetch_all(MYSQLI_ASSOC);

            $allowLogin = true;
            $currentSessionId = session_id();

            if(count($sessions) >= $row['max_sessions']){
                // Check if any existing session matches current session
                $sessionExists = false;
                foreach($sessions as $s){
                    if($s['session_id'] === $currentSessionId){
                        $sessionExists = true;
                        break;
                    }
                }

                if(!$sessionExists){
                    $allowLogin = false;
                    $message = "User already logged in on another device.";
                }
            }

            if($allowLogin){
                $_SESSION['userid'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['role'];

                // Add session if not exists
                $stmt3 = $conn->prepare("INSERT INTO sessions (user_id, session_id) VALUES (?, ?) ON DUPLICATE KEY UPDATE login_time=NOW()");
                $stmt3->bind_param("is", $row['id'], $currentSessionId);
                $stmt3->execute();

                header("Location: welcome.php");
                exit();
            }

        } else {
            $message = "Invalid password.";
        }
    } else {
        $message = "Invalid username.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WiFi Access Portal</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="flex-wrapper">
        <h1 class="main-title">Vignan Institute of Technology and Science</h1>
        <div class="container">
            <h2 class="box-title">WiFi Access Portal</h2>
            <?php if($message) echo "<p class='error-msg'>$message</p>"; ?>
            <form method="POST">
                <input type="text" name="username" placeholder="User ID" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" name="login" value="Login">
            </form>
        </div>
    </div>
</body>
</html>
