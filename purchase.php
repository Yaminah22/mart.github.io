<?php
require("connections.php");
session_start();
if(mysqli_connect_error()){
echo"<script>
    alert('Cannot Connect to Database')
    window.location.href='cart.php';                
    </script>
    ";
    exit();
}

if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(isset($_POST['place_order']) && $_SESSION['logged_in']==true)
    {
        date_default_timezone_set('Asia/Karachi');
        $date=date("Y-m-d");
        $query="INSERT INTO `order_manager`(`username`, `delivery_address`, `delivery_pno`, `date`) VALUES ('$_SESSION[username]','$_POST[address]','$_POST[contactNo]','$date')";
        
        if(mysqli_query($con,$query))
        {
            $order_id=mysqli_insert_id($con);
            
            foreach($_SESSION['cart'] as $key=>$value )
            {
                $queryItems="INSERT INTO `user_orders`(`order_ID`, `product_name`, `price`, `quantity`) VALUES ('$order_id','$value[Item_Name]','$value[Price]','$value[Quantity]')";
                mysqli_query($con,$queryItems);

                #query for modifying stock of products
                $queryStock1="SELECT * FROM `products` WHERE `product_name`='$value[Item_Name]'";
                $run=mysqli_query($con,$queryStock1);
                if($run){
                $row=mysqli_fetch_assoc($run);
                $quantity=$row['p_quantity'];
                $quantity=$quantity-$value['Quantity'];
                $queryStock2="UPDATE `products` SET `p_quantity`='$quantity' WHERE `product_name`='$value[Item_Name]'";
                mysqli_query($con,$queryStock2);

            }
            unset($_SESSION['cart']);
            echo"<script>
                alert('Order Placed!')
                window.history.back();                
                </script>
                ";

           }
    }
    else{
            echo"<script>
                alert('Cannot Run Query')
                window.location.href='cart.php';                
                </script>
                ";
        }
    }
    else{
        echo"<script>
        window.location.href='CustomerLogin.php';                
        </script> ";
    }
}
