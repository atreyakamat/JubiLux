<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT a.username, a.email, a.phone_number, a.country, a.city, a.user_type, t.interest 
        FROM admin a 
        LEFT JOIN attendee t ON a.username = t.username 
        WHERE a.username = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

if (!$userData) {
    echo "No user data found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>User Profile - Jubilux Entertainment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #230c33;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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

        .title-home {
            font-weight: bold;
            font-size: 40px;
            text-align: center;
            flex: 1;
        }

        .btn {
            margin-left: 10px;
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #357ab8;
        }

        .profile-container {
            width: 80%;
            margin: 20px auto;
            background: #4a3c6c;
            border-radius: 8px;
            padding: 20px;
            color: white;
            flex: 1;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-content {
            display: flex;
            align-items: flex-start;
        }

        .profile-image {
            flex: 1;
        }

        .profile-image img {
            border-radius: 50%;
            width: 300px;
            height: 300px;
            object-fit: cover;
        }

        .profile-info {
            flex: 2;
            margin-left: 20px;
        }

        .profile-info h2 {
            margin: 0 0 10px;
        }

        .profile-info p {
            margin: 5px 0;
        }

        footer {
            background-color: #9984d4;
            text-align: center;
            padding: 10px;
            color: white;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <img class="Jubilux-Logo-head" src="images/jubilux logo.png" alt="Jubilux Logo">
        <span class="title-home">User Profile</span>
        <div>
            <a href="logout.php"><button class="btn">Logout</button></a>
            <a href="attendee_dash.php"><button class="btn">Dashboard</button></a>
        </div>
    </header>

    <div class="profile-container">
        <div class="profile-header">
            <h1>Profile</h1>
        </div>
        <div class="profile-content">
            <div class="profile-image">
                <img src="images/profileimg.png" alt="Profile Image">
            </div>
            <div class="profile-info">
                <h2 style="text-align: left"><?php echo htmlspecialchars($userData['username']); ?></h2>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($userData['email']); ?></p>
                <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($userData['phone_number']); ?></p>
                <p><strong>Country:</strong> <?php echo htmlspecialchars($userData['country']); ?></p>
                <p><strong>City:</strong> <?php echo htmlspecialchars($userData['city']); ?></p>
                <p><strong>User Type:</strong> <?php echo htmlspecialchars($userData['user_type']); ?></p>
                <p><strong>Interests:</strong> <?php echo htmlspecialchars($userData['interest'] ? $userData['interest'] : 'None'); ?></p>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Jubilux Entertainment. All rights reserved.</p>
    </footer>
</body>
</html>
