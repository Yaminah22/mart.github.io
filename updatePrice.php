<!DOCTYPE html>
<html>

<?php
require("connections.php");
session_start();
if (!isset($_SESSION['LoggedInAdminName'])) {
    header("location: Admin_Login.php");
}
#filling up the brands select box
$s = "SELECT * FROM `products`";
$product = mysqli_query($con, $s);
$option = "";
while ($rows = mysqli_fetch_array($product)) {
    $option = $option . "<option value='$rows[1]'>";
}
?>

<head>
    <title>Update Product Price</title>
    <meta name="description" content="Online Grocery Store" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" charset="utf-8">
    <meta name="HandheldFriendly" content="true">
    <link rel="stylesheet" type="text/css" href="CSS\adminHomePage.css">
    <link rel="stylesheet" type="text/css" href="CSS\updateProducts.css">
    <link rel="icon" href="CHPImages\logo.ico" type="image/x-icon">
    <script defer src="fontawesome/js/all.js"></script>
    <script src="https://use.fontawesome.com/92d2dff442.js"></script>

</head>

<body>
    <!--Dividing the whole page into two divs one will contain the fixed side panel and the other will have the content of the option selected from the side panel-->
    <div id="sidePanel">
        <ul id="sideNavList">
            <li>
                <i class="fas fa-home fa-sm" onclick="location.href='AdminPanel.php'; "></i>
                Dashboard
            </li>
            <li><i class="fas fa-plus-square fa-sm" onclick="location.href='addItems.php'"></i>
                Add Items
                <ul class="subList">
                    <li onclick="location.href='addProduct.php'; ">Product</li>
                    <li onclick="location.href='addBrand.php'; ">Brand</li>
                    <li onclick="location.href='addCategory.php'; ">Category</li>
                    <li onclick="location.href='addAds.php'; ">Ad</li>
                </ul>
            </li>
            <li class="current"><i class="fas fa-pen-square fa-sm"></i>
                Update Items
                <ul class="subList">
                    <li onclick="location.href='updateQuantity.php'; ">Quantity</li>
                    <li onclick="location.href='updatePrice.php'; ">Price</li>
                </ul>
            </li>
            <li><i class="fas fa-trash fa-sm"></i>
                Delete Items
                <ul class="subList">
                <li onclick="location.href='delete.php'; ">Product</li>
                    <li onclick="location.href='delete.php'; ">Brand</li>
                    <li onclick="location.href='delete.php'; ">Ads</li>
                    <li onclick="location.href='delete.php'; ">Customers</li>
                    <li onclick="location.href='delete.php'; ">Admin</li>
                </ul>
            </li>
            <li onclick="location.href='feedback.php'; "><i class="fas fa-comment fa-sm"></i>
                View Database</li>
            <li onclick="location.href='addAdmin.php'; ">
                <i class="fas fa-user-plus fa-sm"></i>
                Add Admin
            </li>
        </ul>
    </div>
    <div id="mainContainer">
        <!--Logo and Title-->
        <div id="container">
            <div id="logoContainer">
                <div id="logoImg">
                    <img src="CHPImages\title.png" alt="Mart">
                </div>
                <h1 class="pageHeading">Mart</h1>
            </div>
            <div id="iconContainer">
                <!--Home Icon-->
                <div class="icons">
                    <a href="./AdminPanel.php"><img src="AHPImages\dashboard.ico" alt="dashboard Icon"></a>
                </div>
                <!--Logout Icon-->
                <form method="POST">
                    <button name="logout">
                        <div class="icons">
                            <img src="AHPImages\logout.ico" alt="logout icon">
                        </div>
                    </button>
                </form>
            </div>
        </div>
        <div class="addDiv">
            <form method="POST" enctype="multipart/form-data">
                <h2 class="title">Update Product Price</h2>
                <input class="inputField" type="text" id="products" name="name" placeholder="Product Name" required>
                <datalist id="products">
                    <?php echo $option; ?>
                </datalist>
                <input class="inputField" type="number" name="price" placeholder="Product Price" required>
                <button type="submit" name="updateProduct" class="btn">Update Price</button>
            </form>
        </div>
    </div>
    <?php
    if (isset($_POST['logout'])) {
        session_destroy();
        echo "<script>window.location.href='Admin_Login.php';</script>";
    }
    if (isset($_POST['updateProduct'])) {
        $query = "SELECT * FROM `products` WHERE product_name='$_POST[name]'";
        $result = mysqli_query($con, $query);
        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $update = "UPDATE `products` SET `p_price`='$_POST[price]' WHERE `product_name`='$_POST[name]'";
                $run = mysqli_query($con, $update);
                if ($run) {
                    echo "<script>alert('Price Updated Successfully!')
                    window.location.href='updatePrice.php';
                    </script>";
                } else {
                    echo "<script>alert('Price Update Failed!')
                    window.location.href='updatePrice.php';
                    </script>";
                }
            } else {
                echo "<script>alert('Product Does not Exists!')
                    window.location.href='updatePrice.php';
                    </script>";
            }
        } else {
            echo "<script>alert('Cannot run Query')
                    window.location.href='updatePrice.php';
                    </script>";
        }
    }
    ?>
</body>

</html>