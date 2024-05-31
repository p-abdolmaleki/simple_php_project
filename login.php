<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php");
        exit();
    } else {
        $error_message = "نام کاربری یا رمز عبور اشتباه است";
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود</title>
    <style>
        @font-face {
            font-family: vazir;
            src: url(font/Vazir/Vazir-Medium-FD-WOL.ttf);
        }
        body {
            font-family: "Poppins", vazir;
            background-color: #c2f0c2; 
            color: #4b0082;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #4b0082; 
        }

        form {
            max-width: 300px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #4b0082; 
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #4b0082; 
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #800080; 
        }

        a {
            color: #800080; 
            text-decoration: none;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <h1>ورود</h1>
    <?php if(isset($error_message)): ?>
        <p><?= $error_message; ?></p>
    <?php endif; ?>
    <form method="post" action="login.php">
        <label>نام کاربری:</label><br>
        <input type="text" name="username" required><br>
        <label>رمز عبور:</label><br>
        <input type="password" name="password" required><br>
        <button type="submit">ورود</button>
    </form>
    <a href="register.php">ثبت نام</a> | <a href="index.php">بازگشت به صفحه اصلی</a>
</body>
</html>

