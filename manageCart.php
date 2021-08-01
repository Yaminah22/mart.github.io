<?php
    require("connections.php");
    session_start();
    
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        if(isset($_POST['addToCart']))
        {
             if(isset($_SESSION['cart']))
             {
                $items=array_column($_SESSION['cart'],'Item_Name');
                if(in_array($_POST['hidden_name'],$items))
                {
                    echo "<script>
                    window.history.back();
                    </script>";
                }
                else
                {
                    $count=count($_SESSION['cart']);
                    $_SESSION['cart'][$count]=array(
                        'Item_Name'=>$_POST['hidden_name'],
                        'Price'=>$_POST['hidden_price'],
                        'Quantity'=>1
                    );
                    echo "<script>
                        window.history.back();
                        </script>";
                }
             
            }   
            else
             {
                $_SESSION['cart'][0]=array(
                    'Item_Name'=>$_POST['hidden_name'],
                    'Price'=>$_POST['hidden_price'],
                    'Quantity'=>1
                );
                echo "<script>
                window.history.back();
                    </script>";
             }
        }
        if(isset($_POST['remove']))
        {
           foreach($_SESSION['cart'] as $key=>$value)
           {
               if($value['Item_Name']==$_POST['removeItem'])
               {
                   unset($_SESSION['cart'][$key]);
                   $_SESSION['cart']=array_values($_SESSION['cart']);
                   if(count($_SESSION['cart'])==0)
                   {
                    echo "<script>
                    history.go(-2);
                    </script>";
                   }
                   else{
                    echo "<script>
                    window.history.back();
                    </script>";
                   }
                   
               }
           }
        }
        if (isset($_POST['quantity']))
        {
            foreach($_SESSION['cart'] as $key=>$value)
            {
                if($value['Item_Name']==$_POST['itemName'])
                {
                $_SESSION['cart'][$key]['Quantity']=$_POST['quantity'];
                echo "<script>
                    window.history.back();
                    </script>";
                }
            }
        }
    }
?>