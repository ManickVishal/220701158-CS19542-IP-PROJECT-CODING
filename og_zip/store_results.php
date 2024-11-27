<?php
session_start(); // Start the session to access session variables

// Database connection details
$servername = "localhost";
$username = "root";
$password = "dr@vishal14!";
$dbname = "mnbvcxz";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture data sent from the frontend
$depressionFrequency = $_POST['depressionFrequency'];
$selfHarmThoughts = $_POST['selfHarmThoughts'];
$anxietyFrequency = $_POST['anxietyFrequency'];
$worthlessnessFrequency = $_POST['worthlessnessFrequency'];
$sleepFrequency = $_POST['sleepFrequency'];
$totalScore = $_POST['totalScore'];
$riskLevel = $_POST['riskLevel'];

// Prepare and bind the SQL statement
$stmt = $conn->prepare("INSERT INTO assessment_results (depression_frequency, self_harm_thoughts, anxiety_frequency, worthlessness_frequency, sleep_frequency, total_score, risk_level) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iiiiiis", $depressionFrequency, $selfHarmThoughts, $anxietyFrequency, $worthlessnessFrequency, $sleepFrequency, $totalScore, $riskLevel);

// Execute the statement
if ($stmt->execute()) {
    echo "Record inserted successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>