<?php

header("Content-Type: application/json");

include 'config.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {

    $sql = "SELECT * FROM projects";
    $stmt = $conn->query($sql);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);

} elseif ($method == 'POST') {

    $data = json_decode(file_get_contents("php://input"));

    $title = $data->title;

    $sql = "INSERT INTO projects (title) VALUES (:title)";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['title' => $title]);

    echo json_encode(["message" => "Project added"]);
}