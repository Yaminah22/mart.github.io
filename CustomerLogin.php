<?php
require("connections.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>My Mart</title>
  <link rel="icon" href="CHPImages\logo.ico" type="image/x-icon">
  <link rel="stylesheet" href="CSS\StyleLoginSignup.css">
</head>

<body>
  <div class="home">
    <div>
      <a href="index.php"><img src="CLSImages\home icon.jpg"></a>

    </div>
  </div>
  <div class="Login-page">
    <div class="container">
      <div class="row">
        <div class="col-2">
          <img src="CLSImages\title.png">
          <h1><u> My Mart </u></h1>
          <h2>The Ultimate Shopping Solution!</h2>
          <p> Collection by My Mart. Easy way to buy grocery online and save time and money.There are many grocery apps are available today! that offers many superstores in your smartphone under your thumb.</p>
        </div>
        <div class="col-2">
          <div class="form-container">
            <div class="form-btn">
              <span>Login</span>
            </div>
            <form method="post" action="login.php">
              <input type="text" placeholder="Username" name="username">
              <input type="password" placeholder="Password" name="password" required>
              <button type="submit" class="btn" name="login">Login</button>
              <br>or<br> Don't Have an Account. <a href="CustomerSignup.php">Sign Up</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>