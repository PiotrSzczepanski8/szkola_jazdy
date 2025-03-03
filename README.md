# Driving School Website - LimoAuto <img src="public/logo.svg" style="width: 1em;">

A web application for a driving school built using PHP and MySQL. This project includes functionalities for both users and employees, enabling seamless course management.

---

## Setup Instructions

Follow these steps to set up and run the project locally.

### Prerequisites
1. Install [XAMPP](https://www.apachefriends.org/index.html) (or an alternative PHP and MySQL server).
2. Clone or download this repository to your local machine.

### Database Setup
1. Start XAMPP and ensure that the **Apache** and **MySQL** services are running.
2. Access **phpMyAdmin** at [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
3. Import the database:
   - Open phpMyAdmin.
   - Click on the "Import" tab.
   - Choose the SQL file (`szkola_jazdy.sql`) from the project folder.
   - Click "Go" to execute the import.

### Project Configuration
1. Place the project files in the `htdocs` folder of XAMPP (e.g., `C:\xampp\htdocs\szkola_jazdy`).
2. Configure the database connection:
   - Open the file `config/connection.php`.
   - Update the following variables:
     ```php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $database = "szkola_jazdy";
     ```
3. Access the application:
   - Open your browser.
   - Navigate to [http://localhost/szkola_jazdy/client/index.php](http://localhost/szkola_jazdy/client/index.php).

---

## Panels Overview

### User Panel
- Features:
  - User registration and login.
  - Course selection and enrollment.
  - Schedule viewing.

### Employee Panel
- Features:
  - Manage courses and students.
  - Assign instructors and vehicles.
  - Monitor progress and attendance.

---