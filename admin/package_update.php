<?php
require '../user/connect.php';

$name = $package_detail = "";
$price = "";
$image_name = "";
$time = "";  // Added to store time
$updateMode = false;

if (isset($_GET['cid'])) {
    $updateMode = true;
    $package_id = $_GET['cid'];

    // Fetch existing package data
    $sql = "SELECT * FROM packages WHERE package_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $package_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $price = $row['price'];
        $time = $row['Time'];  // Assuming it's numeric
        $package_detail = $row['package_detail'];
        $image_name = $row['image'];
    }
}

if (isset($_POST['btnSubmit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $time = $_POST['Time'];  // Time field
    $package_detail = $_POST['package_detail'];
    $image = $_FILES['image']['name'];
    $type = $_FILES['image']['type'];
    $size = $_FILES['image']['size'];
    $img_tmp = $_FILES['image']['tmp_name'];

    // Extract numeric value from price (remove "RS " prefix)
    $price = preg_replace("/[^0-9]/", "", $price);

    // Ensure price is a valid number
    if (!is_numeric($price) || $price < 0) {
        die("<script>alert('Error: Price must be a valid non-negative number.'); window.history.back();</script>");
    }

    // Ensure time is a valid number if it is numeric
    if (!is_numeric($time) || $time < 0) {
        die("<script>alert('Error: Time must be a valid non-negative number.'); window.history.back();</script>");
    }

    if (!empty($image)) {
        // Validate image type
        $allowed_types = ["image/jpeg", "image/gif", "image/png"];
        if (!in_array($type, $allowed_types)) {
            die("<script>alert('Invalid file format. Allowed formats: JPG, PNG, GIF'); window.history.back();</script>");
        }

        // Validate file size (Max 2MB)
        if (($size / (1024 * 1024)) > 2) {
            die("<script>alert('File size exceeds limit. Maximum allowed size is 2MB.'); window.history.back();</script>");
        }

        // Generate unique image name
        $image_name = "package_" . date('Y_m_d_h_i_s') . '.' . pathinfo($image, PATHINFO_EXTENSION);
        move_uploaded_file($img_tmp, '../updateImg/' . $image_name);
    }

    if ($updateMode) {
        // Update package
        if (!empty($image)) {
            // Delete old image if a new one is uploaded
            if (!empty($image_name)) {
                @unlink("../updateImg/" . $image_name);
            }

            $sql = "UPDATE packages SET name=?, price=?, Time=?, package_detail=?, image=? WHERE package_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdsssi", $name, $price, $time, $package_detail, $image_name, $package_id);
        } else {
            $sql = "UPDATE packages SET name=?, price=?, Time=?, package_detail=? WHERE package_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdssi", $name, $price, $time, $package_detail, $package_id);
        }
    } else {
        // Insert new package
        $sql = "INSERT INTO packages (name, price, Time, image, package_detail) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdsss", $name, $price, $time, $image_name, $package_detail);
    }

    if (!$stmt->execute()) {
        die("<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>");
    }

    echo "<script>alert('Package " . ($updateMode ? "updated" : "added") . " successfully.'); window.location.href='packageShow.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Form</title>
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <?php include 'header.php' ?>

        <div class="row2">
            <?php include 'navbar.php' ?>

            <div class="col-2">
                <div class="page-title">
                    <h3><?php echo $updateMode ? "Edit" : "Add"; ?> Package</h3>
                </div>

                <div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image">
                            <?php if ($updateMode && !empty($image_name)): ?>
                                <img src="../updateImg/<?php echo htmlspecialchars($image_name); ?>" alt="Image" style="height: 100px; width: 100px;">
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" id="price" value="<?php echo $price ? 'RS ' . htmlspecialchars($price) : ''; ?>" required oninput="formatPrice(this)">
                        </div>
                        <div class="form-group">
                            <label for="time">Time:</label>
                            <input type="number" name="Time" value="<?php echo htmlspecialchars($time); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="package_detail">Package Detail</label>
                            <textarea name="package_detail" required><?php echo htmlspecialchars($package_detail); ?></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btnSubmit" value="<?php echo $updateMode ? 'Update' : 'Add'; ?>">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include 'footer.php' ?>
    </div>
</body>

</html>