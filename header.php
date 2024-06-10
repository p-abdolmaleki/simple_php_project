<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فروشگاه اینترنتی کارگاه ۴</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
        <h1>فروشگاه اینترنتی کارگاه ۴</h1>
        <nav>
            
                <a href="index.php">صفحه اصلی</a>
                <a href="about.php">درباره ما</a>
                <a href="contact.php">ارتباط با ما</a>
                <?php if(isset($_SESSION['username'])): ?>
                    <a href="logout.php">خروج</a>
                <?php else: ?>
                    <a href="register.php">ثبت نام</a>
                    <a href="login.php">ورود</a>
                <?php endif; ?>
                <a href="view_cart.php">سبد خرید</a>
        </nav>
</header>