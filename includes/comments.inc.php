<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['user'];
    $comments = $_POST['comments'];

    echo ($user);
    try {
        require_once "dbc.inc.php";

        $query = "INSERT INTO comments (comments, user_id) VALUES (:comments, :user_id);";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":comments", $comments);
        $stmt->bindParam(":user_id", $user);
        // $stmt->bindParam(":email", $email);

        $stmt->execute();

        $pdo = null;
        $stmt = null;

        header("Location: ../index.php");

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
}
