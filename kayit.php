<?php
if  ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $conn = new mysqli("localhost", "roott", "999325", "kayit_login");

    if ($conn->connect_error) {
        die("Bağlantı hatası: ". $conn->connect_error);
    }

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);
    $stmt->execute();

    
    if ($_POST["password"] === $_POST["password_2"]) {
        if ($_POST["age"] >= 18) {
            echo "You are now logged in! To access the member page, log out and log in again.";
            echo '<a href="giris.html">Log Out</a>';
        } else {
            echo "You must be 18 or older to log in."; 
        }
    } else {
        echo "Password is not the same" . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
}