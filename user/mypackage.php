<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "agency");

// Ensure the user is logged in
if (!isset($_SESSION['id'])) {
    echo "<script>alert('Please log in first.'); window.location.href='index.php';</script>";
    exit();
}
$user_id = $_SESSION['id'];

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Delete the booking from the database
    $delete_query = "DELETE FROM book_forms WHERE package_id = ? AND user_id = ?";
    $stmt = mysqli_prepare($connection, $delete_query);
    mysqli_stmt_bind_param($stmt, "ii", $delete_id, $user_id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "<script>alert('Booking deleted successfully.'); window.location.href='mypackage.php';</script>";
    } else {
        echo "<script>alert('Failed to delete booking.'); window.location.href='mypackage.php';</script>";
    }

    mysqli_stmt_close($stmt);
}

// Fetch the bookings for the logged-in user
$query = "SELECT * FROM book_forms WHERE user_id = ?";
$stmt = mysqli_prepare($connection, $query);

if (!$stmt) {
    die("Failed to prepare statement: " . mysqli_error($connection));
}

mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if there are no bookings
$noBookings = mysqli_num_rows($result) === 0;

// Close the database connection
mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link rel="stylesheet" href="mainstyle.css">
</head>

<body>
    <section class="header">
        <a href="home.php" class="logo">Travel.</a>
        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="package.php">Package</a>
            <a href="book.php">Book</a>
            <a href="mypackage.php">MyBookings</a>
            <?php if (isset($_SESSION['id'])) { ?>
                <span style="font-size: 10px;">Welcome, <?php echo htmlspecialchars($_SESSION['name'] ?? 'User'); ?>!</span>
                <a href="logout.php" id="logout">Logout</a>
            <?php } else { ?>
                <a href="index.php" id="login">Login</a>
            <?php } ?>
        </nav>
    </section>

    <div class="heading" style="background:url(images/header-bg-3.png) no-repeat">
        <h1>My Bookings</h1>
    </div>

    <!-- Table to Display Bookings -->
    <section class="booking-table">
        <h2>Here are your bookings:</h2>

        <?php if ($noBookings) { ?>
            <p>You have no bookings yet.</p>
        <?php } else { ?>
            <table>
                <tr>
                    <th>Package ID</th>
                    <th>Location</th>
                    <th>Guests</th>
                    <th>Duration</th>
                    <th>Arrival Date</th>
                    <th>Leaving Date</th>
                    <th>Transport Mode</th>
                    <th>Required Transport</th>
                    <th>Payment Method</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['package_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['location']); ?></td>
                        <td><?php echo htmlspecialchars($row['guests']); ?></td>
                        <td><?php echo htmlspecialchars($row['duration']); ?></td>
                        <td><?php echo htmlspecialchars($row['arrivals']); ?></td>
                        <td><?php echo htmlspecialchars($row['leaving']); ?></td>
                        <td><?php echo htmlspecialchars($row['transport_mode']); ?></td>
                        <td><?php echo htmlspecialchars($row['Required_transport']); ?></td>
                        <td><?php echo htmlspecialchars($row['Payment_Method']); ?></td>
                        <td><?php echo htmlspecialchars($row['Total_price']); ?></td>
                        <td>
                            <?php if ($row['approval_status'] === 'Approved') { ?>
                                <span style="color: green; font-weight: bold;">Approved</span>
                            <?php } else { ?>
                                <span style="color: orange; font-weight: bold;">Pending</span>
                            <?php } ?>
                        </td>
                        <td>
                            <a href="mypackage.php?delete_id=<?php echo $row['package_id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</a>
                        </td>

                    </tr>
                <?php } ?>
            </table>
        <?php } ?>
    </section>
</body>

</html>