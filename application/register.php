<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <script src="header.js" defer></script>
    <script src="script.js" defer></script>
    
    <title>Sign Up | JobLand</title>
  </head>
  <body>
    <div class="nav-bar">
      <a href="home.php"><h1 class="M-logo">JL</h1></a>
    </div>
      <form class="rform" method="post" name="myform">
        <label>Username</label><br>
        <input type="username" name="username" id="username" /><br><br>
        <label>Email</label><br>
        <input type="email" name="email" id="email" /><br><br>
        <label>Password</label><br>
        <input type="password" name="password" id="password" minlength="8" maxlength="12"/><br><br>
        <p>By clicking Agree & Register, you agree to the JobLand <span>User Agreement</span>, <span>Privacy Policy</span>, and <span>Cookie Policy</span>.</p>
        <input type="button" value="Agree & Register" id="submit" />
        <label "></label>
      </form>
  </body>
</html>
