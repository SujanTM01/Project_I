<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- External CSS & JS Links -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="stylesheet" href="mainstyle.css">
</head>

<body>

   <!-- Header Section -->
   <section class="header">
      <a href="home.php" class="logo">Travel</a>
      <nav class="navbar">
         <a href="home.php">home</a>
         <a href="about.php">about</a>
         <a href="package.php">package</a>
         <a href="book.php">book</a>
         <a href="mypackage.php">MyBookings</a>
         <?php if (isset($_SESSION['id'])) { ?>
            <!-- If user is logged in, display their name -->
            <span style="font-size: 10px; ">Welcome, <?php echo $_SESSION['name'] ?? 'User' ?>!</span>
            <a href="logout.php" id="logout">Logout</a>
         <?php } else { ?>
            <!-- If user is not logged in, show the login button -->
            <a href="index.php" id="login">Login</a>
         <?php } ?>
      </nav>

      <div id="menu-btn" class="fas fa-bars"></div>
   </section>

   <!-- Home Section -->
   <section class="home">
      <div class="slide" style="background:url(images/home-slide-1.jpg) no-repeat"></div>
   </section>

   <!-- Services Section -->
   <section class="services">
      <h1 class="heading-title"> Our Services </h1>
      <div class="box-container">
         <div class="box"><img src="images/icon-1.png" alt="">
            <h3>Adventure</h3>
         </div>
         <div class="box"><img src="images/icon-2.png" alt="">
            <h3>Tour Guide</h3>
         </div>
         <div class="box"><img src="images/icon-3.png" alt="">
            <h3>Trekking</h3>
         </div>
         <div class="box"><img src="images/icon-4.png" alt="">
            <h3>Camp Fire</h3>
         </div>
         <div class="box"><img src="images/icon-5.png" alt="">
            <h3>Off Road</h3>
         </div>
      </div>
   </section>

   <!-- Home About Section -->
   <section class="home-about">
      <div class="image"><img src="images/about-img.jpg" alt=""></div>
      <div class="content">
         <h3>About Us</h3>
         <p>Welcome to DreamScape Travels, your ultimate travel partner for unforgettable experiences around the world!</p>
         <a href="about.php" class="btn">Read More</a>
      </div>
   </section>

   <!-- Home Packages Section -->
   <section class="home-packages">
      <h1 class="heading-title"> Our Packages </h1>
      <div class="box-container">
         <div class="box">
            <div class="image"><img src="images/img-1.jpg" alt=""></div>
            <div class="content">
               <h3>Muktinath</h3>
               <p>Nepal Tour, Time: 4-6 days</p>
               <?php if (isset($_SESSION['id'])) { ?>
                  <a href="package.php" class="btn">More Details </a>
               <?php } else { ?>
                  <a href="index.php" class="btn" onclick="alert('Please log in to proceed');">More Details</a>
               <?php } ?>
            </div>
         </div>

         <div class="box">
            <div class="image"><img src="images/img-2.jpg" alt=""></div>
            <div class="content">
               <h3>Pokhara</h3>
               <p>Nepal Tour, Time: 2 Days</p>
               <?php if (isset($_SESSION['id'])) { ?>
                  <a href="package.php" class="btn">More Details</a>
               <?php } else { ?>
                  <a href="index.php" class="btn" onclick="alert('Please log in to proceed');">More Details</a>
               <?php } ?>
            </div>
         </div>

         <div class="box">
            <div class="image"><img src="images/img-3.jpg" alt=""></div>
            <div class="content">
               <h3>Patan</h3>
               <p>Nepal Tour, Time: 1 Day</p>
               <?php if (isset($_SESSION['user_id'])) { ?>
                  <a href="package.php" class="btn">More Details</a>
               <?php } else { ?>
                  <a href="index.php" class="btn" onclick="alert('Please log in to proceed');">More Details</a>
               <?php } ?>
            </div>
         </div>
      </div>

      <div class="load-more">
         <?php if (isset($_SESSION['id'])) { ?>
            <a href="package.php" class="btn">Load More</a>
         <?php } else { ?>
            <a href="index.php" class="btn" onclick="alert('Please log in to proceed');">Load More</a>
         <?php } ?>
      </div>
   </section>

   <!-- Home Offer Section -->
   <section class="home-offer">
      <div class="content">
         <h3>Enjoy Your Day</h3>
         <p>DreamScape</p>
         <?php if (isset($_SESSION['id'])) { ?>
            <a href="package.php" class="btn">Book Now</a>
         <?php } else { ?>
            <a href="index.php" class="btn" onclick="alert('Please log in to proceed');">Book Now</a>
         <?php } ?>
      </div>
   </section>

   <!-- Footer Section -->
   <section class="footer">
      <div class="box-container">
         <div class="box">
            <h3>Quick Links</h3>
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="package.php">Package</a>
            <a href="book.php">Book</a>
         </div>
         <div class="box">
            <h3>Contact Info</h3>
            <a href="#">986242463</a>
            <a href="#">sujanlama23@gmail.com</a>
            <a href="#">Kathmandu, Lalitpur</a>
         </div>
         <div class="box">
            <h3>Follow Us</h3>
            <a href="https://www.facebook.com/" target="_blank">Facebook</a>
            <a href="#">Twitter</a>
            <a href="https://www.instagram.com/sujanlama11.11/" target="_blank">Instagram</a>
            <a href="#">LinkedIn</a>
         </div>
      </div>
   </section>


</body>

</html>