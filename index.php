<?php
// Retrieve form data and sanitize input
$yourname   = htmlspecialchars($_POST['yourname']);
$trip1      = htmlspecialchars($_POST['trip1']);
$trip2      = htmlspecialchars($_POST['trip2']);
$departure  = htmlspecialchars($_POST['departure']);
$people     = intval($_POST['people']);

// Database connection
$conn = new mysqli('localhost', 'root', '', 'regan');

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO bookings (yourname, trip1, trip2, departure, people) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $yourname, $trip1, $trip2, $departure, $people);
    
    // Execute statement
    if ($stmt->execute()) {
        echo "Sent successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close connections
    $stmt->close();
    $conn->close();
}
?>
