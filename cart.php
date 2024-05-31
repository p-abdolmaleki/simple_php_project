<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = intval($_POST['product_id']);
$quantity = intval($_POST['quantity']);

$stmt = $conn->prepare("SELECT id FROM carts WHERE user_id = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $cart_id = $result->fetch_assoc()['id'];
} else {
    $stmt = $conn->prepare("INSERT INTO carts (user_id) VALUES (?)");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $cart_id = $stmt->insert_id;
}

$stmt = $conn->prepare("SELECT quantity FROM cart_items WHERE cart_id = ? AND product_id = ?");
$stmt->bind_param('ii', $cart_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $existing_quantity = $result->fetch_assoc()['quantity'];
    $new_quantity = $existing_quantity + $quantity;
    $stmt = $conn->prepare("UPDATE cart_items SET quantity = ? WHERE cart_id = ? AND product_id = ?");
    $stmt->bind_param('iii', $new_quantity, $cart_id, $product_id);
} else {
    $stmt = $conn->prepare("INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param('iii', $cart_id, $product_id, $quantity);
}

$stmt->execute();

header("Location: view_cart.php");
exit();
?>
