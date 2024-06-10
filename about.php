<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>درباره ما</title>
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
    </style>
</head>
<body>

    <div class="container">
        <h1>درباره ما</h1>
        <p>سلام، چیزی برای گفتن نیست. این سایت پروژه درس کارگاه تخصصی در رشته ۴ می‌باشد.</p>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
