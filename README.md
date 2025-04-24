# 🏛️ Modern Architecture Site

A PHP-based website showcasing modern architectural styles, designs, and trends. The site allows users to register, view architectural content, and explore curated galleries of contemporary structures.

## 🚀 Features

- Clean and responsive front-end design
- User registration and login system
- Dynamic content rendering using PHP and MySQL
- Easy database setup with `user-registration.sql`
- Built to run locally with WAMP

---

## 🛠️ How to Run This Project

Follow these steps to set up the project locally using **WAMP**:

### 1. 🔧 Install WAMP Server

If you don’t have WAMP installed yet:

- Download it from: [https://www.wampserver.com/en/](https://www.wampserver.com/en/)
- Install it and launch WAMP (make sure the icon in the taskbar is green)

### 2. 📁 Place the Project in `www` Directory

- Locate your WAMP installation folder (usually `C:\wamp64\`)
- Copy the entire project folder (`Modern-architecture-site`) into:
  

### 3. 🗃️ Import the Database

1. Open your browser and go to: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Click on **Databases** > Create a new database, name it something like `architecture_site`
3. Click on the new database, then go to **Import**
4. Import the provided SQL file:
 - `user-registration.sql`

This will create the necessary tables for user registration and login.

### 4. ⚙️ Configure the Database Connection

- Open the project folder and look for a file like `config.php` or wherever your DB connection is handled
- Update the following values if needed:

## 📸 Screenshots

### 🔒 Login Page
![Login Page](screenshots/login.png)

### 🌆 Homepage
![Homepage](screenshots/home.png)
![Homepage](screenshots/home_vid.mp4)
```php
$host = 'localhost';
$user = 'root';
$password = ''; // WAMP default has no password
$database = 'architecture_site';
