<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT ci.product_id, ci.quantity, p.name, p.price FROM cart_items ci JOIN products p ON ci.product_id = p.id JOIN carts c ON ci.cart_id = c.id WHERE c.user_id = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$cart_items = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سبد خرید</title>
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

        div {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
        }

        div > p {
            text-align: center;
        }

        form {
            text-align: center;
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
            display: block;
            text-align: center;
            color: #800080; 
            text-decoration: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>سبد خرید شما</h1>
    <div>
    <?php if ($cart_items->num_rows > 0): ?>
    <?php 
    $total_price = 0;
    while($item = $cart_items->fetch_assoc()): 
        $item_total = $item['price'] * $item['quantity'];
        $total_price += $item_total;
    ?>
        <div>
            <h2><?= $item['name']; ?></h2>
            <p>قیمت: <?= $item['price']; ?> هزار تومان</p>
            <p>تعداد: <?= $item['quantity']; ?></p>
            <form method="post" action="remove_from_cart.php">
                <input type="hidden" name="product_id" value="<?= $item['product_id']; ?>">
                <button type="submit">حذف از سبد</button>
            </form>
        </div>
    <?php endwhile; ?>
    <p>جمع کل خرید: <?= $total_price; ?> هزار تومان</p>
    <form method="post" action="checkout.php">
        <button type="submit">نهایی کردن خرید</button>
    </form>
<?php else: ?>
    <p>سبد خرید شما خالی است.</p>
<?php endif; ?>
    </div>
    <a href="index.php">بازگشت به صفحه اصلی</a>
</body>
</html>
