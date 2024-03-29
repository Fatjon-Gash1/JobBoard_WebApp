<?php
include("database.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="header.js" defer></script>
  <script src="register_validate.js" defer></script>

  <title>Sign Up | JobLand</title>
</head>

<body>
  <div class="rform-div">
    <form class="rform" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
      <div class="register-header">
        <h2>Register now</h2>
        <h3>Don't miss a opportunity!</h3>
      </div>
      <input type="text" placeholder="Username" name="username" id="usernameR"><br><br>
      <input type="email" placeholder="Email" name="email" id="emailR"><br><br>
      <input type="password" placeholder="Password" name="password" id="passwordR" minlength="8" maxlength="12" /><br><br>
      <input style="margin-top: 1em;" class="submit_reg" type="submit" name="submit" value="Agree & Register" id="submit">

      <?php

      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($username) || empty($email) || empty($password)) {
          echo "<p class='error'>Please fill in all the required fields!</p>";
        } else {
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);
          $sql = "INSERT INTO users (username, email, password) 
                VALUES ('$username', '$email', '$hashed_password')";

          try {
            mysqli_query($conn, $sql);

            session_start();
            $_SESSION['username'] = $username;
            header("Location: home.php");
          } catch (mysqli_sql_exception) {
            echo "<p class='error'>That username is already taken!</p>";
          }
        }
      }
      mysqli_close($conn);
      ?>

      <p>By clicking Agree & Register, <br> you agree to the JobLand <span>User Agreement</span>, <span>Privacy Policy</span>, <br> and <span>Cookie Policy</span>.</p>

      <button class="social_buttons" type="button"><img src="images/google.png" alt="img"><a href="https://accounts.google.com/v3/signin/identifier?continue=https%3A%2F%2Faccounts.google.com%2F&followup=https%3A%2F%2Faccounts.google.com%2F&ifkv=ATuJsjxmLrtFZ4EGS7NyROIpqsLhJf8WM1_6NWuaZH9-d3DCk_GTQE1YGgYJR-La0G4cSa8740S6&passive=1209600&flowName=GlifWebSignIn&flowEntry=ServiceLogin&dsh=S504026482%3A1708206817060372&theme=glif">Continue with Google</button>
      <button class="social_buttons" type="button"><img src="images/twitter.png" alt="img"><a href="https://twitter.com/i/flow/login"> Sign in with Twitter</button>
      <button class="social_buttons" type="button"><img src="images/github.png" alt="img"><a href="https://github.com/login"> Sign in with Github</button>

      <p>Already have an account? <a href="user_login.php"><span id="rp-login">Login</span></a></p>
    </form>
  </div>
</body>

<?php
include('footer.php');
?>

</html>