<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "agency");

// Handle approve request
if (isset($_GET['approve_id'])) {
    $approve_id = $_GET['approve_id'];
    $approve_query = "UPDATE book_forms SET approval_status = 'Approved' WHERE package_id = ?";
    $stmt = mysqli_prepare($connection, $approve_query);
    mysqli_stmt_bind_param($stmt, "i", $approve_id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "<script>alert('Booking approved successfully.'); window.location.href='book.php';</script>";
    } else {
        echo "<script>alert('Failed to approve booking.'); window.location.href='book.php';</script>";
    }

    mysqli_stmt_close($stmt);
}

// Fetch bookings
$query = "SELECT * FROM book_forms";
$query_run = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <link rel="stylesheet" href="table.css">
</head>

<body>
    <nav class="header">
        <div class="navbar">
            <a href="packageShow.php">Home</a>
        </div>
    </nav>
    <table style="border: 1px solid black">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Location</th>
            <th>Guest</th>
            <th>Arrival</th>
            <th>Leaving</th>
            <th>Transport Mode</th>
            <th>Required Transport</th>
            <th>Payment Method</th>
            <th>Duration</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($query_run)) { ?>
            <tr>
                <td><?php echo $row['package_id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><?php echo $row['guests']; ?></td>
                <td><?php echo $row['arrivals']; ?></td>
                <td><?php echo $row['leaving']; ?></td>
                <td><?php echo $row['transport_mode']; ?></td>
                <td><?php echo $row['Required_transport']; ?></td>
                <td><?php echo $row['Payment_Method']; ?></td>
                <td><?php echo $row['duration']; ?></td>
                <td><?php echo $row['Total_price']; ?></td>
                <td><?php echo $row['approval_status']; ?></td>
                <td>
                    <?php if ($row['approval_status'] === 'Pending') { ?>
                        <a href="?approve_id=<?php echo $row['package_id']; ?>" class="approve-button" onclick="return confirm('Approve this booking?')">Approve</a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>