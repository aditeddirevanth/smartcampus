<?php
session_start();
include "db_connect.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/phpmailer/src/Exception.php';
require __DIR__ . '/phpmailer/src/PHPMailer.php';
require __DIR__ . '/phpmailer/src/SMTP.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
$stmt = $conn->prepare("
    SELECT username, email FROM student_login WHERE email=? OR Register_Number=?
    UNION ALL
    SELECT username, email FROM faculty_login WHERE email=? OR Register_Number=?
    LIMIT 1
");
$stmt->bind_param("ssss", $username, $username, $username, $username);
$stmt->execute();
$result = $stmt->get_result();



    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name  = $row['username'];
        // Generate OTP
        $otp = rand(100000, 999999);

        // Store in session
        $_SESSION['reset_user'] = $username;
        $_SESSION['otp'] = $otp;
        $_SESSION['otp_expire'] = time() + 300; // 5 minutes

        // Send OTP Mail
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'aditeddirevanth@gmail.com';   
            $mail->Password   = 'qoxk hvzc hqvy acyn';     // Gmail App Password
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            $mail->setFrom('aditeddirevanth@gmail.com', 'Shanvi Collections');
            $mail->addAddress($row['email']);

            $mail->isHTML(true);
            $mail->Subject = "Your OTP for Password Reset";
            $mail->Body    = "

                <div style='font-family: Arial, sans-serif; line-height:1.6;'>
                    <h2>Hello $name,</h2>

                    <p>We received a request to reset the password for your account.</p>

                    <p>Please use the One-Time Password (OTP) below:</p>

                    <h2 style='color:#0a2351;'>$otp</h2>

                    <p style='color:red;'>For your security, please do not share this OTP with anyone.</p>

                    <p>If you did not request a password reset, please ignore this email or contact our support team immediately.</p>

                    <br>
                    <p><b><big>Thank you,</big></b><br>
                    Shanvi Collections<br>
                    Support Team</p>
                </div>
            ";


            $mail->send();
            echo "<script>alert('OTP sent to email!');window.location='verify_otp.php';</script>";

        } catch (Exception $e) {
            echo "<script>alert('Error sending OTP! Try again.');</script>";
        }

    } else {
        echo "<script>alert('User not found!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Forgot Password</title></head>
<style>
    body {
        background: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 10px;
        font-family: "Segoe UI", sans-serif;
    }

    .login-box {
        background: #fff;
        width: 100%;
        max-width: 340px;
        padding: 40px 30px;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        text-align: center;
        transition: transform 0.3s;
    }

    .login-box:hover {
        transform: translateY(-5px);
    }

    .login-box h1 {
        font-size: 28px;
        color: #0a2351;
        margin-bottom: 25px;
        font-weight: 600;
    }

    input {
        width: 90%;
        padding: 12px 14px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        transition: border 0.3s, box-shadow 0.3s;
    }

    input:focus {
        border-color: #ffd700;
        box-shadow: 0 0 6px rgba(255, 215, 0, 0.4);
        outline: none;
    }

    button {
        width: 90%;
        padding: 12px 14px;
        background: linear-gradient(135deg, #ffd700, #f2c200);
        color: #0a2351;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        margin-top: 15px;
        cursor: pointer;
        transition: background 0.3s, transform 0.3s;
    }

    button:hover {
        background: linear-gradient(135deg, #f9e65c, #ffd700);
        transform: translateY(-2px);
    }
@media (max-width: 768px) {

    body {
        padding: 0;
        align-items: flex-start;
    }

    .login-box {
        width: 95%;
        max-width: 360px;
        padding: 30px 20px;
        margin-top: 40px;
        border-radius: 14px;
    }

    .login-box h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .inp {
        width: 90%;
        font-size: 14px;
        padding: 12px;
    }

    .user-login-btn {
        width: 90%;
        font-size: 15px;
        padding: 12px;
    }

    #a1, #a2 {
        font-size: 14px;
        text-align: center;
        margin-left: 0;
    }
}

/* Extra small devices (phones under 400px) */
@media (max-width: 400px) {

    .login-box {
        padding: 25px 16px;
    }

    .login-box h1 {
        font-size: 22px;
    }
}



</style>
<body>
<form method="POST">
<div class="login-box">
<h2>Forgot Password</h2>
<input type="text" name="username" placeholder="Enter email or Register Number" required><br><br>
<button type="submit">Send OTP</button>
</div>
</form>
</body>
</html>
