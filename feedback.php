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
    <title>View Feedback</title>
    <meta name="description" content="Online Grocery Store" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" charset="utf-8">
    <meta name="HandheldFriendly" content="true">
    <link rel="stylesheet" type="text/css" href="CSS\adminHomePage.css">
    <link rel="stylesheet" type="text/css" href="CSS\viewFeedback.css">
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
            <li><i class="fas fa-plus-square fa-sm"></i>
                Add Items
                <ul class="subList">
                    <li onclick="location.href='addProduct.php'; ">Product</li>
                    <li onclick="location.href='addBrand.php'; ">Brand</li>
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
            <li class="current" onclick="location.href='feedback.php'; "><i class="fas fa-comment fa-sm"></i>
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
        <!--Table for viewing feedback-->
        <h3 class="title">Feedback Record</h3>
            <div class='tableDiv'>
            <?php
    $query="SELECT * FROM `feedback`";
    $result=mysqli_query($con,$query);
    if($result)
    {
        echo "
            <table class='tb'>
            <tr id='firstRow'>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Feedback</th>
            </tr>";
        while($rows=mysqli_fetch_array($result,MYSQLI_ASSOC))
        {
            echo "<tr class='dataRows'>
                <td>$rows[order_ID]</td>
                <td>$rows[customer_name]</td>
                <td>$rows[text]</td>
                </tr>
                ";
        }
        echo "</table>";
    }
    else{
        echo "<script>alert('Cannot run Query')
            window.location.href='addAdmin.php';
            </script>";
    }
    
    ?>
            </div>
    </div>
    <?php
    if (isset($_POST['logout'])) {
        session_destroy();
        echo"<script>window.location.href='Admin_Login.php';</script>";

    }

    ?>

    
</body>

</html>