<?php
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $search = $_POST["search"];

    try {
        require_once "includes/dbc.inc.php";

        $query = "SELECT * FROM users;";

        $stmt = $pdo->prepare($query);

        // $searchTerm = "%$search%";
        // $stmt->bindParam(":search", $searchTerm, PDO::PARAM_STR);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // $results = $stmt->fetchAll();

        $pdo = null;
        $stmt = null;
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
// else {
//     header("Location: ../index.php");
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <a href="index.php">Home</a> |
    <a href="comments.php">Comments</a> |
    <a href="register.php">Register</a> |
    <a href="login.php">Login</a><br /><br />

    <form action="includes/comments.inc.php" method="post">
        <select name="user">
            <?php
            foreach ($results as $row) : ?>
            <option value = "<?= $row["id"]?>"><?= $row["username"] ?> </option>
                <?php endforeach; ?>
        </select><br />
        <textarea name="comments"></textarea><br />
        <button>Submit</button>
    </form>
    <pre>
        <!-- <?php
        print_r($results); ?> -->
    </pre>
</body>

</html>