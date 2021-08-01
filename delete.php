<!DOCTYPE html>
<html>

<?php
    require("connections.php");
    session_start();
    if (!isset($_SESSION['LoggedInAdminName'])) {
        header("location: Admin_Login.php");
    }
    #filling up the products autocomplete list
    $s="SELECT * FROM `products`";
    $product=mysqli_query($con,$s);
    $option="";
    while($rows=mysqli_fetch_array($product))
    {
        $option=$option."<option value='$rows[1]'>";
    }
    #filling up the brands autocomplete list
        $b="SELECT * FROM `brands`";
        $brand=mysqli_query($con,$b);
        $opt="";
        while($row=mysqli_fetch_array($brand))
        {
            $opt=$opt."<option value='$row[1]'>";
        }
?>

<head>
    <title>Delete Product & Brand</title>
    <meta name="description" content="Online Grocery Store" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" charset="utf-8">
    <meta name="HandheldFriendly" content="true">
    <link rel="stylesheet" type="text/css" href="CSS\adminHomePage.css">
    <link rel="stylesheet" type="text/css" href="CSS\delete.css">
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
            <li ><i class="fas fa-plus-square fa-sm"></i>
                Add Items
                <ul class="subList">
                    <li onclick="location.href='addProduct.php'; ">Product</li>
                    <li onclick="location.href='addBrand.php'; ">Brand</li>
                    <li onclick="location.href='addCategory.php'; ">Category</li>
                    <li onclick="location.href='addAds.php'; ">Ad</li>
                </ul>
            </li>
            <li ><i class="fas fa-pen-square fa-sm"></i>
                Update Items
                <ul class="subList">
                    <li onclick="location.href='updateQuantity.php'; ">Quantity</li>
                    <li onclick="location.href='updatePrice.php'; ">Price</li>
                </ul>
            </li>
            <li class="current"><i class="fas fa-trash fa-sm"></i>
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
        <div class="mainDiv">
        <!--Delete Product-->
        <div class="subDiv">
        <form method="POST" >
            <h2 class="title">Delete Product</h2>
            <input class="inputField" type="text" id="products" name="pname" placeholder="Product Name" required>
            <datalist id="products">
            <?php echo $option;?>
            </datalist>
            <button type="submit" name="deleteProduct" class="btn">Delete Product</button>
        </form>
        </div>
        <!--Delete Brand-->
        <div class="subDiv">
        <form method="POST" >
            <h2 class="title">Delete Brand</h2>
            <input class="inputField" type="text" id="brands" name="bname" placeholder="Brand Name" required>
            <datalist id="brands">
            <?php echo $opt;?>
            </datalist>
            <button type="submit" name="deleteBrand" class="btn">Delete Brand</button>
        </form>
        </div>
        <!--Delete Ad-->
        <div class="subDiv">
        <form method="POST" >
            <h2 class="title">Delete Advertisement</h2>
            <input class="inputField" type="text" name="ad_name" placeholder="Advertisement Name" required>
            <button type="submit" name="deleteAd" class="btn">Delete Ad</button>
        </form>
        </div>
        <!--Delete Customer-->
        <div class="subDiv">
        <form method="POST" >
            <h2 class="title">Delete Customer</h2>
            <input class="inputField" type="text" name="c_name" placeholder="Customer Name" required>
            <input class="inputField" type="email" name="c_email" placeholder="Customer Email" required>
            <button type="submit" name="deleteCustomer" class="btn">Delete Customer</button>
        </form>
        </div>
        <!--Delete Admin-->
        <div class="subDiv">
        <form method="POST" >
            <h2 class="title">Delete Admin</h2>
            <input class="inputField" type="text" name="a_name" placeholder="Admin Name" required>
            <input class="inputField" type="email" name="a_email" placeholder="Admin Email" required>
            <button type="submit" name="deleteAdmin" class="btn">Delete Admin</button>
        </form>
        </div>
    </div>

    <?php
    if (isset($_POST['logout'])) {
        session_destroy();
        echo"<script>window.location.href='Admin_Login.php';</script>";
    }
    #delete query for product
    if(isset($_POST['deleteProduct']))
    {
        $query="SELECT * FROM `products` WHERE product_name='$_POST[pname]'";
        $result=mysqli_query($con,$query);
        if ($result)
        {
            if(mysqli_num_rows($result)==1)
            {
                $pdelete="DELETE FROM `products` WHERE `product_name`='$_POST[pname]'";
                $p=mysqli_query($con,$pdelete);
                if($p){
                    echo "<script>alert('Product Deleted Successfully!')
                    window.location.href='delete.php';
                    </script>";
                }
                else{
                    echo "<script>alert('Product Deletion Failed!')
                    window.location.href='delete.php';
                    </script>";
                }
                    
            }
            else{
                echo "<script>alert('Product Does not Exists!')
                    window.location.href='delete.php';
                    </script>";
                
            }
        }
        else{
            echo "<script>alert('Cannot run Query')
                    window.location.href='delete.php';
                    </script>";
        }
    }
    #delete query for brand
    if(isset($_POST['deleteBrand']))
    {
        $query="SELECT * FROM `brands` WHERE brand_name='$_POST[bname]'";
        $result=mysqli_query($con,$query);
        if ($result)
        {
            if(mysqli_num_rows($result)==1)
            {
                $bdelete="DELETE FROM `brands` WHERE `brand_name`='$_POST[bname]'";
                $run=mysqli_query($con,$bdelete);
                if($run){
                    echo "<script>alert('Brand Deleted Successfully!')
                    window.location.href='delete.php';
                    </script>";
                }
                else{
                    echo "<script>alert('Brand Deletion Failed!')
                    window.location.href='delete.php';
                    </script>";
                }
                    
            }
            else{
                echo "<script>alert('Brand Does not Exists!')
                    window.location.href='delete.php';
                    </script>";
                
            }
        }
        else{
            echo "<script>alert('Cannot run Query')
                    window.location.href='delete.php';
                    </script>";
        }
    }
    #delete query for ads
    if(isset($_POST['deleteAd']))
    {
        $query="SELECT * FROM `ads` WHERE ad_name='$_POST[ad_name]'";
        $result=mysqli_query($con,$query);
        if ($result)
        {
            if(mysqli_num_rows($result)==1)
            {
                $bdelete="DELETE FROM `ads` WHERE `ad_name`='$_POST[ad_name]'";
                $run=mysqli_query($con,$bdelete);
                if($run){
                    echo "<script>alert('Advertisement Deleted Successfully!')
                    window.location.href='delete.php';
                    </script>";
                }
                else{
                    echo "<script>alert('Advertisement Deletion Failed!')
                    window.location.href='delete.php';
                    </script>";
                }
                    
            }
            else{
                echo "<script>alert('Advertisement Does not Exists!')
                    window.location.href='delete.php';
                    </script>";
                
            }
        }
        else{
            echo "<script>alert('Cannot run Query')
                    window.location.href='delete.php';
                    </script>";
        }
    }
    #delete query for customer
    if(isset($_POST['deleteCustomer']))
    {
        $query="SELECT * FROM `customers` WHERE customer_name='$_POST[c_name]' AND customer_email='$_POST[c_email]'";
        $result=mysqli_query($con,$query);
        if ($result)
        {
            if(mysqli_num_rows($result)==1)
            {
                $bdelete="DELETE FROM `customers` WHERE `customer_name`='$_POST[c_name]' AND customer_email='$_POST[c_email]' ";
                $run=mysqli_query($con,$bdelete);
                if($run){
                    echo "<script>alert('Customer Deleted Successfully!')
                    window.location.href='delete.php';
                    </script>";
                }
                else{
                    echo "<script>alert('Customer Deletion Failed!')
                    window.location.href='delete.php';
                    </script>";
                }
                    
            }
            else{
                echo "<script>alert('Customer Does not Exists!')
                    window.location.href='delete.php';
                    </script>";
                
            }
        }
        else{
            echo "<script>alert('Cannot run Query')
                    window.location.href='delete.php';
                    </script>";
        }
    }
    #delete query for admin
    if(isset($_POST['deleteAdmin']))
    {
        $query="SELECT * FROM `admin_accounts` WHERE admin_name='$_POST[a_name]' AND admin_email='$_POST[a_email]'";
        $result=mysqli_query($con,$query);
        if ($result)
        {
            if(mysqli_num_rows($result)==1)
            {
                $bdelete="DELETE FROM `admin_accounts` WHERE `admin_name`='$_POST[a_name]' AND admin_email='$_POST[a_email]' ";
                $run=mysqli_query($con,$bdelete);
                if($run){
                    echo "<script>alert('Admin Deleted Successfully!')
                    window.location.href='delete.php';
                    </script>";
                }
                else{
                    echo "<script>alert('Admin Deletion Failed!')
                    window.location.href='delete.php';
                    </script>";
                }
                    
            }
            else{
                echo "<script>alert('Admin Does not Exists!')
                    window.location.href='delete.php';
                    </script>";
                
            }
        }
        else{
            echo "<script>alert('Cannot run Query')
                    window.location.href='delete.php';
                    </script>";
        }
    }
    ?>
</body>

</html>