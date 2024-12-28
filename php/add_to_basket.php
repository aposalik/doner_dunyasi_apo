<?php
session_start();
$data = json_decode(file_get_contents("php://input"), true);

// Initialize the basket if not set
if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = [];
}

// Check if required data is provided
if (isset($data['id']) && isset($data['quantity']) && isset($data['totalPrice'])) {
    $foodId = $data['id'];
    $quantity = $data['quantity'];
    $totalPrice = $data['totalPrice'];

    // Check if the item already exists in the basket
    $exists = false;
    foreach ($_SESSION['basket'] as &$item) {
        if ($item['id'] == $foodId) {
            $item['quantity'] += $quantity; // Update the quantity
            $item['totalPrice'] += $totalPrice; // Update the total price
            $exists = true;
            break;
        }
    }

    // If the item does not exist, add it to the basket
    if (!$exists) {
        $_SESSION['basket'][] = [
            'id' => $foodId,
            'quantity' => $quantity,
            'totalPrice' => $totalPrice
        ];
    }

    // Calculate the total basket count
    $totalItems = array_sum(array_column($_SESSION['basket'], 'quantity'));

    // Return a success response with the updated count
    echo json_encode(['status' => 'success', 'count' => $totalItems]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
}
?>
