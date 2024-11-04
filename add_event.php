<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'server');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_name = $_POST['event_name'];
    $event_description = $_POST['event_description'];
    $event_date = $_POST['event_date'];
    $event_location = $_POST['event_location'];
    $event_fee = $_POST['event_fee'];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["event_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["event_image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["event_image"]["tmp_name"], $target_file)) {
            $host_username = $_SESSION['username'];

            $stmt = $conn->prepare("INSERT INTO events (event_name, event_description, event_date, event_location, host_username, event_image, event_fee) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssi", $event_name, $event_description, $event_date, $event_location, $host_username, $target_file, $event_fee);

            if ($stmt->execute()) {
                echo "<div class='event-confirmation'>";
                echo "<h2>Event Created Successfully!</h2>";
                echo "<h3>Event Details:</h3>";
                echo "<div class='event-details'>";
                echo "<p><strong>Event Name:</strong> <span>$event_name</span></p>";
                echo "<p><strong>Description:</strong> <span>$event_description</span></p>";
                echo "<p><strong>Date:</strong> <span>$event_date</span></p>";
                echo "<p><strong>Location:</strong> <span>$event_location</span></p>";
                echo "<p><strong>Fee:</strong> <span>" . ($event_fee > 0 ? "$" . number_format((float)$event_fee, 2) : "Free") . "</span></p>";
                echo "</div>";
                echo "<img src='$target_file' alt='Event Image' class='event-image'>";
                echo "</div>";
                echo "<div class='dashboard-button'>";
                echo "<a href='host_dash.php' class='btn'>Go to Dashboard</a>";
                echo "</div>";
                echo "</div>";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

$conn->close();
?>
<style>
    .dashboard-button {
        text-align: center;
        margin-top: 20px;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        color: #FFFFFF;
        background-color: #FF5733;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #C70039;
    }
    body {
        font-family: Arial, sans-serif;
        background-color: #230c33;
        margin: 0;
        padding: 20px;
    }
    .event-confirmation {
        max-width: 600px;
        margin: 20px auto;
        background-color: #9984d4;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        text-align: center;
    }
    .event-confirmation h2 {
        color: white;
        text-align: center;
    }
    .event-confirmation h3 {
        margin: 10px 0;
        text-align: center;
        color: white;
    }
    .event-details {
        margin: 10px 0;
    }
    .event-details p {
        color: #333333;
        margin: 5px 0;
    }
    .event-details span {
        font-weight: bold;
    }
    .event-confirmation .event-image {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
        margin-top: 15px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
</style>
