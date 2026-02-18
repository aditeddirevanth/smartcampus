<?php
include 'db_connect.php';

define("ADMIN_USERNAME", "admin");
define("ADMIN_PASSWORD", "Admin@123");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {

        setcookie("role", "admin", time() + 3600, "/");
        setcookie("user_id", "0", time() + 3600, "/");

        header("Location: home.php");
        exit;
    }
    $sql = "
        SELECT id, password, 'student' AS role FROM student_login WHERE Register_Number = ?
        UNION ALL
        SELECT id, password, 'faculty' AS role FROM faculty_login WHERE Register_Number = ?
    ";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if ($password === $row['password']) {

            setcookie("role", $row['role'], time() + 3600*24*30, "/");
            setcookie("user_id", $row['id'], time() + 3600*24*30, "/");

            header("Location: home.php");
            exit;
        }
    }

    echo "<script>alert('Invalid credentials');</script>";
}
?>






<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Login</title>
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

    .inp {
        width: 90%;
        padding: 12px 14px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        transition: border 0.3s, box-shadow 0.3s;
    }

    .inp:focus {
        border-color: #ffd700;
        box-shadow: 0 0 6px rgba(255, 215, 0, 0.4);
        outline: none;
    }

    .user-login-btn {
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

    .user-login-btn:hover {
        background: linear-gradient(135deg, #f9e65c, #ffd700);
        transform: translateY(-2px);
    }
    #a1 {
        display:flex;
        margin-top: 15px;
        margin-left:5px;
        text-decoration: none;
        font-size: 14px;
        color:red;
    }

    #a1:hover {
        text-decoration: underline;
    }

   #a2 {
        display:block;
        margin-top: 15px;
        text-decoration: none;
        font-size: 16px;
        color:#00c6ff;
    }

    #a2:hover {
        text-decoration: underline;
    }
/* =======================
   MOBILE RESPONSIVE CSS
   ======================= */

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
</head>
<body>
<form method="POST">
    <div class="login-box">
        <h1>User Login</h1>
        <input class="inp" type="mail" name="username" placeholder="Enter Registration Number" required>
        <input class="inp" type="password" name="password" placeholder="Enter password" required>
        <button type="submit" class="user-login-btn">Login</button>
        <a id="a1" href="forgot_password.php">Forgot password?</a>
        <a id="a2" href="signup.php">Create new account!</a>
    </div>
</form>
</body>
</html>