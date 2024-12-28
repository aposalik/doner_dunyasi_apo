<?php
session_start();
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id']) && isset($_SESSION['basket'])) {
    $_SESSION['basket'] = array_filter($_SESSION['basket'], function ($item) use ($data) {
        return $item['id'] != $data['id'];
    });
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
?>
