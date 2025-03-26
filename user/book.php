<?php
require 'connect.php';
session_start();
$package_id = isset($_GET['id']) ? $_GET['id'] : '';
$package_name = isset($_GET['name']) ? urldecode($_GET['name']) : '';
$Time = isset($_GET['Time']) ? urldecode($_GET['Time']) : '';
$price = isset($_GET['price']) ? urldecode($_GET['price']) : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Book</title>

   <!-- External CSS -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="stylesheet" href="mainstyle.css">
</head>

<body>

   <!-- Header Section -->
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
      <div id="menu-btn" class="fas fa-bars"></div>
   </section>

   <div class="heading" style="background:url(images/header-bg-3.png) no-repeat">
      <h1>Book Now</h1>
   </div>

   <!-- Booking Section -->
   <section class="booking">
      <h1 class="heading-title">Book Your Trip</h1>

      <form action="book_form.php" method="post" class="book-form" onsubmit="return validateForm();">
         <div class="flex">
            <div class="inputBox">
               <span>Where to:</span>
               <input type="text" placeholder="Place you want to visit" name="location"
                  value="<?php echo htmlspecialchars($package_name); ?>" required>
               <input type="hidden" name="package_id" value="<?php echo htmlspecialchars($package_id); ?>">
            </div>
            <div class="inputBox">
               <span>How many:</span>
               <input type="number" placeholder="Number of guests" name="guests" min="1" max="200" required>
            </div>
            <div class="inputBox">
               <span>Duration (days):</span>
               <input type="number" placeholder="Duration for tour" name="duration" min="1" value="<?php echo htmlspecialchars($Time); ?>" required>
            </div>
            <div class="inputBox">
               <span>Arrivals:</span>
               <input type="date" name="arrivals" required>
            </div>
            <div class="inputBox">
               <span>Leaving:</span>
               <input type="date" name="leaving" required>
            </div>
            <div class="inputBox">
               <span>Transport Mode:</span>
               <select name="transport_mode">
                  <option value="bus">Bus</option>
                  <option value="sumo">Sumo</option>
               </select>
            </div>
            <div class="inputBox">
               <span>Required Transport:</span>
               <input type="number" placeholder="Enter transport number" name="required_transport" min="1" max="10" required>
            </div>
            <div class="inputBox">
               <span>Payment Method:</span>
               <select name="payment_method">
                  <option value="hand_to_cash">Offline Payment</option>
               </select>
            </div>
            <div class="inputBox">
               <span>price:</span>
               <input type="text" placeholder="total price" name="total_price" min="1" value="<?php echo htmlspecialchars('RS' . $price); ?>" readonly required>
            </div>
         </div>

         <?php if (isset($_SESSION['id'])) { ?>
            <input type="submit" value="Submit" class="btn" name="send">
         <?php } else { ?>
            <input type="button" value="Submit" class="btn" onclick="redirectToLogin();">
         <?php } ?>

      </form>

      <script>
         document.addEventListener("DOMContentLoaded", function() {
            let arrivalInput = document.querySelector("input[name='arrivals']");
            let durationInput = document.querySelector("input[name='duration']");
            let leavingInput = document.querySelector("input[name='leaving']");

            let today = new Date().toISOString().split('T')[0];
            arrivalInput.setAttribute("min", today);

            function updateLeavingDate() {
               if (!arrivalInput.value) return;
               let arrivalDate = new Date(arrivalInput.value);
               let duration = parseInt(durationInput.value, 10);

               if (!isNaN(duration) && duration > 0) {
                  let leavingDate = new Date(arrivalDate);
                  leavingDate.setDate(arrivalDate.getDate() + duration);
                  leavingInput.value = leavingDate.toISOString().split('T')[0];
               }
            }

            arrivalInput.addEventListener("change", updateLeavingDate);
            durationInput.addEventListener("input", updateLeavingDate);
         });

         function redirectToLogin() {
            alert("Please log in to proceed.");
            window.location.href = "index.php";
         }

         function validateForm() {
            let guests = document.querySelector("input[name='guests']").value;
            let duration = document.querySelector("input[name='duration']").value;
            let arrival = document.querySelector("input[name='arrivals']").value;
            let leaving = document.querySelector("input[name='leaving']").value;
            let transport = document.querySelector("input[name='required_transport']").value;

            if (parseInt(guests) <= 0 || parseInt(duration) <= 0 || parseInt(transport) <= 0) {
               alert("Guests, Duration, and Required Transport must be greater than 0.");
               return false;
            }

            if (new Date(arrival) >= new Date(leaving)) {
               alert("Leaving date must be after the arrival date.");
               return false;
            }

            return true;
         }
      </script>
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
            <a href="#">Facebook</a>
            <a href="#">Twitter</a>
            <a href="#">Instagram</a>
            <a href="#">LinkedIn</a>
         </div>
      </div>
   </section>


</body>

</html>