<?php
$servername = "localhost";
$db_username = "root";
$db_password = ""; 
$dbname = "server";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $plain_password = $_POST['password'];
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

    $interests = null; 
    $organization_name = $role_in_organization = $event_specialization = null; 

    if ($user_type === 'attendee') {
        $interests = json_encode($_POST['interest']);
    } elseif ($user_type === 'host') {
        $organization_name = mysqli_real_escape_string($conn, $_POST['organization_name']);
        $role_in_organization = mysqli_real_escape_string($conn, $_POST['role_in_organization']);
        $event_specialization = mysqli_real_escape_string($conn, $_POST['event_specialization']);
    }

    $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

    $sql_admin = "INSERT INTO admin (username, email, password, phone_number, city, country, user_type)
                  VALUES ('$username', '$email', '$hashed_password', '$phone_number', '$city', '$country', '$user_type');";

    if ($conn->query($sql_admin) === TRUE) {
        $admin_id = $conn->insert_id;

        if ($user_type === 'attendee') {
            $sql_attendee = "INSERT INTO attendee (attendee_id, username, interest) VALUES ('$admin_id', '$username', '$interests');";
            if ($conn->query($sql_attendee) !== TRUE) {
                echo "Error inserting into attendee table: " . $conn->error;
            }
        } elseif ($user_type === 'host') {
            $sql_host = "INSERT INTO host (host_id, username, organization_name, role_in_organization, event_specialization)
                         VALUES ('$admin_id', '$username', '$organization_name', '$role_in_organization', '$event_specialization');";
            if ($conn->query($sql_host) !== TRUE) {
                echo "Error inserting into host table: " . $conn->error;
            }
        }

        header("Location: index.php");
        exit(); 
    } else {
        echo "Error inserting into admin table: " . $conn->error;
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
