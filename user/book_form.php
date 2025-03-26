<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "agency");

// Check if connection was successful
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Ensure session variable is set
if (!isset($_SESSION['email'])) {
    die("User not logged in");
}

$email = $_SESSION['email'];
$query = "SELECT * FROM users WHERE email='$email'";
$query_run = mysqli_query($connection, $query);

if ($row = mysqli_fetch_assoc($query_run)) {
    if (isset($_POST['send'])) {
        $id = $row['user_id'];
        $package_id = $_POST['package_id'];
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['mobile'];
        $address = $row['address'];
        $location = $_POST['location'];
        $guests = $_POST['guests'];
        $arrivals = $_POST['arrivals'];
        $leaving = $_POST['leaving'];
        $transport_mode = $_POST['transport_mode'];
        $Required_transport = $_POST['required_transport'];
        $Payment_Method = $_POST['payment_method'];
        $duration = $_POST['duration'];
        $Total_price = $_POST['total_price'];

        // Display values in an alert box
        echo "<script>
    alert('Booked your Package:\\nLocation: $location\\nGuests: $guests \\nduration: $duration days \\nArrivals: $arrivals\\nLeaving: $leaving\\nTransport Mode: $transport_mode\\nRequired_transport:  $Required_transport\\npayment_method: $Payment_Method\\ntotal_price: $Total_price\\nThank you !!');</script>";



        // Insert into database using a proper SQL query
        $request = "INSERT INTO book_forms (user_id,package_id, name, email, phone, address, location, guests, arrivals, leaving, transport_mode, Required_transport, Payment_Method,duration,Total_price) 
            VALUES ('$id','$package_id','$name', '$email', '$phone', '$address', '$location', '$guests', '$arrivals', '$leaving', '$transport_mode', '$Required_transport', '$Payment_Method','$duration','$Total_price')";

        if (mysqli_query($connection, $request)) {
            echo "<script>alert('Booking successful! Redirecting...'); window.location.href='book.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error in booking: " . mysqli_error($connection) . "');</script>";
        }
    }
} else {
    echo "<script> alert('user not login')</script>";
    exit();
}
