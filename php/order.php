<?php


session_start();
include('db_connect.php');

$data = json_decode(file_get_contents("php://input"), true);

// Retrieve user ID
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id || empty($data['basket']) || empty($data['address']) || empty($data['cardNumber'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data provided']);
    exit;
}

// Extract the last 4 digits of the card number
$cardLast4 = substr($data['cardNumber'], -4);

// Insert each item from the basket into the Orders table
foreach ($data['basket'] as $item) {
    $query = "INSERT INTO Orders (user_id, food_id, order_date, status, address, card_last4) VALUES (?, ?, NOW(), 'Pending', ?, ?)";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Query preparation failed: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param(
        "iiss",
        $user_id,
        $item['id'],        // Food ID from basket
        $data['address'],   // Full address
        $cardLast4          // Last 4 digits of the card
    );

    if (!$stmt->execute()) {
        echo json_encode(['status' => 'error', 'message' => 'Query execution failed: ' . $stmt->error]);
        exit;
    }
}


// Clear the basket after successful order placement
unset($_SESSION['basket']);

// Return success response
echo json_encode(['status' => 'success']);

?>


