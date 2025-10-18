-------------->>>>Vignan Wifi Access Portal<<<<<------------

------>Developed by:** Karthik


 --->Project Description :

The **Vignan Wifi Access Portal** is a captive portal system designed to control network access for students and faculty. 
Users must log in with valid credentials before gaining internet access. This system supports user roles and session management to enforce login limits per user.

- Students and faculty are assigned unique user IDs.
- Students can have a maximum login limit per ID (e.g., 1 device per student).
- Faculty login is managed similarly, with separate credentials.
- Active sessions are tracked in a MySQL database to prevent multiple logins beyond the allowed limit.
- Implemented using **PHP, MySQL, and XAMPP** on Windows.

------->> Features :

- User authentication for students and faculty.
- Session management and login restrictions.
- Simple web-based login interface.
- Works with a PC acting as a hotspot.
- Database-driven credential storage.

------>>Future Goals :

- Integrate with a **Wi-Fi router** to allow **automatic redirection** to the portal page for all devices connecting to the network.
- Enhance UI for a more user-friendly experience.
- Add support for HTTPS to ensure secure connections.
- Provide real-time monitoring of connected devices and active sessions.

----->> How It Works :

1. Users connect to the hotspot provided by the PC.  
2. Initially, they cannot access the internet.  
3. On opening a browser, users are redirected to the login page.  
4. After entering valid credentials:
   - Internet access is granted.
   - Session is recorded in the database.  
5. If login limits are reached, users are notified that the ID is already in use.


 ------>>Technology Stack :

- **Backend: PHP  
- **Database: MySQL (via phpMyAdmin/XAMPP)  
- **Server: Apache (via XAMPP)  
- **Frontend: HTML, CSS  
- **Platform: Windows PC acting as hotspot  

------->>Usage :

1. Install **XAMPP** and start Apache & MySQL.  
2. Import the SQL database (`captive_portal_wifi.sql`).  
3. Update `db_connect.php` with your MySQL credentials.  
4. Start the hotspot (via PC Wi-Fi or software).  
5. Users connect to the hotspot SSID and are redirected to `login.php`.  
6. After valid login, users get network access.

 --->License

This project is for **educational purposes**.

