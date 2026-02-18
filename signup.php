<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $roll    = $_POST['roll'];
    $password = $_POST['password'];

    if (!preg_match('/^(?:\d{4}-\d{7}|\d{10}|\d{8})$/', $roll)) {
        echo "<script>alert('Invalid Registration Number format');</script>";
    } else {

        $stmt = $conn->prepare("INSERT INTO student_login (username, email, Register_Number, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $roll, $password);

        if ($stmt->execute()) {
            echo "<script> alert('Signup Successful!'); window.location='home.php'; </script>";
        } else {
            echo "<script>alert('Email or Registration Number already exists');</script>";
        }

        $stmt->close();
    } } 
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Signup</title>
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

    .signup-box {
        background: #fff;
        width: 100%;
        max-width: 340px;
        padding: 40px 30px;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        text-align: center;
        transition: transform 0.3s;
    }

    .signup-box:hover {
        transform: translateY(-5px);
    }

    .signup-box h1 {
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

    .user-signup-btn {
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

    .user-signup-btn:hover {
        background: linear-gradient(135deg, #f9e65c, #ffd700);
        transform: translateY(-2px);
    }
   a {
        display: block;
        margin-top: 15px;
        color: #00c6ff;
        text-decoration: none;
        font-size: 14px;
    }

    a:hover {
        text-decoration: underline;
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

</head>
<body>
<div class="signup-box">
  <h1>Create Account</h1>
  <form method="POST" onsubmit="return validateForm()">
    <input class="inp" type="text" name="username" placeholder="Enter name" required>
    <input class="inp" type="email" name="email" placeholder="Enter email" required>
    <input class="inp" type="text" name="roll" id="regno" placeholder="Registration Number" required>
    <input class="inp" type="password" name="password" placeholder="Create password" required>
    <button type="submit" class="user-signup-btn">Signup</button>
    <a href="login.php">Already have an account? Login</a>
  </form>
</div>

<script>
function validateForm() {
    const regno = document.getElementById("regno").value.trim();
    const pattern = /^(?:\d{4}-\d{7}|\d{10}|\d{8})$/;

    if (!pattern.test(regno)) {
        alert("Invalid Registration Number!\nExamples:\n2023-2402007\n232405019");
        return false;
    }
    return true;
}
</script>

</body>
</html>

