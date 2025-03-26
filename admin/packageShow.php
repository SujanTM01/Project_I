<?php
require '../user/connect.php';

if (isset($_GET['did'])) {
    // Use 'package_id' in SQL DELETE query, as per the updated table structure
    $sql_delete = "DELETE FROM packages WHERE package_id=" . $_GET['did'];
    if (!$conn->query($sql_delete)) {
        die("Error: " . $conn->error);
    }

    echo "<script>alert('Package Deleted.'); window.location.href='packageShow.php';</script>";
}

$sql = "SELECT * FROM packages";  // No changes needed here, as we're now using the correct table
$data = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Management</title>
    <link href="style.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <?php include 'header.php' ?>

        <div class="row2">
            <?php include 'navbar.php' ?>

            <div class="col-2">
                <div class="page-title">
                    <h3>Travel Agency</h3>
                    <a href="package_update.php" class="add-btn">+ Add Package</a>
                </div>

                <div class="view-data">
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>price</th>
                                <th>Duration</th>
                                <th>Package Detail</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            while ($row = $data->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $row['package_id']; ?></td> <!-- Changed from 'id' to 'package_id' -->
                                    <td>
                                        <img src="../updateImg/<?php echo $row['image']; ?>"
                                            alt="Package Image" style="height: 100px; width: 100px;">
                                    </td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo 'RS' . $row['price']; ?></td>
                                    <td><?php echo $row['Time']; ?></td>
                                    <td><?php echo $row['package_detail']; ?></td>
                                    <td><a href="package_update.php?cid=<?php echo $row['package_id'] ?>">Edit</a></td> <!-- Changed from 'id' to 'package_id' -->
                                    <td><a href="packageShow.php?did=<?php echo $row['package_id'] ?>"
                                            onclick="return confirm('Are you sure?')">Delete</a></td> <!-- Changed from 'id' to 'package_id' -->
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

        <?php include 'footer.php' ?>
    </div>

</body>

</html>