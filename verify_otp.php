<?php
session_start();

if (!isset($_SESSION['reset_user'])) {
    header("Location: forgot_password.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp = $_POST["otp"];

    if (time() > $_SESSION['otp_expire']) {

    echo "<script>alert('OTP expired!');window.location='forgot_password.php';</script>";
    exit;

} elseif (password_verify($otp, $_SESSION['otp'])) {

    // OTP verified successfully
    $_SESSION['otp_verified'] = true;

    echo "<script>alert('OTP Verified!');window.location='reset_password.php';</script>";
    exit;

} else {

    echo "<script>alert('Incorrect OTP!');</script>";
}

}
?>

<!DOCTYPE html>
<html>
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title></head>
<style>
    body {
       background: linear-gradient(135deg, #0b1a3d, #1f3c88);
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
<h2>Enter OTP</h2>
<input type="number" name="otp" placeholder="Enter OTP" required><br><br>
<button type="submit">Verify OTP</button>
</div>
</form>
</body>
</html>
