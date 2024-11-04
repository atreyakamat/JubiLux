<?php
session_start();
$userName = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$conn = new mysqli('localhost', 'root', '', 'server');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT event_id, event_name, event_description, event_date, event_location, event_image 
        FROM events 
        ORDER BY event_date DESC 
        LIMIT 7";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendee Dashboard - Jubilux Entertainment</title>
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
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }
        .Jubilux-Logo-head {
            width: 130px;
        }
        .title-dashboard {
            font-weight: bold;
            font-size: 40px;
            text-align: center;
            flex: 1;
        }
        .btn {
            margin-left: 10px;
            background-color: #230c33;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none; 
            display: inline-block; 
        }
        .btn:hover {
            background-color: #caa8f5;
        }
        section {
            padding: 20px;
        }
        .flex-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .card {
            background-color: #34234a;
            border-radius: 8px;
            margin: 10px;
            padding: 15px;
            text-align: center;
            width: 300px;
        }
        footer {
            background-color: #9984d4;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <header>
        <img class="Jubilux-Logo-head" src="images/jubilux_logo.png" alt="Jubilux Logo">
        <span class="title-dashboard">Welcome, <?php echo $userName; ?>!</span>
        <div>
            <a href="logout.php"><button class="btn">Logout</button></a>
            <a href="profile.php"><button class="btn">Profile</button></a>
        </div>
    </header>
    <section>
        <h2>Upcoming Events</h2>
        <div class="flex-container">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="card">
                        <img src="<?php echo $row['event_image']; ?>" alt="<?php echo $row['event_name']; ?>" style="width: 100%; border-radius: 8px;">
                        <h3><?php echo $row['event_name']; ?></h3>
                        <p><?php echo $row['event_description']; ?></p>
                        <p><strong>Date:</strong> <?php echo date('Y-m-d H:i:s', strtotime($row['event_date'])); ?></p>
                        <p><strong>Location:</strong> <?php echo $row['event_location']; ?></p>
                        <form method="POST" action="register_event.php" style="display: inline;">
                            <input type="hidden" name="event_id" value="<?php echo $row['event_id']; ?>">
                            <button type="submit" class="btn">Register</button>
                        </form>
                        <a href="fetch_events.php?id=<?php echo $row['event_id']; ?>" class="btn">View Details</a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No upcoming events found.</p>
            <?php endif; ?>
        </div>
    </section>
    <footer>
        &copy; Jubilux Event Management Co. All rights reserved.
    </footer>
</body>
</html>
<?php
$conn->close();
?>
