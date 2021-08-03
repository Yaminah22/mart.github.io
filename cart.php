<!DOCTYPE html>
<html>
<?php
require("connections.php");
session_start();
?>

<head>
  <title>Cart</title>
  <meta name="description" content="Online Grocery Store" />
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" ; charset="utf-8">
  <meta name="HandheldFriendly" content="true">
  <link rel="stylesheet" href="CSS\stylingCustomer_homePage.css">
  <link rel="stylesheet" href="CSS\cart.css">
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
      <li><a href="brandsList.php"><i class="fas fa-star"></i> Brands</a></li>
      <li><a href="products.php"><i class="fas fa-boxes"></i></i> Products</a></li>
      <li><a href="#myOrders"><i class="fas fa-shopping-bag"></i> My Orders</a></li>
      <li><a href="contact.php"><i class="fas fa-phone-alt"></i> Contact Us</a></li>
    </ul>
  </div>
  <div id="tableContainer">
    <h2>Cart</h2>

    <table class="styling">
      <thead>
        <tr>
          <th>No.</th>
          <th>Product Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
          <th></th>
        </tr>
      </thead>

      <tbody>
        <?php
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {

          foreach ($_SESSION['cart'] as $key => $value) {
            $n = $key + 1;
            echo "
                    <tr>
                        <td>$n</td>
                        <td>$value[Item_Name]</td>
                        <td>$value[Price]<input type='hidden' class='pPrice' value='$value[Price]'></td>
                        <form method='POST' action='manageCart.php'>
                            <input type='hidden' name='itemName' value='$value[Item_Name]'>
                            <td><input type='number' name='quantity' class='quantity' value='$value[Quantity]' min='1' onchange='this.form.submit()'></td>
                        </form>
                        <td class='ptotal'></td>
                        <td>
                        <form method='POST' action='manageCart.php'>
                            <input type='hidden' name='removeItem' value='$value[Item_Name]'>
                            <button type='submit' name='remove' class='remove_btn'>Remove</button>
                        </form>
                        </td>
                    </tr>
                    
                    ";
          }
        } else {
          echo " <tr>
                <td colspan='6'>Your Cart is Empty!</td>
                </tr>";
        }

        ?>

      </tbody>
    </table>
    <div id="checkout">
      <div class="total">
        <h4>Grand Total: <span id="gtotal"></span></h4>
      </div>
      <form action="purchase.php" method="POST">
        <div class="divs">
          <i class="fas fa-map-marked-alt fa-lg"></i>
          <input type="text" name="address" class="inputField" placeholder="Delivery Address" required autocomplete="off">
        </div>
        <div class="divs">
          <i class="fas fa-phone-square-alt fa-lg"></i>
          <input type="tel" name="contactNo" class="inputField" placeholder="Phone Number" required autocomplete="off" pattern="[0-5]{3}-[0-9]{7}">
          <br><br>
          <small>Number Format: 123-4512347</small>
        </div>
        <div class="payment">
          <h5>Payment Methods Available:</h5>
          <p>Cash On Delivery</p>
        </div>
        <div class="order">
          <button type="submit" name="place_order">Place Order</button>
        </div>
      </form>
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
  <script>
    /*Account Details Function*/
    var loginStatus = false;
    accountDetails();

    function accountDetails() {
      if (loginStatus == true) {

      } else {
        document.getElementById("account_dropdown").innerHTML = "Click Here to Login or Create Account!";
      }
    }


    /*Hidden Menu*/
    function OpenhiddenMenu() {
      document.getElementById("hiddenNavigationBar").style.display = "block";
    }

    function ClosehiddenMenu() {
      document.getElementById("hiddenNavigationBar").style.display = "none";
    }
    /*Open Close search bar on mouse click*/

    function openSearch() {
      document.getElementById("searchContainer").style.display = "block";
    }

    function closeSearch() {
      document.getElementById("searchContainer").style.display = "none";
    }
    /*price total function */
    var counter = 0;
    var total = document.getElementById("gtotal");
    var p = document.getElementsByClassName("pPrice");
    var q = document.getElementsByClassName("quantity");
    var t = document.getElementsByClassName("ptotal");

    function price() {
      counter = 0;
      for (var i = 0; i < p.length; i++) {
        t[i].innerText = (p[i].value) * (q[i].value);
        counter = counter + (p[i].value) * (q[i].value);
      }
      total.innerText = counter;
    }
    price();
  </script>
</body>


</html>