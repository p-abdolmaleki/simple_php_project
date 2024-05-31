<?php
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Retrieve cart items from database
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT ci.product_id, ci.quantity, p.stock FROM cart_items ci JOIN products p ON ci.product_id = p.id JOIN carts c ON ci.cart_id = c.id WHERE c.user_id = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$cart_items = $stmt->get_result();

$allAvailable = true;
while ($item = $cart_items->fetch_assoc()) {
    if ($item['stock'] < $item['quantity']) {
        $allAvailable = false;
        break;
    }
}

if ($allAvailable) {
    $cart_items->data_seek(0); // Reset pointer to start of result set
    while ($item = $cart_items->fetch_assoc()) {
        $stmt = $conn->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");
        $stmt->bind_param('ii', $item['quantity'], $item['product_id']);
        $stmt->execute();
    }

    // Clear the cart
    $stmt = $conn->prepare("DELETE FROM cart_items WHERE cart_id = (SELECT id FROM carts WHERE user_id = ?)");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();

}

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پرداخت</title>
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

        p {
            text-align: center;
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
    <div>
        <?php if ($allAvailable): ?>
            <p>خرید شما با موفقیت انجام شد.</p>
        <?php else: ?>
            <p>تعدادی از محصولات موجودی کافی ندارند.</p>
        <?php endif; ?>
        <a href="index.php">بازگشت به صفحه اصلی</a>
    </div>
</body>
</html>

