<?php
session_start();
include 'db.php';

if (isset($_SESSION['username']) && isset($_POST['comment']) && isset($_POST['product_id'])) {
    $username = $_SESSION['username'];
    $comment = $_POST['comment'];
    $product_id = intval($_POST['product_id']);

    $stmt = $conn->prepare("INSERT INTO comments (product_id, username, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $product_id, $username, $comment);
    $stmt->execute();
}

header("Location: product_detail.php?id=$product_id");
exit();
?>
