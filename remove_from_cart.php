<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = intval($_POST['product_id']);

$stmt = $conn->prepare("SELECT id FROM carts WHERE user_id = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$cart_id = $stmt->get_result()->fetch_assoc()['id'];

$stmt = $conn->prepare("DELETE FROM cart_items WHERE cart_id = ? AND product_id = ?");
$stmt->bind_param('ii', $cart_id, $product_id);
$stmt->execute();

header("Location: view_cart.php");
exit();
?>
