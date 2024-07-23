<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];


    $conn = new mysqli("localhost", "roott", "999325", "kayit_login");

    if($conn->connect_error) {
        die("Connection error: " . $conn->connect_error);
    }

    $sql = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if(password_verify($password, $row["password"])) {
            echo "Login successful";   
        }else{
            echo "Login failed";
        }
    }else{
        echo "User not found";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
    <body>
        <title>Forum</title>
        <div class="loginpage-container">
            <h2>Welcome</h2>
            <h4>Start a chat to talk to forum members. Remember the rules!</h4>
            <a href="rules.html">Look Rules!</a>
        </div>
        <head>

        </head>
    </body>
</html>