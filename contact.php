<!DOCTYPE html>
<html>

<?php
require("connections.php");
session_start();
?>

<head>
  <title>Contact Us</title>
  <meta name="description" content="Online Grocery Store" />
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" ; charset="utf-8">
  <meta name="HandheldFriendly" content="true">
  <link rel="stylesheet" href="CSS\stylingCustomer_homePage.css">
  <link rel="stylesheet" href="CSS\StyleLoginSignup.css">
  <link rel="stylesheet" href="CSS\style.css">
  <link rel="icon" href="CHPImages\logo.ico" type="image/x-icon">
  <script defer src="fontawesome/js/all.js"></script>
  <script src="https://use.fontawesome.com/92d2dff442.js"></script>

</head>

<body>
  <!--Search Bar-->
  <!--This will only appear when search button is clicked-->
  <div id="searchContainer" class="opacBackground">
    <div id="searchCloseBtn" onclick="closeSearch()"><i class="fas fa-times"></i></div>
    <form class="searchBarContainer" action="search.php" method="POST">
      <input class="searchBar" type="text" name="key_word" placeholder="Search in Mart....">
      <button id="SearchButton" name="search"><img src="CHPImages\searchBarButton.png" /></button>
    </form>
  </div>
  <!--Top Navigation Pane-->
  <div id="header">
    <div id="Admin">
      <p><strong><a href="./Admin_Login.php">Switch To Admin</a></strong></p>
    </div>
    <div class="firstLine">
      <div id="pageTitleDiv">
        <!--Hidden Menu Button-->
        <button id="hiddenMenuButton" onclick="OpenhiddenMenu()"><i class="fas fa-list fa-lg"></i>
        </button>
        <!--Logo and Title-->
        <div id="pageTitle">
          <a href="./index.php">
            <div id="logoImg">
              <img src="CHPImages\title.png" alt="Mart">
            </div>
            <h1 class="pageTitleHeading">Mart</h1>
          </a>
        </div>
      </div>
      <div id="floatRight">
        <!--Search Icon-->
        <div id="searchIcon" onclick="openSearch()">
          <img src="CHPImages\search.png">
          <div id="search_dropdown">
            Click to open Search
          </div>
        </div>
        <!--User Accounts icon-->
        <?php
        if (isset($_SESSION['logged_in'])  && $_SESSION['logged_in'] == true) {
          echo "
                     <div  id='accountIcon'>
                     <img src='CHPImages\accountIcon.png'>
                     <div id='account_dropdown'>
                        $_SESSION[username] - <a href='logout.php'>LOGOUT</a>
                     </div>
                     </div>
                        ";
        } else {
          echo "
                   <div  id='accountIcon'>
                      <a href='CustomerLogin.php'>
                      <img src='CHPImages\accountIcon.png'>
                     <div id='account_dropdown'>
                        Click Here to Login or Create Account!
                     </div>
                    </div>
                     </a>
                      ";
        }
        ?>
        <!--Cart Status-->
        <a href="cart.php" id="cart_icon">
          <img src="CHPImages\cartIcon.png">
          <div id="cartDropdown">
            <?php
            $count = 0;
            if (isset($_SESSION['cart'])) {
              $count = count($_SESSION['cart']);
            }
            echo "Your cart has $count items";
            ?>
          </div>
        </a>
      </div>
    </div>
    <!--Main Navigation Bar-->
    <div id="navigationBar">
      <ul>
        <li><a href="index.php"><i class="fas fa-home fa-sm"></i> Home</a></li>
        <li><a href="categoriesList.php"><i class="fas fa-clipboard-list"></i> Categories</a></li>
        <li><a href="brandsList.php"><i class="fas fa-star"></i> Brands</a></li>
        <li><a href="products.php"><i class="fas fa-boxes"></i></i> Products</a></li>
        <li><a href="myOrders.php"><i class="fas fa-shopping-bag"></i> My Orders</a></li>
        <li class="current"><a href="contact.php"><i class="fas fa-phone-alt"></i> Contact Us</a></li>
      </ul>
    </div>
  </div>
  <!--Hidden Side Navigation Menu-->
  <div id="hiddenNavigationBar">
    <div id="close"><button id="closeButton" onclick="ClosehiddenMenu()">
        <i class="fas fa-times"></i>
      </button></div>
    <ul>
      <li class="current"><a href="index.php"><i class="fas fa-home fa-sm"></i> Home</a></li>
      <li><a href="categoriesList.php"><i class="fas fa-clipboard-list"></i> Categories</a></li>
      <li><a href="brandsList.php"><i class="fas fa-star"></i> Brands</a></li>
      <li><a href="products.php"><i class="fas fa-boxes"></i></i> Products</a></li>
      <li><a href="#myOrders"><i class="fas fa-shopping-bag"></i> My Orders</a></li>
      <li class="current"><a href="contact.php"><i class="fas fa-phone-alt"></i> Contact Us</a></li>
    </ul>
  </div>
  <!--Contact Us----->
  <?php echo $alert; ?>
  <section class="contact">
    <div class="content">
      <h2>Contact Us</h2>
      <h3>My Mart - The Ultimate Solution</h3>
      <p>Collection by My Mart. Easy way to buy grocery online and save time and money.There are many grocery apps are available today! that offers many superstores in your smartphone under your thumb </p>
    </div>
    <div class="container">
      <div class="contactInfo">
        <div class="box">
          <div class="text">
            <h3>Address</h3>
            <p>4671 Main Bin Qasim Road,<br>Karachi,Pakistan,<br>55060</p>
          </div>
        </div>
        <div class="box">
          <div class="text">
            <h3>Phone</h3>
            <p>507-475-6094</p>
            <p>654-215-9852</p>
          </div>
        </div>
        <div class="box">
          <div class="text">
            <h3>Email</h3>
            <p>siddiquiyaminah2@gmail.com</p>
            <p>bushraghaffar33@gmail.com</p>
          </div>
        </div>
      </div>
      <div class="col-2">
        <div class="form-container">
          <div class="form-btn">
            <span>Send Message</span>
          </div>
          <form method="post">
            <input type="text" placeholder="Username" name="username">
            <input type="email" placeholder="Email" name="email" required>
            <textarea name="msg" placeholder="Type a Message"></textarea>
            <button type="submit" class="btn" name="submit">SEND</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!---footer----->
  <div id="footer">
    <div class="footerBox">
      <h3 class="footerBoxHeading">Brands</h3>
      <ul id="brandsList">
        <li>Nescafe</li>
        <li>National Foods</li>
        <li>Dawn</li>
        <li>Nestle</li>
        <li>Pepsi</li>
        <li>Shan Foods</li>
        <li>Olper</li>
        <li>Rafhan</li>
        <li>Bake Parlor</li>
        <li>Uniliver</li>
      </ul>
    </div>
    <div class="footerBox">
      <h3 class="footerBoxHeading">Contact Us</h3>
      <ul>
        <li class="footerContainer">
          <a class="footerLink" href="mailto:siddiquiyaminah2@gmail.com? subject=Mart Customer Email">
            <div class="footerImageContainer"><img src="CHPImages\mail.png" alt="email Icon"></div>
            <p class="linkText">siddiquiyaminah2@gmail.com</p>
          </a>
        </li>
        <li class="footerContainer">
          <a class="footerLink" href="mailto:bushraghaffar33@gmail.com? subject=Mart Customer Email">
            <div class="footerImageContainer"><img src="CHPImages\mail.png" alt="email Icon"></div>
            <p class="linkText">bushraghaffar33@gmail.com</p>
          </a>
        </li>
        <li class="footerContainer">
          <a class="footerLink" href="tel:+923317665690">
            <div class="footerImageContainer"><img src="CHPImages\contact.png" alt="phone icon"></div>
            <p class="linkText">+923317665690</p>
          </a>
        </li>
        <li class="footerContainer">
          <a class="footerLink" href="tel:+923317665690">
            <div class="footerImageContainer"><img src="CHPImages\contact.png" alt="phone icon"></div>
            <p class="linkText">+923317235690</p>
          </a>
        </li>
      </ul>
    </div>
    <div class="footerBox">
      <h3 class="footerBoxHeading">Follow Us</h3>
      <ul>
        <li id="followUsList">
          <a href="#">
            <div class="footerImageContainer"><img src="CHPImages\fb.png" alt="facebook icon"></div>
          </a>
          <a href="#">
            <div class="footerImageContainer"><img src="CHPImages\insta.png" alt="instagram icon"></div>
          </a>
          <a href="#">
            <div class="footerImageContainer"><img src="CHPImages\twitter.png" alt="twitter icon"></div>
          </a>
        </li>
        <li id="logoInFooter">
          <div id="logoFooterImg">
            <img src="CHPImages\title.png" alt="Mart">
          </div>
          <h1 class="pageTitleHeading">Mart</h1>
        </li>
        <li id="websiteMotto">Shop from Home!</li>
      </ul>
    </div>
  </div>
  <!--Bottom Most Pane-->
  <div id="bottomPane">
    <ul>
      <li class="bottomItems"><a href="#">Privacy Policy</a></li>
      <li class="bottomItems">&copy; 2021 My Mart.com</li>
      <li class="bottomItems"><a href="#">License & Agreement</a></li>
      <li class="bottomItems"><a href="#">About Us</a></li>
    </ul>
  </div>
  <?php
  //Import PHPMailer classes into the global namespace
  //These must be at the top of your script, not inside a function
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  require('PHPMailer/Exception.php');
  require('PHPMailer/SMTP.php');
  require('PHPMailer/PHPMailer.php');

  if (isset($_POST['submit'])) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $message = $_POST['msg'];

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
      //Server settings

      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'mymart248@gmail.com';                     //SMTP username
      $mail->Password   = 'shoppingsite&21';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
      $mail->Port       = 587;
      //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom('mymart248@gmail.com', 'My Mart');
      $mail->addAddress('mymart248@gmail.com');     //Add a recipient

      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'My Mart - Contact Us';
      $mail->Body    = "Name : $name <br>Email : $email <br>Message : $message";

      $mail->send();
    } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }
  ?>
</body>
<script src="JavaScript\CHP.js">
</script>

</html>