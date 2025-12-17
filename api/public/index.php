<?php
header('Content-Type: application/json');

$data = ['status' => 'ok', 'message' => 'Hello from API!'];
echo json_encode($data);
