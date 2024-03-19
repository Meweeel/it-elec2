<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST["search"];

    try {
        require_once "includes/dbc.inc.php";
        // require_once "index.php";

        // $query = "SELECT * FROM comments WHERE comments LIKE :search;";
        $query = "SELECT comments.comments, username 
                  FROM comments
                  INNER JOIN users 
                  ON comments.user_id = users.id
                  WHERE comments.comments 
                  LIKE :search;";

        $stmt = $pdo->prepare($query);
        // $stmt->bindParam("", $search, PDO::PARAM_STR);

        $searchTerm = "%$search%";
        $stmt->bindParam(":search", $searchTerm, PDO::PARAM_STR);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h3>Search Results:</h3>

    <?php if (empty($results)) : ?>
        <div>
            <p>There were no results!</p>
        </div>
    <?php else : ?>
        <?php foreach ($results as $row) : ?>
            <!-- <h2><?= htmlspecialchars($row['id']) ?></h2> -->
            <h2><?= htmlspecialchars($row['username']) ?></h2>
            <p><?= htmlspecialchars($row['comments']) ?></p>
        <?php endforeach; ?>
    <?php endif; ?>

</body>

</html>