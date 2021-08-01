<?php
	require("connections.php");
?>

<!doctype html>
<html lang="en">

<head>
    <meta name="description" content="Online Grocery Store" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" charset="utf-8">
    <meta name="HandheldFriendly" content="true">
    <link rel="stylesheet" href="CSS\stylingAdminLogin.css">
    <link rel="icon" href="CHPImages\logo.ico" type="image/x-icon">
    <title>Admin Login Panel</title>
</head>

<body>
        <div class="customer">
            <a href="customer_homePage.php">Switch to Customer</a>
        </div>
    <!--Creating login form-->
    <div id="adminLogin">
        <div id="logoContainer">
            <div id="logoImg">
                <img src="CHPImages\title.png" alt="Mart">
            </div>
            <h1 class="pageHeading">Mart</h1>
        </div>
        <div id="loginFormTitle">
            <p>Admin Login</p>
        </div>
        <form method="POST">
            <div class="formClass">
                <div class="inputField">
                    <div class="imgIcon">
                        <img src="AHPImages\user.ico" alt="">
                    </div>
                    <input type="text" placeholder="Admin Name" name="adminName" required>
                </div>
                <div class="inputField">
                    <div class="imgIcon">
                        <img src="AHPImages\password.ico" alt="">
                    </div>
                    <input type="password" placeholder="Password" name="adminPassword" required>
                </div>
            </div>
            <div class="btn">
                <button type="submit" name="signIn">Sign In</button>
            </div>
            <div class="forget">
                <a href="forgetPassword.php">Forgot Password?</a>
            </div>
        </form>
        
    </div>
    <?php
    if(isset($_POST['signIn']))
    {
       $query="SELECT * FROM `admin_accounts` WHERE admin_name='$_POST[adminName]' AND admin_password='$_POST[adminPassword]'";
       $result=mysqli_query($con,$query);
       if(mysqli_num_rows($result)==1)
       {
            session_start();
            $_SESSION['LoggedInAdminName']=$_POST['adminName'];
            header("location: AdminPanel.php");
       }
       else{
           echo "<script>alert('Incorrect Admin Name or Password!'); </script>";
       }
    }

?>
</body>

</html>