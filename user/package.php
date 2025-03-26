<?php
session_start();
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "agency");
$query = "select * from packages";
$query_run = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>package</title>

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="a.css">

</head>

<body>

   <!-- header section starts  -->

   <section class="header">

      <a href="home.php" class="logo">travel.</a>

      <nav class="navbar">
         <a href="home.php">home</a>
         <a href="about.php">about</a>
         <a href="package.php">package</a>
         <a href="book.php">book</a>
         <a href="mypackage.php">MyBookings</a>
         <?php if (isset($_SESSION['id'])) { ?>
            <!-- If user is logged in, display their name -->
            <span style="font-size: 10px;">Welcome, <?php echo $_SESSION['name'] ?? 'User' ?>!</span>
            <a href="logout.php" id="logout">Logout</a>
         <?php } else { ?>
            <!-- If user is not logged in, show the login button -->
            <a href="index.php" id="login">Login</a>
         <?php } ?>

         <div id="menu-btn" class="fas fa-bars"></div>

   </section>

   <!-- header section ends -->

   <div class="heading" style="background:url(images/header-bg-2.png) no-repeat">
      <h1>packages</h1>
   </div>

   <!-- packages section starts  -->


   <?php
   while ($row = mysqli_fetch_assoc($query_run)) {
   ?>
      <div class="packagecontainer">
         <div class="packagebox">
            <div class="photoss">
               <img src="../updateImg/<?php echo htmlspecialchars($row['image']); ?>" alt="Image">
            </div>
            <div class="package_detail">
               <div class="hello">
                  <?php echo nl2br(htmlspecialchars($row['package_detail'])); ?>
               </div>
            </div>
            <div class="packagename">
               <?php echo htmlspecialchars($row['name']); ?>
            </div>
            <div class="description">
               <?php echo nl2br(htmlspecialchars('RS.' . $row['price'])); ?>
            </div>
            <div class="packageTime">
               <?php echo htmlspecialchars($row['Time'] . ':Day'); ?>
            </div>
            <!-- <button><a href="book.php">Book Now</a></button> -->
            <a href="book.php?id=<?php echo urlencode($row['package_id']); ?>&name=<?php echo urlencode($row['name']); ?>&Time=<?php echo urlencode($row['Time']); ?>&price=<?php echo urlencode($row['price']); ?>" class="btn">Book Now</a>

         </div>

      </div>

   <?php
   }
   ?>
   </table>

   <!-- footer section starts  -->

   <section class="footer">

      <div class="box-container">

         <div class="box">
            <h3>quick links</h3>
            <a href="home.php"> <i class="icon-home"></i> home</a>
            <a href="about.php"> <i class="icon-about"></i> about</a>
            <a href="package.php"> <i class="icon-package"></i> package</a>
            <a href="book.php"> <i class="icon-book"></i> book</a>
         </div>
         <div class="box">
            <h3>contact info</h3>
            <a href="#"> <i class="phone1"></i> 986242463 </a>
            <a href="#"> <i class="email"></i> sujanlama23@gmail.com </a>
            <a href="#"> <i class="location"></i> kathmandu,lalitpur </a>
         </div>

         <div class="box">
            <h3>follow us</h3>
            <a href="#"> <i class="facebook"></i> facebook </a>
            <a href="#"> <i class="twitter"></i> twitter </a>
            <a href="#"> <i class="instagram"></i> instagram </a>
            <a href="#"> <i class="linkedin"></i> linkedin </a>
         </div>
      </div>


      </div>
   </section>

   <!-- footer section ends -->



</body>

</html>