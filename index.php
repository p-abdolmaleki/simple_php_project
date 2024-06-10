<?php
session_start();
include 'db.php';

$result = $conn->query("SELECT * FROM products");
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = "SELECT * FROM products WHERE name LIKE '%$search%'";
    $result = $conn->query($query);
} else {
    $result = $conn->query("SELECT * FROM products");
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <header>
    <?php include 'header.php'; ?>

    </header>
    <title>فروشگاه اینترنتی کارگاه ۴</title>
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

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(4, minmax(250px, 1fr));
            grid-gap: 10px;
            justify-items: center;
        }

        .product {
            background-color: #d9d9d9;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .product h2 {
            color: #4b0082; 
        }

        .product p {
            color: #333;
        }

        .product img {
            width: 50%;
            height: auto;
            border-radius: 10px;
        }

        .product a {
            text-decoration: none;
            color: inherit;
        }
        form {
            margin-top: 10px;
        }

        label {
            color: #4b0082; 
        }

        input[type="number"] {
            width: 50px;
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
    <form action="index.php" method="GET">
        <input type="text" name="search" placeholder="جستجو...">
        <button type="submit">جستجو</button>
    </form>
        <h1>محصولات</h1>
        <?php if (isset($_SESSION['username'])): ?>
            <p>خوش آمدید، <?= $_SESSION['username']; ?>! <a href="logout.php">خروج</a></p>
        <?php else: ?>
            <p>هنوز وارد حساب کاربری خود نشده‌اید...</p>
        <?php endif; ?>
        <div class="products">
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="product">
                    <a href="product_detail.php?id=<?= $row['id']; ?>">
                        <?php if (!empty($row['image_url'])): ?>
                            <img src="<?= $row['image_url']; ?>" alt="<?= $row['name']; ?>">
                        <?php endif; ?>
                        <h2><?= $row['name']; ?></h2>
                    </a>
                    <p><?= $row['description']; ?></p>
                    <p>قیمت: <?= $row['price']; ?> هزار تومان</p>
                    <p>موجودی: <?= $row['stock']; ?></p>
                    <form method="post" action="cart.php">
                        <input type="hidden" name="product_id" value="<?= $row['id']; ?>">
                        <label for="quantity">تعداد:</label>
                        <input type="number" name="quantity" min="1" max="<?= $row['stock']; ?>" value="1" required>
                        <button type="submit">اضافه کردن به سبد خرید</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
    </body>
    <p>

    
    </p>

<?php include 'footer.php'; ?>
</html>
