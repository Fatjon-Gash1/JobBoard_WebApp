<?php
include("database.php");

session_start();

// Initialize login attempts if not set
if (!isset($_SESSION['login_attempts'])) {
  $_SESSION['login_attempts'] = 0;
}

// Define the rate limit settings
$maxAttempts = 3; // Maximum number of attempts allowed
$lockoutTime = 30; // Lockout time in seconds after reaching the maximum attempts

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $enteredUsername = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
  $enteredPassword = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

  $sql = "SELECT username, password FROM users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $enteredUsername);
  $stmt->execute();
  $stmt->bind_result($dbUsername, $dbPassword);
  $stmt->fetch();
  $checklogin = 0;

  if ($enteredUsername == $dbUsername && password_verify($enteredPassword, $dbPassword)) {

    // Clear login attempts on successful login
    $checklogin = 1;
    unset($_SESSION['login_attempts']);

    $_SESSION['username'] = $enteredUsername;
    header("Location: home.php");
    exit();
  } else {

    // Failed login
    $checklogin = 2;
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="header.js" defer></script>
  <script src="login_script.js" defer></script>

  <title>Log In | JobLand</title>
</head>

<body>
  <div class="rform-div">
    <form class="rform" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
      <h2 style="margin-bottom: 1em;">Log In</h2>
      <input type="text" placeholder="Username" name="username" id="usernameR" /><br><br>
      <input type="password" placeholder="Password" name="password" id="passwordR" minlength="8" maxlength="12" /><br><br>
      <?php include('login.php'); ?>

      <input style="margin-bottom: 1em;" class="submit_reg" type="submit" value="Login" id="submit" onclick="validate()" /><br>
      <label id="remember" for="remember"><input type="checkbox" id="remember" name="remember">
      <span style="margin-left: 10px; color: white;">Remember me</span>
      </label><br>
      <p id="forgot">Forgot <a href="forgot.php"><span>password?</span></a></p>
      <p>Don't have an account? <a href="register.php"><span id="rp-login">Register</span></a></p>
    </form>
  </div>
</body>

<?php
include('footer.php');
?>
</html>
