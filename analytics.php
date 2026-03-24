<?php

header("Content-Type: application/json");

include 'config.php';

$sql = "SELECT status, COUNT(*) as total FROM tasks GROUP BY status";
$stmt = $conn->query($sql);

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);