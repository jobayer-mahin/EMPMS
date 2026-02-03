SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET NAMES utf8mb4;

DROP DATABASE IF EXISTS emp;
CREATE DATABASE emp;
USE emp;

-- ========================
-- COUNTRIES
-- ========================
CREATE TABLE countries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  countryname VARCHAR(80) NOT NULL
) ENGINE=InnoDB;

INSERT INTO countries (countryname) VALUES
('Bangladesh'),
('USA');

-- ========================
-- ADMIN
-- ========================
CREATE TABLE tbladmin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(45),
  email VARCHAR(45),
  mobile VARCHAR(20),
  password VARCHAR(255),
  create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO tbladmin (name, email, mobile, password)
VALUES
('admin', 'admin@gmail.com', '01700000000', 'f925916e2754e5e03f75dd58a5733251');

-- ========================
-- DEPARTMENTS
-- ========================
CREATE TABLE tbldepartment (
  id INT AUTO_INCREMENT PRIMARY KEY,
  DepartmentName VARCHAR(45)
) ENGINE=InnoDB;

INSERT INTO tbldepartment (DepartmentName) VALUES
('IT'),
('ECE'),
('ME');

-- ========================
-- EMPLOYEE
-- ========================
CREATE TABLE tblemployee (
  id INT AUTO_INCREMENT PRIMARY KEY,
  EmpId VARCHAR(45),
  fname VARCHAR(45),
  lname VARCHAR(45),
  department_id INT,
  email VARCHAR(45),
  mobile VARCHAR(20),
  country_id INT,
  state VARCHAR(45),
  city VARCHAR(45),
  address VARCHAR(200),
  photo VARCHAR(200),
  dob DATE,
  date_of_joining DATE,
  password VARCHAR(255),
  create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT fk_employee_department
    FOREIGN KEY (department_id) REFERENCES tbldepartment(id),

  CONSTRAINT fk_employee_country
    FOREIGN KEY (country_id) REFERENCES countries(id)
) ENGINE=InnoDB;

INSERT INTO tblemployee
(EmpId, fname, lname, department_id, email, mobile, country_id, state, city, address, photo, dob, date_of_joining, password)
VALUES
('Emp12345', 'Sagor', 'Ahmed', 2, 'sagor@gmail.com', '01711223344', 1, 'Dhaka Division', 'Dhaka', 'Mirpur-10, Dhaka', '../uploads/emp1.jpg', '2022-04-03', '2022-03-26', 'f925916e2754e5e03f75dd58a5733251'),

('Emp123456', 'Bristi', 'Saha', 1, 'bristi@gmail.com', '01899887766', 1, 'Chattogram Division', 'Chattogram', 'Pahartali, Chattogram', '../uploads/emp2.jpg', '2022-03-26', '2022-03-27', 'f925916e2754e5e03f75dd58a5733251');

-- ========================
-- SALARY
-- ========================
CREATE TABLE tbladdsalary (
  id INT AUTO_INCREMENT PRIMARY KEY,
  department_id INT,
  empid VARCHAR(45),
  salary DECIMAL(10,2),
  allowance DECIMAL(10,2),
  total DECIMAL(10,2),
  create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT fk_salary_department
    FOREIGN KEY (department_id) REFERENCES tbldepartment(id)
) ENGINE=InnoDB;

INSERT INTO tbladdsalary
(department_id, empid, salary, allowance, total)
VALUES
(1, 'Emp123456', 30000, 5000, 35000);

-- ========================
-- LEAVE TYPE
-- ========================
CREATE TABLE tblleavetype (
  id INT AUTO_INCREMENT PRIMARY KEY,
  leaveType VARCHAR(45),
  create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO tblleavetype (leaveType)
VALUES
('Casual Leave');

-- ========================
-- LEAVE
-- ========================
CREATE TABLE tblleave (
  id INT AUTO_INCREMENT PRIMARY KEY,
  userID INT,
  EmpID VARCHAR(45),
  leaveType_id INT,
  FromDate DATE,
  ToDate DATE,
  Description VARCHAR(450),
  status VARCHAR(45),
  adminremarks VARCHAR(450),
  Create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT fk_leave_type
    FOREIGN KEY (leaveType_id) REFERENCES tblleavetype(id)
) ENGINE=InnoDB;

INSERT INTO tblleave
(userID, EmpID, leaveType_id, FromDate, ToDate, Description, status, adminremarks)
VALUES
(1, 'Emp12345', 1, '2022-04-02', '2022-04-05', 'Family issue', 'Approved', 'Granted'),

(1, 'Emp12345', 1, '2022-04-10', '2022-04-12', 'Medical leave', 'Pending', NULL);

COMMIT;

