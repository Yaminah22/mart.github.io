<!DOCTYPE html>
<html>
<?php
    require("connections.php");
    session_start();
?>
<head>
  <title>My Orders</title>
  <meta name="description" content="Online Grocery Store" />
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" ; charset="utf-8">
  <meta name="HandheldFriendly" content="true">
  <link rel="stylesheet" href="CSS\stylingCustomer_homePage.css">
  <link rel="stylesheet" href="CSS\myOrders.css">
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
                if(isset($_SESSION['logged_in'])  && $_SESSION['logged_in']==true)
                {
                     echo"
                     <div  id='accountIcon'>
                     <img src='CHPImages\accountIcon.png'>
                     <div id='account_dropdown'>
                        $_SESSION[username] - <a href='logout.php'>LOGOUT</a>
                     </div>
                     </div>
                        ";
                 }
              else
                 {
                   echo"
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
            $count=0;
            if(isset($_SESSION['cart']))
            {
              $count=count($_SESSION['cart']);
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
        <li><a href="index.php"><i class="fas fa-home fa-sm" ></i> Home</a></li>
        <li><a href="categoriesList.php"><i class="fas fa-clipboard-list"></i> Categories</a></li>
        <li><a href="brandsList.php"><i class="fas fa-star"></i> Brands</a></li>
        <li><a href="products.php"><i class="fas fa-boxes"></i></i> Products</a></li>
        <li class=""><a href="myOrders.php"><i class="fas fa-shopping-bag"></i> My Orders</a></li>
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
      <li ><a href="index.php"><i class="fas fa-home fa-sm" ></i> Home</a></li>
      <li><a href="categoriesList.php"><i class="fas fa-clipboard-list"></i> Categories</a></li>
      <li><a href="brandsList.php"><i class="fas fa-star"></i> Brands</a></li>
      <li><a href="products.php"><i class="fas fa-boxes"></i></i> Products</a></li>
      <li class="current"><a href="#myOrders"><i class="fas fa-shopping-bag"></i> My Orders</a></li>
      <li><a href="contact.php"><i class="fas fa-phone-alt"></i> Contact Us</a></li>
    </ul>
  </div>
<!--Table to display order history-->
<div id='tableContainer'>
        <h3>My Order History</h3>
            <table class='tableLarge'>
                <thead>
                    <tr class="firstRow">
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Phone No.</th>
                        <th>Address</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php
                if(isset($_SESSION['username'])){
                $query = "SELECT * FROM `order_manager` WHERE `username`='$_SESSION[username]' ORDER BY `date` DESC";
                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result)>0) {
                    while ($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
                    {
                        $d=date("d-m-Y",strtotime($rows['date']));
                        echo" 
                            <tr>
                                <td>$rows[order_ID]</td>
                                <td>$d</td>
                                <td>$rows[delivery_pno]</td>
                                <td>$rows[delivery_address]</td>
                                <td class='click' onclick='displayTable($count)'>
                                <table class='tableSmall'>
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                ";
                                $query2= "SELECT * FROM `user_orders` WHERE `order_ID`='$rows[order_ID]'";
                                $run = mysqli_query($con, $query2);
                                while ($row = mysqli_fetch_array($run, MYSQLI_ASSOC)) 
                                {
                                echo"
                                    <tr>
                                        <td>$row[product_name]</td>
                                        <td>$row[price]</td>
                                        <td>$row[quantity]</td>
                                    </tr>
                                ";
                                }
                                echo"
                                    </tbody>
                                    </table>
                                    </td>
                            </tr>
                            ";
                    }
                } 
                else 
                {
                    echo"<tr>
                        <td colspan='6' text-align='center'>Your order history is empty!
                        <br>Place an order to view it here.</td>
                        </tr>";
                }
              }
              else{
                echo"<tr>
                <td colspan='6' text-align='center'>You are not Signed In<br>
                Sign In or Create Account to view Order History!</td>
                </tr>";
              }

                ?>
            </tbody>
        </table>
        
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
