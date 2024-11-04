<!DOCTYPE html>
<html lang="en">
<head>
    <title>Event Search</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #230c33;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .search-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            background-color: #592e83;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            max-width: 600px;
        }
        h2 {
            color: white;
            margin-bottom: 20px;
        }
        .search-container input[type="text"] {
            padding: 10px;
            width: 100%;
            max-width: 300px;
            font-size: 16px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .search-container button {
            padding: 10px;
            font-size: 16px;
            background-color: #caa8f5;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
            max-width: 300px;
        }
        .search-container button:hover {
            background-color: #9984d4;
        }
        .results {
            margin-top: 20px;
            width: 100%;
            max-width: 600px;
        }
        .result-item {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .result-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        h3 {
            color: white;
        }
        .result-item h4 {
            margin: 0 0 10px;
            color: black;
        }
        .result-item p {
            margin: 5px 0;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="search-container">
        <h2>Search Events</h2>
        <form method="GET" action="">
            <input type="text" name="event_name" placeholder="Event Name">
            <input type="text" name="host_name" placeholder="Host Name">
            <div>
                <button type="submit">Search</button>
            </div>
        </form>

        <div class="results">
            <?php
            if (isset($_GET['event_name']) || isset($_GET['host_name'])) {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "server";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $event_name = isset($_GET['event_name']) ? $conn->real_escape_string(trim($_GET['event_name'])) : '';
                $host_name = isset($_GET['host_name']) ? $conn->real_escape_string(trim($_GET['host_name'])) : '';

                if (!empty($event_name) || !empty($host_name)) {
                    $sql = "
                        SELECT 
                            events.event_name, 
                            events.event_description, 
                            events.event_date, 
                            events.event_location,
                            admin.username AS host_name
                        FROM events
                        LEFT JOIN admin ON events.host_username = admin.username
                        WHERE admin.user_type = 'host'
                    ";

                    $conditions = [];

                    if (!empty($event_name)) {
                        $conditions[] = "events.event_name LIKE '%$event_name%'";
                    }

                    if (!empty($host_name)) {
                        $conditions[] = "admin.username LIKE '%$host_name%'";
                    }

                    if (count($conditions) > 0) {
                        $sql .= " AND " . implode(' AND ', $conditions);
                    }

                    $result = $conn->query($sql);

                    if ($result) {
                        if ($result->num_rows > 0) {
                            echo "<h3>Search Results:</h3>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<div class='result-item'>";
                                echo "<h4>" . htmlspecialchars($row['event_name']) . " by " . htmlspecialchars($row['host_name']) . "</h4>";
                                echo "<p>" . htmlspecialchars($row['event_description']) . "</p>";
                                echo "<p>Date: " . htmlspecialchars($row['event_date']) . "</p>";
                                echo "<p>Location: " . htmlspecialchars($row['event_location']) . "</p>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p style='color: white;'>No results found for the specified criteria.</p>";
                        }
                    } else {
                        echo "<p style='color: white;'>Error executing query: " . htmlspecialchars($conn->error) . "</p>";
                    }
                } else {
                    echo "<p style='color: white;'>Please enter at least one search criteria.</p>";
                }

                $conn->close();
            }
            ?>
        </div>
    </div>
</body>
</html>
