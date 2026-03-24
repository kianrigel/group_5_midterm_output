<?php

header("Content-Type: application/json");

include 'config.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {

    $sql = "SELECT * FROM users";
    $stmt = $conn->query($sql);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);

} elseif ($method == 'POST') {

    $data = json_decode(file_get_contents("php://input"));

    $name = $data->name;

    $sql = "INSERT INTO users (name) VALUES (:name)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['name' => $name]);

    echo json_encode(["message" => "User added"]);

}