<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'server');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $event_id = intval($_GET['id']);

    $sql = "SELECT event_id, event_name, event_description, event_date, event_location, event_image 
            FROM events 
            WHERE event_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Event Details</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #230c33;
                color: white;
                padding: 20px;
            }
            .event-details {
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
        $event = $result->fetch_assoc();
        echo "<div class='event-details'>
                <h2>" . htmlspecialchars($event['event_name']) . "</h2>
                <img src='" . htmlspecialchars($event['event_image']) . "' alt='" . htmlspecialchars($event['event_name']) . "' style='width: 100%; border-radius: 8px;'>
                <p><strong>Description:</strong> " . htmlspecialchars($event['event_description']) . "</p>
                <p><strong>Date:</strong> " . date('Y-m-d H:i:s', strtotime($event['event_date'])) . "</p>
                <p><strong>Location:</strong> " . htmlspecialchars($event['event_location']) . "</p>
                <a href='attendee_dash.php' class='btn'>Back to Dashboard</a>
              </div>";
    } else {
        echo "<div class='event-details'>
                <h2>Error</h2>
                <p>No details found for this event.</p>
                <a href='attendee_dash.php' class='btn'>Back to Dashboard</a>
              </div>";
    }

    $stmt->close();
} else {
    echo "<div class='event-details'>
            <h2>Error</h2>
            <p>Invalid event ID.</p>
            <a href='attendee_dash.php' class='btn'>Back to Dashboard</a>
          </div>";
}

$conn->close();
?>
