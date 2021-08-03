<!DOCTYPE html>
<html>
<?php
require("connections.php");
session_start();
?>

<head>
  <title>Mart Home</title>
  <meta name="description" content="Online Grocery Store" />
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" ; charset="utf-8">
  <meta name="HandheldFriendly" content="true">
  <link rel="stylesheet" href="CSS\stylingCustomer_homePage.css">
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
        <li class="current"><a href="index.php"><i class="fas fa-home fa-sm"></i> Home</a></li>
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
      <li class="current"><a href="index.php"><i class="fas fa-home fa-sm"></i> Home</a></li>
      <li><a href="categoriesList.php"><i class="fas fa-clipboard-list"></i> Categories</a></li>
      <li><a href="brandsList.php"><i class="fas fa-star"></i> Brands</a></li>
      <li><a href="products.php"><i class="fas fa-boxes"></i></i> Products</a></li>
      <li><a href="#myOrders"><i class="fas fa-shopping-bag"></i> My Orders</a></li>
      <li><a href="contact.php"><i class="fas fa-phone-alt"></i> Contact Us</a></li>
    </ul>
  </div>

  <!--Categories Side Navigation-->
  <div id="mainContainer">
    <div class="categories_navigation">
      <h3>Categories</h3>
      <ul id="mainList">
        <?php
        $query1 = "SELECT * FROM `categories` ORDER BY `category_name` ASC";
        $result1 = mysqli_query($con, $query1);
        if ($result1) {
          while ($row1 = mysqli_fetch_array($result1)) {
        ?>
            <li onclick="location.href='categories.php?category=<?php echo $row1['category_name']; ?>'; "><?php echo $row1['category_name']; ?></li>
        <?php
          }
        }
        ?>

      </ul>
    </div>
    <!--Sales/Discounts' slide show -->
    <div class="slidesAndDots">
      <div class="slide_container">
        <?php
        $query_slides = "SELECT * FROM `ads` ORDER BY `ad_id` ASC LIMIT 5";
        $slides_result = mysqli_query($con, $query_slides);
        if ($slides_result) {
          while ($slides = mysqli_fetch_array($slides_result)) {
            echo "
            <div class='image_container fade'>
            <img src='Ads/" . $slides['ad_image'] . "'class='slider_image'>
          </div>
            ";
          }
        }
        ?>

      </div>
      <div id="dotContainer">
        <span class="dot">.</span>
        <span class="dot">.</span>
        <span class="dot">.</span>
        <span class="dot">.</span>
        <span class="dot">.</span>
      </div>
    </div>

  </div>

  <!--All Products-->
  <h2 class="level2Headings">Products</h2>
  <div id="products">
    <!--Products list-->
    <div class="horizontal_list_container">
      <?php
      $query = "SELECT * FROM `products` ORDER BY `product_name` ASC LIMIT 4";
      $result = mysqli_query($con, $query);
      if ($result) {
        while ($row = mysqli_fetch_array($result)) {
          if ($row['p_quantity'] > 0) {
            $availability = "In Stock";
          } else {
            $availability = "Out of Stock";
          }
      ?>
          <form method="POST" action="manageCart.php">
            <div class="box">
              <div class="small-img">
                <?php echo "<img src='Products/" . $row['p_image'] . "' alt=' $row[product_name]'>"; ?>
                <div class="overlay">
                  <button type="submit" name="addToCart" class="buy-btn">Add To Cart</button>
                </div>
              </div>
              <div class="detail-box">
                <div class="type">
                  <p><?php echo "$row[product_name]"; ?></p>
                  <span><?php echo $availability; ?></span>
                </div>
                <p class="price1">Rs.<?php echo $row['p_price']; ?></p>
                <input type="hidden" name="hidden_name" value="<?php echo $row['product_name']; ?>">
                <input type="hidden" name="hidden_price" value="<?php echo $row['p_price']; ?>">

              </div>
            </div>
          </form>
      <?php
        }
      }
      ?>
    </div>


  </div>
  <!--Brands-->
  <h2 class="level2Headings" onclick="location.href='brandsList.php'; ">Brands</h2>
  <div id="brands">
    <!--Brands List-->
    <div class="horizontal_list_container">
      <?php
      $query1 = "SELECT * FROM `brands` ORDER BY `brand_name` ASC LIMIT 5";
      $result1 = mysqli_query($con, $query1);
      if ($result1) {
        while ($row1 = mysqli_fetch_array($result1)) {

      ?>
          <div class="brandCards">
            <a href='brands.php?brand=<?php echo $row1['brand_name']; ?>'>
              <div class="cardImages">
                <?php echo "<img src='Brands/" . $row1['brand_image'] . "' alt=' $row1[brand_name]'>"; ?>
              </div>
              <h4 class="brandsTitle"><?php echo $row1['brand_name']; ?></h4>
            </a>
          </div>
      <?php
        }
      }
      ?>
    </div>
  </div>
  <!--Categories Cards-->
  <h2 class="level2Headings">Categories</h2>
  <div id="categoriesCards">
    <div class="categoriesCard">
      <div class="categoriesCardImage">
        <img src="CHPImages\bakery.png" alt="Bakery">
      </div>
      <p class="cardNames">Bakery</p>
      <ul>
        <li class="categoriesItems"><a href="categories.php?category=Fresh Bread">fresh breads</a></li>
        <li class="categoriesItems"><a href="categories.php?category=Pastries">pastries</a></li>
        <li class="categoriesItems"><a href="categories.php?category=Buns">buns</a></li>
      </ul>
    </div>
    <div class="categoriesCard">
      <div class="categoriesCardImage">
        <img src="CHPImages\Can.png" alt="Canned Goods">
      </div>
      <p class="cardNames">Canned Goods</p>
      <ul>
        <li class="categoriesItems"><a href="categories.php?category=Soups">soups</a></li>
        <li class="categoriesItems"><a href="categories.php?category=Canned Fruits">Canned Fruits</a></li>
        <li class="categoriesItems"><a href="categories.php?category=Dry Fruits">Dry Fruits</a></li>
      </ul>
    </div>
    <div class="categoriesCard">
      <div class="categoriesCardImage">
        <img src="CHPImages\dairy.png" alt="Dairy Products">
      </div>
      <p class="cardNames">Dairy Products</p>
      <ul>
        <li class="categoriesItems"><a href="categories.php?category=Eggs">Eggs</a></li>
        <li class="categoriesItems"><a href="categories.php?category=Cheese">Cheese</a></li>
        <li class="categoriesItems"><a href="categories.php?category=Milk">Milk</a></li>
      </ul>
    </div>
    <div class="categoriesCard">
      <div class="categoriesCardImage">
        <img src="CHPImages\snacks.png" alt="Snacks">
      </div>
      <p class="cardNames">Snacks</p>
      <ul>
        <li class="categoriesItems"><a href="categories.php?category=Cookies">Cookies</a></li>
        <li class="categoriesItems"><a href="categories.php?category=Crackers">Crackers</a></li>
        <li class="categoriesItems"><a href="categories.php?category=Chips">Chips</a></li>
      </ul>
    </div>
    <div class="categoriesCard">
      <div class="categoriesCardImage">
        <img src="CHPImages\fresh.png" alt="Fresh Produces">
      </div>
      <p class="cardNames">Fresh Produces</p>
      <ul>
        <li class="categoriesItems"><a href="categories.php?category=Vegetables">Vegetables</a></li>
        <li class="categoriesItems"><a href="categories.php?category=Fruits">Fruits</a></li>
      </ul>
    </div>
    <div class="categoriesCard">
      <div class="categoriesCardImage">
        <img src="CHPImages\meat.png" alt="Meat & Seafood">
      </div>
      <p class="cardNames">Meat & Fish</p>
      <ul>
        <li class="categoriesItems"><a href="categories.php?category=Chicken">Chicken</a></li>
        <li class="categoriesItems"><a href="categories.php?category=Mutton">Mutton</a></li>
        <li class="categoriesItems"><a href="categories.php?category=Fish">Fish</a></li>
      </ul>
    </div>
    <div class="categoriesCard">
      <div class="categoriesCardImage">
        <img src="CHPImages\beverages.png" alt="Beverages">
      </div>
      <p class="cardNames">Beverages</p>
      <ul>
        <li class="categoriesItems"><a href="categories.php?category=Juices">Juices</a></li>
        <li class="categoriesItems"><a href="categories.php?category=Carbonated Drinks">Carbonated Drinks</a></li>
        <li class="categoriesItems"><a href="categories.php?category=Energy Drinks">Energy Drinks</a></li>
      </ul>
    </div>
    <div class="categoriesCard">
      <div class="categoriesCardImage">
        <img src="CHPImages\frozen.png" alt="Frozen Food">
      </div>
      <p class="cardNames">Frozen Products</p>
      <ul>
        <li class="categoriesItems"><a href="categories.php?category=Ice Cream">Ice Cream</a></li>
        <li class="categoriesItems"><a href="categories.php?category=Half Cooked">Half Cooked</a></li>
      </ul>
    </div>
    <div class="categoriesCard">
      <div class="categoriesCardImage">
        <img src="CHPImages\g+p.png" alt="Grains and Pasta">
      </div>
      <p class="cardNames">Other</p>
      <ul>
        <li class="categoriesItems"><a href="categories.php?category=Grains">Grains</a></li>
        <li class="categoriesItems"><a href="categories.php?category=Pasta">Pasta</a></li>
        <li class="categoriesItems"><a href="categories.php?category=Sauces and Spices">Sauces & Spices</a></li>
      </ul>
    </div>
  </div>
  <!--Footer-->
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
</body>
<script src="JavaScript\CHP.js">
</script>

</html>