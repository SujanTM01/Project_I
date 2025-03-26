<?php
session_start();
include 'connect.php';
if (isset($_POST['signUp'])) {
    $Name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password']; // Get the confirm password
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];

    // Check if password and confirm password match
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match. Please try again.');</script>";
    } else {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if the email already exists
        $checkEmail = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($checkEmail);

        if ($result->num_rows > 0) {
            echo "<script>alert('Email Address Already Exists!');</script>";
        } else {
            // Insert the user into the database
            $insertQuery = "INSERT INTO users (name, email, password, mobile, address) 
                            VALUES ('$Name', '$email', '$hashedPassword', '$mobile', '$address')";

            if ($conn->query($insertQuery) === TRUE) {
                header("Location: index.php");
                exit();
            } else {
                echo "<script>alert('Error: " . $conn->error . "');</script>";
            }
        }
    }
}

if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password using password_verify()
        if (password_verify($password, $row['password'])) {
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['id'] = $row['user_id'];
            $_SESSION['phone'] = $row['mobile'];
            $_SESSION['address'] = $row['address'];

            header("Location: home.php");
            exit();
        } else {
            echo "Incorrect Email or Password.";
        }
    } else {
        echo "<script> alert('User not found.');window.location.href='index.php';</script>";
    }
}
