CREATE DATABASE agency;
USE agency;

CREATE TABLE admin_db (
    admin_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(50)
);

CREATE TABLE users (
    user_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50),
    email VARCHAR(100),
    password VARCHAR(100),
    mobile VARCHAR(15),
    address VARCHAR(250)
);

CREATE TABLE packages (
    package_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    admin_id INT(11),
    name VARCHAR(255),
    price VARCHAR(1000),
    package_detail VARCHAR(500),
    image VARCHAR(500),
    Time VARCHAR(100),
    FOREIGN KEY (admin_id) REFERENCES admin_db(admin_id) ON DELETE CASCADE
);

CREATE TABLE book_forms (
    b_id INT(50) PRIMARY KEY AUTO_INCREMENT,
    package_id INT(30),
    user_id INT(30),
    name VARCHAR(20),
    email VARCHAR(50),
    phone VARCHAR(20),
    address VARCHAR(30),
    location VARCHAR(30),
    guests INT(11),
    arrivals DATE,
    leaving DATE,
    transport_mode VARCHAR(200),
    Required_transport INT(11),
    Payment_Method VARCHAR(30),
    duration VARCHAR(100),
    Total_price VARCHAR(100),
    approval_status ENUM('Pending', 'Approved'),
    FOREIGN KEY (package_id) REFERENCES packages(package_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);