CREATE DATABASE IF NOT EXISTS captive_portal_wifi;
USE captive_portal_wifi;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(64) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('student','faculty') NOT NULL,
    max_sessions INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    session_id VARCHAR(255) NOT NULL,
    login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Sample Users
INSERT INTO users (username, password_hash, role, max_sessions) VALUES
('s001','studentpass','student',1),
('s002','studentpass','student',1),
('f001','facultypass','faculty',1),
('f002','facultypass','faculty',1);
