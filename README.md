# Employee Management System (EMPMS)

## 📌 Project Overview
The **Employee Management System (EMPMS)** is a web-based application developed to streamline and automate human resource management tasks within an organization. Built using **PHP and MySQL**, the system provides a centralized platform for administrators to manage employee data, departments, salaries, and leave requests efficiently.

This project was developed following a **phase-based Software Engineering approach** and is intended for **academic and learning purposes**.

---

## ✨ Key Features
- **Employee Management:** Add, update, view, and delete employee records  
- **Department Management:** Organize employees into departments  
- **Leave Management:** Apply, approve, reject, and track leave requests  
- **Salary Management:** Manage employee salary records  
- **Admin Dashboard:** View real-time statistics and system overview  
- **Authentication System:** Secure login for Admin and Employees  

---

## 🛠 Tech Stack
- **Backend:** PHP  
- **Database:** MySQL  
- **Frontend:** HTML, CSS, JavaScript, Bootstrap 
- **Server Environment:** XAMPP / WAMP / MAMP  

---

## 🚀 Getting Started

### Prerequisites
Make sure you have the following installed on your system:
- **Local Server:** [XAMPP](https://www.apachefriends.org/index.html) (Apache, MySQL, PHP)
- **Web Browser:** Google Chrome / Microsoft Edge / Mozilla Firefox
- **Database Manager:** phpMyAdmin (included with XAMPP)

---

### 🔧 Installation Steps

1. **Download or Clone the Project**
   - Download the ZIP file or clone the repository:
     ```bash
     git clone https://github.com/jobayer-mahin/empms.git
     ```
   - Extract (if ZIP) and copy the `empms` folder to:
     - XAMPP: `C:\xampp\htdocs\`
     - WAMP: `C:\wamp64\www\`

2. **Start Server Services**
   - Open **XAMPP Control Panel**
   - Start **Apache** and **MySQL**

3. **Database Setup**
   - Open browser and go to:
     ```
     http://localhost/phpmyadmin
     ```
   - Create a new database (example: `empms_db`)
   - Select the database → Click **Import**
   - Import the provided `empms.sql` file from the project directory

4. **Configure Database Connection**
   - Open:
     ```
     empms/include/config.php
     ```
   - Update database credentials:
     ```php
     define('DB_HOST','localhost');
     define('DB_USER','root');
     define('DB_PASS','');
     define('DB_NAME','empms_db');
     ```

5. **Run the Application**
   - Open browser and visit:
     ```
     http://localhost/empms/
     ```
   - You will be redirected to the **Login Page**

---

## 🔑 Login Credentials
- **Admin Username:** Refer to `tbladmin` table in the database `admin@gmail.com` 
- **Admin Password:** Refer to `tbladmin` table (stored using MD5 hashing) `Test@123`
- **After log-in in as admin you can create an employee and then log-in as an employee 

> ⚠️ Note: This project uses **MD5 password hashing**, which is suitable for academic purposes but not recommended for production systems.



