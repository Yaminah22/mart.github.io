<!DOCTYPE html>
<html>

<?php
require("connections.php");
session_start();
if (!isset($_SESSION['LoggedInAdminName'])) {
    header("location: Admin_Login.php");
}
?>

<head>
    <title>Add New Admin</title>
    <meta name="description" content="Online Grocery Store" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" charset="utf-8">
    <meta name="HandheldFriendly" content="true">
    <link rel="stylesheet" type="text/css" href="CSS\adminHomePage.css">
    <link rel="stylesheet" type="text/css" href="CSS\addAdmin.css">
    <link rel="icon" href="CHPImages\logo.ico" type="image/x-icon">
    <script defer src="fontawesome/js/all.js"></script>
    <script src="https://use.fontawesome.com/92d2dff442.js"></script>

</head>

<body>
    <!--Dividing the whole page into two divs one will contain the fixed side panel and the other will have the content of the option selected from the side panel-->
    <div id="sidePanel">
        <ul id="sideNavList">
            <li onclick="location.href='AdminPanel.php'; ">
                <i class="fas fa-home fa-sm"></i>
                Dashboard
            </li>
            <li><i class="fas fa-plus-square fa-sm"></i>
                Add Items
                <ul class="subList">
                    <li onclick="location.href='addProduct.php'; ">Product</li>
                    <li onclick="location.href='addBrand.php'; ">Brand</li>
                    <li onclick="location.href='addCategory.php'; ">Category</li>
                    <li onclick="location.href='addAds.php'; ">Advertisement</li>
                </ul>
            </li>
            <li><i class="fas fa-pen-square fa-sm"></i>
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
                    <li onclick="location.href='delete.php'; ">Advertisement</li>
                    <li onclick="location.href='delete.php'; ">Customers</li>
                    <li onclick="location.href='delete.php'; ">Admin</li>
                </ul>
            </li>
            <li><i class="fas fa-database fa-sm"></i>
                View Database
                <ul class="subList">
                    <li onclick="location.href='productsDB.php'; ">Product</li>
                    <li onclick="location.href='brandsDB.php'; ">Brand</li>
                    <li onclick="location.href='adsDB.php'; ">Advertisement</li>
                    <li onclick="location.href='categoriesDB.php'; ">Category</li>
                    <li onclick="location.href='customersDB.php'; ">Customer</li>
                    <li onclick="location.href='adminsDB.php'; ">Admin</li>
                    <li onclick="location.href='ordersDB.php'; ">Order</li>

                </ul>
            </li>
            <li class="current" onclick="location.href='addAdmin.php'; ">
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
        <!--Register form-->
        <div id="register">
            <h2 id="title">Admin Sign Up</h2>
            <form method="POST">
                <input class="inputField" type="text" name="name" placeholder="Admin Name" required>
                <input class="inputField" type="email" name="email" placeholder="Email" required>
                <input class="inputField" type="password" name="password" placeholder="Password" required>
                <button class="btn" name="signUp" type="submit">Register</button>
            </form>

        </div>
    </div>
    </div>
    <?php
    if (isset($_POST['logout'])) {
        session_destroy();
        echo "<script>window.location.href='Admin_Login.php';</script>";
    }
    ?>

    <?php

    if (isset($_POST['signUp'])) {
        $user_exist_query = "SELECT * FROM `admin_accounts` WHERE admin_name='$_POST[name]' or admin_email='$_POST[email]'";
        $result = mysqli_query($con, $user_exist_query);
        if ($result) {
            #if any user with same name or email already exist
            if (mysqli_num_rows($result) > 0) {
                $result_fetch = mysqli_fetch_assoc($result);
                #if name already exists
                if ($result_fetch['admin_name'] == $_POST['name']) {
                    echo "<script>alert('$result_fetch[admin_name] - Name Already In Use!')
                    window.location.href='addAdmin.php';
                    </script>";
                }
                #if email already exist
                else {
                    echo "<script>alert('$result_fetch[admin_email] - Email Already In Use!')
                    window.location.href='addAdmin.php';
                    </script>";
                }
            }
            #if the entry is not repititive and can be inserted in database
            else {
                $query = "INSERT INTO `admin_accounts`(`admin_name`, `admin_password`, `admin_email`) VALUES ('$_POST[name]','$_POST[password]','$_POST[email]')";
                if (mysqli_query($con, $query)) {
                    #when registration is successful
                    echo "<script>alert('Sign Up Successful!')
                    window.location.href='addAdmin.php';
                    </script>";
                } else {
                    #when its not successful
                    echo "<script>alert('Cannot run Query')
                    window.location.href='addAdmin.php';
                    </script>";
                }
            }
        } else {
            echo "<script>alert('Cannot run Query')
        window.location.href='addAdmin.php';
        </script>";
        }
    }
    ?>
</body>

</html>