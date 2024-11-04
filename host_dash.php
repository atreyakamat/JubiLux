<?php
session_start(); 
$userName = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';

$conn = new mysqli('localhost', 'root', '', 'server');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$host_events = [];
if ($userName != 'Guest') {
    $stmt = $conn->prepare("SELECT event_name, event_description, event_date, event_image FROM events WHERE host_username = ?");
    $stmt->bind_param("s", $userName);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $host_events[] = $row;
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
    <title>Host Dashboard - Jubilux Entertainment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #230c33;
            color: white;
        }

        header {
            background-color: #9984d4;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        .Jubilux-Logo-head {
            width: 100px;
            height: auto;
        }

        .title-dashboard {
            font-weight: bold;
            font-size: 24px;
            flex: 1;
            text-align: center;
        }

        .btn {
            margin-left: 10px;
            background-color: #230c33;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 14px;
        }

        .btn:hover {
            background-color: #caa8f5;
        }

        section {
            padding: 20px;
        }

        .section-title {
            font-size: 24px;
            margin-bottom: 10px;
            text-align: center;
        }

        .flex-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .card {
            background-color: #34234a;
            border-radius: 8px;
            margin: 10px;
            padding: 15px;
            text-align: center;
            width: 280px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        footer {
            background-color: #9984d4;
            text-align: center;
            padding: 15px 0;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <img class="Jubilux-Logo-head" src="images/jubilux logo.png" alt="Jubilux Logo">
        <span class="title-dashboard">Welcome, <?php echo $userName; ?> (Host)</span>
        <div>
            <a href="profile.php"><button class="btn">Profile</button></a>
            <a href="add_event.html"><button class="btn">Add Event</button></a>
            <a href="logout.php"><button class="btn">Logout</button></a>
        </div>
    </header>

    <section>
        <h2 class="section-title">Your Hosted Events</h2>
        <div class="flex-container">
            <?php if (empty($host_events)): ?>
                <p>No events hosted yet.</p>
            <?php else: ?>
                <?php foreach ($host_events as $event): ?>
                    <div class="card">
                        <img src="<?php echo htmlspecialchars($event['event_image']); ?>" alt="<?php echo htmlspecialchars($event['event_name']); ?>">
                        <h3><?php echo htmlspecialchars($event['event_name']); ?></h3>
                        <p>Date: <?php echo htmlspecialchars($event['event_date']); ?></p>
                        <p><?php echo htmlspecialchars($event['event_description']); ?></p>
                        <a href="get_event_details.php?id=<?php echo urlencode($event['event_name']); ?>" class="btn">View Details</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <footer>
        &copy; <?php echo date("Y"); ?> Jubilux Event Management Co. All rights reserved.
    </footer>
</body>
</html>
