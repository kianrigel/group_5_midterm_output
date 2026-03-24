<?php

header("Content-Type: application/json");

include 'config.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {

    if (isset($_GET['user_id'])) {

        $user_id = $_GET['user_id'];

        $sql = "SELECT * FROM tasks WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($data);

    } else {

        $sql = "SELECT * FROM tasks";
        $stmt = $conn->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($data);
    }

} elseif ($method == 'POST') {

    $data = json_decode(file_get_contents("php://input"));

    $sql = "INSERT INTO tasks (title, status, user_id, project_id)
            VALUES (:title, :status, :user_id, :project_id)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'title' => $data->title,
        'status' => $data->status,
        'user_id' => $data->user_id,
        'project_id' => $data->project_id
    ]);

    echo json_encode(["message" => "Task added"]);
}