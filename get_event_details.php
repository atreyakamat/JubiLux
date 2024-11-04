<?php
session_start();
$userName = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';

$conn = new mysqli('localhost', 'root', '', 'server');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$eventId = isset($_GET['id']) ? $_GET['id'] : '';
$eventDetails = [];

if (!empty($eventId)) {
    $stmt = $conn->prepare("SELECT event_name, event_description, event_date, event_image, host_username FROM events WHERE event_name = ?");
    $stmt->bind_param("s", $eventId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $eventDetails = $row;
    }
    $stmt->close();
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details - Jubilux Entertainment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #230c33;
            color: white;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .event-details {
            margin: 20px auto;
            padding: 15px;
            background-color: #34234a;
            border-radius: 8px;
            max-width: 600px;
        }

        .event-details img {
            width: 100%;
            border-radius: 8px;
        }

        .btn {
            display: block;
            margin: 20px auto;
            background-color: #4a90e2;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-align: center;
            width: 150px;
        }

        .btn:hover {
            background-color: #357abf;
        }
    </style>
</head>
<body>

    <h1>Event Details</h1>
    <div class="event-details">
        <?php if (!empty($eventDetails)): ?>
            <h2><?php echo htmlspecialchars($eventDetails['event_name']); ?></h2>
            <p><strong>Date:</strong> <?php echo htmlspecialchars($eventDetails['event_date']); ?></p>
            <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($eventDetails['event_description'])); ?></p>
            <p><strong>Host:</strong> <?php echo htmlspecialchars($eventDetails['host_username']); ?></p>
            <img src="<?php echo htmlspecialchars($eventDetails['event_image']); ?>" alt="<?php echo htmlspecialchars($eventDetails['event_name']); ?>">
        <?php else: ?>
            <p>No event details found.</p>
        <?php endif; ?>
    </div>

    <a href="host_dash.php"><button class="btn">Back to Dashboard</button></a>

</body>
</html>
