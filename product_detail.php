<?php
session_start();
include 'db.php';

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    
    $stmt = $conn->prepare("SELECT * FROM comments WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $comments_result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جزئیات محصول</title>
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

    a {
        color: #800080; 
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

        .product-detail {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .product-detail h1 {
            color: #4b0082;
            text-align: center;
        }

        .product-detail img {
            display: block;
            margin: 0 auto;
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .product-detail h2 {
            color: #4b0082;
            margin-top: 20px;
        }

        .product-detail p {
            color: #666;
        }

        .product-detail .comments {
            margin-top: 20px;
        }

        .product-detail .comments h3 {
            color: #4b0082;
            margin-bottom: 10px;
        }

        .product-detail .comments .comment {
            margin-bottom: 15px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
        }

        .product-detail .comments .comment:last-child {
            border-bottom: none;
        }

        .product-detail .comments .comment p {
            color: #333;
            margin: 5px 0;
        }

        .product-detail .comments form {
            margin-top: 20px;
        }

        .product-detail .comments label {
            display: block;
            margin-bottom: 5px;
            color: #4b0082;
        }

        .product-detail .comments textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: none;
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
            margin-top: 20px;
            color: #4b0082;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    
    <div class="product-detail">
        <?php if ($product): ?>
            <h1>جزئیات محصول</h1>
            <?php if (!empty($product['image_url'])): ?>
                <img src="<?= $product['image_url']; ?>" alt="<?= $product['name']; ?>">
            <?php endif; ?>
            <h2><?= $product['name']; ?></h2>
            <p><?= $product['description']; ?></p>
            <p>قیمت: <?= $product['price']; ?> هزار تومان</p>
            <p>موجودی: <?= $product['stock']; ?></p>

            <?php if (isset($_SESSION['error_message'])): ?>
                <p style="color: red;"><?= $_SESSION['error_message']; ?></p>
                <?php unset($_SESSION['error_message']); ?>
            <?php endif; ?>

            <form method="post" action="cart.php">
                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                <label for="quantity">تعداد:</label>
                <input type="number" name="quantity" min="1" max="<?= $product['stock']; ?>" value="1" required>
                <button type="submit">اضافه کردن به سبد خرید</button>
            </form>

            <div class="comments">
                <h3>نظرات</h3>
                <?php while($comment = $comments_result->fetch_assoc()): ?>
                    <div class="comment">
                        <p><strong><?= htmlspecialchars($comment['username']); ?>:</strong></p>
                        <p><?= htmlspecialchars($comment['comment']); ?></p>
                    </div>
                <?php endwhile; ?>

                <?php if (isset($_SESSION['username'])): ?>
                    <form method="post" action="submit_comment.php">
                        <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                        <label for="comment">نظر خود را بنویسید:</label><br>
                        <textarea name="comment" rows="4" required></textarea><br>
                        <button type="submit">ارسال نظر</button>
                        <a href="index.php">بازگشت به صفحه اصلی</a>
                    </form>
                <?php else: ?>
                    <p>برای ارسال نظر <a href="login.php">وارد</a> شوید.</p>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <p>محصول مورد نظر یافت نشد.</p>
        <?php endif; ?>
    </div>
    
</body>
</html>
