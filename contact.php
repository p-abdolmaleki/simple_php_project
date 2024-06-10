<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ارتباط با ما</title>
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

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
        }

        h1, p {
            text-align: center;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #4b0082;
        }

        input[type="text"], input[type="email"], textarea {
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
    </style>
</head>
<body>
    <div class="container">
        <h1>ارتباط با ما</h1>
        <form action="send_message.php" method="post">
            <label for="name">نام:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">ایمیل:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">پیام:</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <button type="submit">ارسال</button>
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
