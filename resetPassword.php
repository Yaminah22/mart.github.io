<!doctype html>
<html lang="en">

<head>
    <meta name="description" content="Online Grocery Store" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" charset="utf-8">
    <meta name="HandheldFriendly" content="true">
    <link rel="stylesheet" href="CSS\resetPassword.css">
    <link rel="icon" href="CHPImages\logo.ico" type="image/x-icon">
    <title>Update Password</title>
</head>

<body>
    <?php
    require("connections.php");

    if (isset($_GET['email']) && isset($_GET['reset_code'])) {
        date_default_timezone_set('Asia/Karachi');
        $date = date("Y-m-d");
        $query = "SELECT * FROM `admin_accounts` WHERE admin_email='$_GET[email]' AND reset_code='$_GET[reset_code]' AND reset_code_expiry='$date'";
        $result = mysqli_query($con, $query);  #checking if the link is still valid
        if ($result) {
            #if query runs then   
            if (mysqli_num_rows($result) == 1) {
                #this means that link is not expired yet
                echo "
                <div class='reset'>
                    <h2 id='title'>Password Recovery</h2>
                    <form method='POST'>
                        <input type='password' name='password' id='passwordField' placeholder='Enter New Password' required>
                        <input type='hidden' name='email' value='$_GET[email]'>
                        <button type='submit' class='resetBtn' name='resetPassword' >Upadte Password</button>
                    </form>
                </div>
                ";
            } else {
                #the link is expired
                echo
                "<script>
                    alert('Sorry this link has expired!')
                    window.location.href='Admin_Login.php'
                </script>";
            }
        } else {
            #if the query does not run
            echo
            "<script>
                alert('Cannot Run Query')
                window.location.href='Admin_Login.php'
            </script>";
        }
    }
    ?>
    <?php
    #Changing password 
    if (isset($_POST['resetPassword'])) {
        $update = "UPDATE `admin_accounts` SET `admin_password`='$_POST[password]',`reset_code`=NULL,`reset_code_expiry`=NULL WHERE admin_email='$_POST[email]'";
        $run = mysqli_query($con, $update);
        if ($run) {
            echo "
                <script>
                    alert('Password Updated Successfully!')
                    window.location.href='Admin_Login.php'
                </script>
                ";
        } else {
            echo "<script>
                alert('Query Error')
                window.location.href='Admin_Login.php'
            </script>";
        }
    }

    ?>

</body>

</html>