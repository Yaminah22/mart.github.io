<!DOCTYPE html>
<html>
<?php
require("connections.php");
session_start();
?>

<head>
  <title>Brands</title>
  <meta name="description" content="Online Grocery Store" />
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" ; charset="utf-8">
  <meta name="HandheldFriendly" content="true">
  <link rel="stylesheet" href="CSS\stylingCustomer_homePage.css">
  <link rel="stylesheet" href="CSS\brands.css">
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
        <li class="current"><a href="brandsList.php"><i class="fas fa-star"></i> Brands</a></li>
        <li><a href="products.php"><i class="fas fa-boxes"></i></i> Products</a></li>
        <li><a href="myOrders.php"><i class="fas fa-shopping-bag"></i> My Orders</a></li>
        <li><a href="contact.php"><i class="fas fa-phone-alt"></i> Contact Us</a></li>
      </ul>
    </div>
  </div>
  <!--Hidden Side Navigation Menu-->
  <div id="hiddenNavigationBar">
    <div id="close"><button id="closeButton" onclick="ClosehiddenMenu()">
        <i class="fas fa-times"></i>
      </button></div>
    <ul>
      <li><a href="index.php"><i class="fas fa-home fa-sm"></i> Home</a></li>
      <li><a href="categoriesList.php"><i class="fas fa-clipboard-list"></i> Categories</a></li>
      <li class="current"><a href="brandsList.php"><i class="fas fa-star"></i> Brands</a></li>
      <li><a href="products.php"><i class="fas fa-boxes"></i></i> Products</a></li>
      <li><a href="#myOrders"><i class="fas fa-shopping-bag"></i> My Orders</a></li>
      <li><a href="contact.php"><i class="fas fa-phone-alt"></i> Contact Us</a></li>
    </ul>
  </div>
  <div id="brandsContainer">
    <!--Brands-->
    <h2 class="level2Headings">Brands</h2>
    <div id="brands">
      <!--Brands List-->
      <div class="horizontal_list_container">
        <?php
        $query1 = "SELECT * FROM `brands` ORDER BY `brand_name` ASC";
        $result1 = mysqli_query($con, $query1);
        if ($result1) {
          while ($row1 = mysqli_fetch_array($result1)) {

        ?>
            <a href='brands.php?brand=<?php echo $row1['brand_name']; ?>'>
              <div class="brandCards">
                <div class="cardImages">
                  <?php echo "<img src='Brands/" . $row1['brand_image'] . "' alt=' $row1[brand_name]'>"; ?>
                </div>
                <h4 class="brandsTitle"><?php echo $row1['brand_name']; ?></h4>
              </div>
            </a>
        <?php
          }
        }
        ?>
      </div>
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
</body>
<script src="JavaScript\CHP.js">
</script>

</html>