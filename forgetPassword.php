<?php
require("connections.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $code)
{
    require("PHPMailer/PHPMailer.php");
    require("PHPMailer/SMTP.php");
    require("PHPMailer/Exception.php");
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'Abdulbasitsiddiqui16@gmail.com';                     //SMTP username
        $mail->Password   = 'iamapakistani11';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('Abdulbasitsiddiqui16@gmail.com', 'Mart');
        $mail->addAddress($email);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Password Reset Link From Mart';
        $mail->Body    = "
            Dear Valued Customer!<br>
            We received a password reset request from you. Here is the link to reset password:<br>
            <a href='http://localhost/Grocery web application/resetPassword.php?email=$email&reset_code=$code'>Reset Password</a><br>
            Kindly ignore this email if you did not make this request.<br>
            Note: This link is active for 24 hours only.<br>
            ";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta name="description" content="Online Grocery Store" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" charset="utf-8">
    <meta name="HandheldFriendly" content="true">
    <link rel="stylesheet" href="CSS\forgetPassword.css">
    <link rel="icon" href="CHPImages\logo.ico" type="image/x-icon">
    <title>Forget Password</title>
</head>

<body>
    <div class="reset">
        <h2 id="resetTitle">Reset Password</h2>
        <form method="POST">
            <input type="email" name="email" id="emailField" placeholder="Enter email to send reset link" required>
            <button type="submit" class="resetBtn" name="resetLink">Send Reset Link</button>
        </form>
    </div>

    <?php
    #when button is pressed
    if (isset($_POST['resetLink'])) {
        $query = "SELECT * FROM `admin_accounts` WHERE admin_email='$_POST[email]'";
        $result = mysqli_query($con, $query);

        #if query runs or not
        if ($result) {
            #if query runs then
            if (mysqli_num_rows($result) == 1) {
                #Check if the provided email is a registered email
                $reset_code = bin2hex(random_bytes(16));
                date_default_timezone_set('Asia/Karachi');
                $date = date("Y-m-d");
                $query = "UPDATE `admin_accounts` SET `reset_code`='$reset_code',`reset_code_expiry`='$date' WHERE admin_email='$_POST[email]'";
                if (mysqli_query($con, $query) && sendMail($_POST['email'], $reset_code)) {
                    #if query successfully runs
                    echo " <script>
                    alert('Password Reset Link Sent')
                    window.location.href='Admin_Login.php'
                    </script>
                    ";
                } else {
                    #if query does not run successfully
                    echo "<script>
                    alert('Cannot Run Query')
                    window.location.href='Admin_Login.php'
                    </script>
                    ";
                }
            } else {
                #if not registered
                echo "
            <script>
            alert('Unregistered Email Entered')
            window.location.href='Admin_Login.php'
            </script>
            ";
            }
        } else
        #if query does not run
        {
            echo "
            <script>
            alert('Cannot Run Query')
            window.location.href='Admin_Login.php'
            </script>
            ";
        }
    }
    ?>
</body>

</html>