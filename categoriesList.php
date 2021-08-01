<!DOCTYPE html>
<html>
<?php
    require("connections.php");
    session_start();
?>
<head>
  <title>Categories</title>
  <meta name="description" content="Online Grocery Store" />
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" ; charset="utf-8">
  <meta name="HandheldFriendly" content="true">
  <link rel="stylesheet" href="CSS\stylingCustomer_homePage.css">
  <link rel="stylesheet" href="CSS\categories.css">
  <link rel="icon" href="CHPImages\logo.ico" type="image/x-icon">
  <script defer src="fontawesome/js/all.js"></script>
  <script src="https://use.fontawesome.com/92d2dff442.js"></script>

</head>

<body>
  <!--Search Bar-->
  <!--This will only appear when search button is clicked-->
  <div id="searchContainer" class="opacBackground">
    <div id="searchCloseBtn" onclick="closeSearch()"><i class="fas fa-times"></i></div>
    <form class="searchBarContainer" action="" method="">
      <input class="searchBar" type="text" name="Search" placeholder="Search in Mart....">
      <button id="SearchButton"><img src="CHPImages\searchBarButton.png" /></button>
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
          <a href="./customer_homePage.html">
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
        <a href="./CustomerLogin.html" id="accountIcon">
          <img src="CHPImages\accountIcon.png">
          <div id="account_dropdown">
          Click Here to Login or Create Account
          </div>
        </a>
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
        <li ><a href="./customer_homePage.php"><i class="fas fa-home fa-sm" ></i> Home</a></li>
        <li class="current"><a href="categoriesList.php"><i class="fas fa-clipboard-list"></i> Categories</a></li>
        <li ><a href="brandsList.php"><i class="fas fa-star"></i> Brands</a></li>
        <li><a href="products.php"><i class="fas fa-boxes"></i></i> Products</a></li>
        <li><a href="#sales/discounts"><i class="fab fa-buffer"></i> Sales Offers</a></li>
        <li><a href="#myOrders"><i class="fas fa-shopping-bag"></i> My Orders</a></li>
        <li><a href="#help"><i class="far fa-calendar-check"></i> Checkout</a></li>
      </ul>
    </div>
  </div>
  <!--Hidden Side Navigation Menu-->
  <div id="hiddenNavigationBar">
    <div id="close"><button id="closeButton" onclick="ClosehiddenMenu()">
    <i class="fas fa-times"></i>
      </button></div>
    <ul>
      <li><a href="./customer_homePage.html"><i class="fas fa-home fa-sm" ></i> Home</a></li>
      <li class="current"><a href="categoriesList.php"><i class="fas fa-clipboard-list"></i> Categories</a></li>
      <li><a href="brandsList.php"><i class="fas fa-star"></i> Brands</a></li>
      <li><a href="products.php"><i class="fas fa-boxes"></i></i> Products</a></li>
      <li><a href="#sales/discounts"> <i class="fab fa-buffer"></i> Sales Offers</a></li>
      <li><a href="#myOrders"><i class="fas fa-shopping-bag"></i> My Orders</a></li>
      <li><a href="#help"><i class="far fa-calendar-check"></i> Checkout</a></li>
    </ul>
  </div>
  <div id="brandsContainer">
  <!--Categories-->
  <h2 class="level2Headings">Categories</h2>
  <div id="categories">
    <!--Brands List-->
    <div class="horizontal_list_container">
    <?php
    $query1="SELECT * FROM `categories` ORDER BY `category_name` ASC";
    $result1=mysqli_query($con,$query1);
    if($result1)
    {
      while($row1=mysqli_fetch_array($result1))
      {
        ?>
        <a href='categories.php?category=<?php echo $row1['category_name'];?>'>
      <div class="categoriesCards"> 
          <h4 class="categoryTitle"><?php echo $row1['category_name'];?></h4>
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
