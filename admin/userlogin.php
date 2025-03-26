<?php
require '../user/connect.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $delete_sql = "DELETE FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id); // "i" for integer
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('User deleted successfully.'); window.location.href='userlogin.php';</script>";
    } else {
        echo "<script>alert('Failed to delete user.'); window.location.href='userlogin.php';</script>";
    }

    $stmt->close();
}

$sql = "SELECT user_id, name, email, password, mobile, address FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <nav class="header">
        <div class="navbar">
            <a href="packageShow.php">Home</a>
        </div>
    </nav>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Mobile</th>
            <th>Address</th>
            <th>Action</th>
        </tr>

        <?php if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    <td><?php echo $row['mobile']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td>
                        <a class="dl_btn" href="?delete_id=<?php echo $row['user_id']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                    </td>
                </tr>
            <?php }
        } else { ?>
            <tr>
                <td colspan="7">No users found.</td>
            </tr>
        <?php } ?>
    </table>

    <?php $conn->close(); ?>
</body>

</html>