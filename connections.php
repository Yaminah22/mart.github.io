<?php
    $con=mysqli_connect("localhost","root","","grocerystore");
    if(mysqli_connect_error()){
        echo "Connection failed";
        exit();
    }
    
?>