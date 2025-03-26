<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register & Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <!-- Register page************ -->
  <div class="container" id="signup" style="display:none;">
    <h1 class="form-title">Register </h1>
    <form method="post" action="register.php">
      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" name="name" id="name" placeholder="Name" required>
        <label for="name">Name</label>
      </div>
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <label for="email">Email</label>
      </div>
      <div class="input-group">
        <i class="fas fa-mobile"></i>
        <input type="number" name="mobile" id="mobile" placeholder="mobile" required>
        <label for="mobile">Mobile</label>
      </div>
      <div class="input-group">
        <i class="fas fa-location"></i>
        <input type="text" name="address" id="address" placeholder="address" required>
        <label for="address">Address</label>
      </div>
      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <label for="password">Password</label>
      </div>
      <!-- Update the confirm password field -->
      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
        <label for="confirm_password">Confirm Password</label>
      </div>

      <input type="submit" class="btn" value="Sign Up" name="signUp">
    </form>

    <div class="links">
      <p>Already Have Account ?</p>
      <button id="signInButton">Sign In</button>
    </div>
  </div>

  <!-- ***********************Signin Page***********************************************88 -->
  <div class="container" id="signIn">
    <h1 class="form-title">Travel Agency</h1>
    <form method="post" action="register.php">
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <label for="email">Email</label>
      </div>
      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <label for="password">Password</label>
      </div>
      <p class="recover">
        <a href="../admin/adminlog.php">Admin Login</a>
      </p>
      <input type="submit" class="btn" value="Sign In" name="signIn">
    </form>

    <div class="links">
      <p>Don't have account yet?</p>
      <button id="signUpButton">Sign Up</button>
    </div>
  </div>
  <script src="script.js"></script>
</body>

</html>