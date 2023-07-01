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

$email = $_GET['email'];

$stmt = $conn->prepare("SELECT health_report FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($healthReport);
$stmt->fetch();

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="health_report.pdf"');
readfile($healthReport);

$stmt->close();
$conn->close();
?>
