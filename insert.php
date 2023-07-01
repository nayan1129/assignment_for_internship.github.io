<?php
// MySQL database configuration
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$age = $_POST['age'];
$weight = $_POST['weight'];
$email = $_POST['email'];
$healthReport = $_FILES['healthReport'];

$targetDir = "uploads/";
$targetFile = $targetDir . basename($healthReport['name']);
move_uploaded_file($healthReport['tmp_name'], $targetFile);

$stmt = $conn->prepare("INSERT INTO users (name, age, weight, email, health_report) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sissb", $name, $age, $weight, $email, $targetFile);
$stmt->execute();

$stmt->close();
$conn->close();

echo "User details and health report uploaded successfully.";
?>
