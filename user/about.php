<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="mainstyle.css">

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

   <div class="heading" style="background:url(images/header-bg-1.jpg    ) no-repeat">
      <h1>about us</h1>
   </div>

   <!-- about section starts  -->

   <section class="about">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>At DreamScape Travels,
            we create personalized journeys tailored to your unique preferences.
            Our expert team ensures every detail—from flights to local experiences—is
            designed for your satisfaction. With exclusive offers and insider connections,
            we deliver exceptional travel experiences that exceed expectations.
            Let us help you explore the world with ease and create unforgettable memories.
         </p>
         <div class="icons-container">
            <div class="icons">
               <i class="fas fa-map"></i>
               <span>top destinations</span>
            </div>
            <div class="icons">
               <i class="fas fa-hand-holding-usd"></i>
               <span>affordable price</span>
            </div>
            <div class="icons">
               <i class="fas fa-headset"></i>
               <span>24/7 guide service</span>
            </div>
         </div>
      </div>

   </section>
   <!-- about section ends -->


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