 <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    //$email = $_POST["email"];

    $pwd = 'hakdog';
    echo "Password: $pwd<br/>";

    $hashed = password_hash($pwd, PASSWORD_DEFAULT);
    echo "Hashed Password: $hashed";

    $verifypwd = password_verify($pwd, $hashed);

    if($verifypwd) 
    {
        echo "<br/>Can login.";
    }
    else
    {
        echo "<br/>Invalid Credentials";
    }

    echo "<br/>Verify Password: $verifypwd";

    $email = "louise@gmail.com";
    echo "<br/>Valid Email: " . filter_var( $email, FILTER_VALIDATE_EMAIL );

    $address = "mandaue city";
    echo "<br/>Address: " . ucwords($address) . "<br/>";
     try {
         require_once "dbc.inc.php";

         $query = "SELECT * FROM users WHERE username = :username";

         $stmt = $pdo->prepare($query);

         $stmt->bindParam(":username", $username);
         $stmt->bindParam(":pwd", $pwd);
         //$stmt->bindParam(":email", $email);
         $stmt->execute();

        if ( $stmt->rowCount() > 0) 
        {
         header("Location: ../index.php");
         exit();
        }
        else
        {

        }

         die();

     } 
     catch (PDOException $e) 
     {
         die("Query failed: " . $e->getMessage());
     }
} 
?>