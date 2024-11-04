<?php
session_start();

if (!isset($_SESSION['username'])) {
    die("You must be logged in to register for events.");
}

$conn = new mysqli('localhost', 'root', '', 'server');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_id'])) {
    $event_id = intval($_POST['event_id']);
    $username = $_SESSION['username'];

    $check_query = "SELECT * FROM registrations WHERE event_id = ? AND username = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("is", $event_id, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Event Registration Confirmation</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #230c33;
                color: white;
                padding: 20px;
            }
            .confirmation {
                background-color: #34234a;
                border-radius: 8px;
                padding: 20px;
                margin: 20px 0;
            }
            .btn {
                background-color: #4a90e2;
                color: white;
                border: none;
                padding: 10px 15px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
                text-decoration: none;
            }
            .btn:hover {
                background-color: #357abf;
            }
        </style>
    </head>
    <body>";

    if ($result->num_rows > 0) {
        echo "<div class='confirmation'>
                <h2>Registration Confirmation</h2>
                <p>You are already registered for this event.</p>
                <p><strong>Event ID:</strong> $event_id</p>
                <p><strong>Username:</strong> $username</p>
                <a href='attendee_dash.php' class='btn'>Go Back</a>
              </div>";
    } else {
        $insert_query = "INSERT INTO registrations (event_id, username) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("is", $event_id, $username);
        if ($stmt->execute()) {
            echo "<div class='confirmation'>
                    <h2>Registration Confirmation</h2>
                    <p>You have successfully registered for the event!</p>
                    <p><strong>Event ID:</strong> $event_id</p>
                    <p><strong>Username:</strong> $username</p>
                    <a href='attendee_dash.php' class='btn'>Go Back</a>
                  </div>";
        } else {
            echo "<div class='confirmation'>
                    <h2>Error</h2>
                    <p>There was an error registering for the event. Please try again later.</p>
                    <p><strong>Error:</strong> " . htmlspecialchars($stmt->error) . "</p>
                    <a href='attendee_dash.php' class='btn'>Go Back</a>
                  </div>";
        }
    }

    $stmt->close();
    echo "</body></html>";
} else {
    echo "Invalid request.";
}

$conn->close();
?>
