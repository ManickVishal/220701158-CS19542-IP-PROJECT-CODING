<?php
// Start the session
session_start();

// Database connection credentials (replace with your own settings)
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "dr@vishal14!";  // Set your MySQL password
$dbname = "mnbvcxz";

// Create connection to MySQL database
$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = false; // Flag to check if insertion was successful

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the POST request
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    
    // Insert the login data into the database
    $sql = "INSERT INTO login (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        $success = true; // Set success flag to true
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
 
    // Redirect with success message
    if ($success) {
        echo "<script>
                alert('Login details inserted successfully!');
                window.location.href = 'question.html'; // Redirect to question.html
              </script>";
        exit(); // Exit to prevent further processing
    }
}
?>

