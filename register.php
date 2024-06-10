<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error_message = "رمز عبور و تأیید آن با هم مطابقت ندارند";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit();
        } else {
            $error_message = "خطا در ثبت نام";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام</title>
    <?php include 'header.php'; ?>
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
            padding: 10px 0px ;
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
        header, footer {
            background-color: #D9D9D9;
            color: purple;
            text-align: center;
            padding: 10px 0;
        }

        nav a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>ثبت نام</h1>
    <?php if(isset($error_message)): ?>
        <p><?= $error_message; ?></p>
    <?php endif; ?>
    <form method="post" action="register.php">
        <label>نام کاربری:</label><br>
        <input type="text" name="username" required><br>
        <label>رمز عبور:</label><br>
        <input type="password" name="password" required><br>
        <label>تأیید رمز عبور:</label><br>
        <input type="password" name="confirm_password" required><br>
        <button type="submit">ثبت نام</button>
    </form>
</body>
<p>


</p>
<?php include 'footer.php'; ?>
</html>

