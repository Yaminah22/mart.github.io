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
    <title>Add Category</title>
    <meta name="description" content="Online Grocery Store" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" charset="utf-8">
    <meta name="HandheldFriendly" content="true">
    <link rel="stylesheet" type="text/css" href="CSS\adminHomePage.css">
    <link rel="stylesheet" type="text/css" href="CSS\addAds.css">
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
            <li class="current"><i class="fas fa-plus-square fa-sm" onclick="location.href='addItems.php'"></i>
                Add Items
                <ul class="subList">
                    <li onclick="location.href='addProduct.php'; ">Product</li>
                    <li onclick="location.href='addBrand.php'; ">Brand</li>
                    <li onclick="location.href='addCategory.php'; ">Category</li>
                    <li onclick="location.href='addAds.php'; ">Ad</li>
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
                </ul>
            </li>
            <li><i class="fas fa-check-square fa-sm"></i>
                Approve Orders</li>
            <li onclick="location.href='feedback.php'; "><i class="fas fa-comment fa-sm"></i>
                View Feedback</li>
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
        <!--Entry form-->
    <div id="register">
        <div class="addDiv">
            <h2 class="title">Add Category</h2>
            <form method="POST" enctype="multipart/form-data">
            <input class="inputField" type="text" name="name" placeholder="Enter Category Name" required>
            <label for="imageFile">Select Category Banner</label>
            <input type="file" name="image" id="imageFile" required accept=".png, .jpg, .jpeg">
            <button type="submit" name="addBtn" class="btn">Add Category</button>
            </form>    
        
    </div>
    </div>
    <?php
    if (isset($_POST['logout'])) {
        session_destroy();
        echo"<script>window.location.href='Admin_Login.php';</script>";
    }
    if(isset($_POST['addBtn']))
    {
        $query="SELECT * FROM `categories` WHERE `category_name`='$_POST[name]'";
        $result=mysqli_query($con,$query);
        if ($result)
        {
            if(mysqli_num_rows($result)>0)
            {
                echo "<script>alert('Category Already Exists!')
                    window.location.href='addCategory.php';
                    </script>";
            }
            else{
                $file=$_FILES['image']['name'];
                $add="INSERT INTO `categories`( `category_name`, `image_large`) VALUES ('$_POST[name]','$file')";
                $run=mysqli_query($con,$add);
                if($run){
                    if(move_uploaded_file($_FILES['image']['tmp_name'],"Categories/$file")){
                        echo "<script>alert('New Category - $_POST[name] - Added Successfully!')
                    window.location.href='addCategory.php';
                    </script>";
                    }
                    else{
                        echo "<script>alert('Category Registration Failed!')
                    window.location.href='addCategory.php';
                    </script>";
                    }
                }
            }
        }
        else{
            echo "<script>alert('Cannot run Query')
                    window.location.href='addCategory.php';
                    </script>";
        }
    }
    ?>
    </div>
        
</body>

</html>