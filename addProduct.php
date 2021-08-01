<!DOCTYPE html>
<html>

<?php
    require("connections.php");
    session_start();
    if (!isset($_SESSION['LoggedInAdminName'])) {
        header("location: Admin_Login.php");
    }
    #filling up the brands select box
    $s="SELECT * FROM `brands`";
    $brand=mysqli_query($con,$s);
    $option="";
    while($rows=mysqli_fetch_array($brand))
    {
        $option=$option."<option value='$rows[1]'>$rows[1]</option>";
    }
    #filling up the categories select box
    $x="SELECT * FROM `categories`";
    $c=mysqli_query($con,$x);
    $opt="";
    while($row2=mysqli_fetch_array($c))
    {
        $opt=$opt."<option value='$row2[1]'>$row2[1]</option>";
    }
?>

<head>
    <title>Add New Product</title>
    <meta name="description" content="Online Grocery Store" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" charset="utf-8">
    <meta name="HandheldFriendly" content="true">
    <link rel="stylesheet" type="text/css" href="CSS\adminHomePage.css">
    <link rel="stylesheet" type="text/css" href="CSS\addProduct.css">
    <link rel="icon" href="CHPImages\logo.ico" type="image/x-icon">
    <script defer src="fontawesome/js/all.js"></script>
    <script src="https://use.fontawesome.com/92d2dff442.js"></script>
    
</head>

<body>
    <!--Dividing the whole page into two divs one will contain the fixed side panel and the other will have the content of the option selected from the side panel-->
    <div id="sidePanel">
        <ul id="sideNavList">
            <li onclick="location.href='./AdminPanel.php'; ">
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
                    <li onclick="location.href='delete.php'; ">Ads</li>
                    <li onclick="location.href='delete.php'; ">Customers</li>
                    <li onclick="location.href='delete.php'; ">Admin</li>
                </ul>
                </ul>
            </li>
            <li><i class="fas fa-check-square fa-sm"></i>
                Approve Orders</li>
            <li onclick="location.href='feedback.php'; "><i class="fas fa-comment fa-sm"></i>
                View Feedback</li>
            <li  onclick="location.href='addAdmin.php'; ">
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
            <h2 class="title">Add Product</h2>
            <input class="inputField" type="text" name="name" placeholder="Product Name" required>
            <select name="category" class="selectField" required>
                <option value="" disabled selected>Product Category</option>
                <?php echo $opt;?>
            </select>
            <select name="brand" class="selectField" required>
                <option value="" disabled selected>Product Brand</option>
                <?php echo $option;?>
            </select>
            <input class="inputField" type="number" name="price" placeholder="Product Price" required>
            <input class="inputField" type="number" name="quantity" placeholder="Product Quantity" required>
            <label for="imageFile">Select Product Image</label>
            <input type="file" name="image" id="imageFile" required>
            <button type="submit" name="addProduct" class="btn">Add Product</button>
        </form>
            
        </div>
    </div>
    <?php
    if (isset($_POST['logout'])) {
        session_destroy();
        echo"<script>window.location.href='Admin_Login.php';</script>";
    }
    if(isset($_POST['addProduct']))
    {
        $query="SELECT * FROM `products` WHERE product_name='$_POST[name]'";
        $result=mysqli_query($con,$query);
        if ($result)
        {
            if(mysqli_num_rows($result)>0)
            {
                echo "<script>alert('Product Already Exists!')
                    window.location.href='addProduct.php';
                    </script>";
            }
            else{
                $file=$_FILES['image']['name'];
                $add="INSERT INTO `products`(`product_name`, `p_category`, `p_brand`, `p_price`, `p_quantity`, `p_image`) VALUES ('$_POST[name]','$_POST[category]','$_POST[brand]','$_POST[price]','$_POST[quantity]','$file')";
                $run=mysqli_query($con,$add);
                if($run){
                    if(move_uploaded_file($_FILES['image']['tmp_name'],"Products/$file")){
                        echo "<script>alert('New Product - $_POST[name] - Added Successfully!')
                    window.location.href='addProduct.php';
                    </script>";
                    }
                    else{
                        echo "<script>alert('Product Registration Failed!')
                    window.location.href='addProduct.php';
                    </script>";
                    }
                }
            }
        }
        else
        {
            echo "<script>alert('Cannot run Query')
                    window.location.href='addProduct.php';
                    </script>";
        }
    }
    ?>
</body>

</html>