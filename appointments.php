<?php
include 'config.php';

// Fetch users for the dropdown
$user_query = "SELECT id, name FROM users WHERE status = 'active'";
$user_result = $conn->query($user_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Appointment</title>
    <link rel="stylesheet" href="appointmentsStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="icon_512.png" type="image/png">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <meta name="theme-color" content="#2D3142">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Brainy">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
</head>
<body>
    <header>
        <h1>BRAINY</h1>
        <a href="profile.php" class="profile-icon"><img src="profile_icon.png" alt="Profile Icon"></a>
    </header>
    <h2>Add New Appointment</h2>
    <form method="POST" action="appointments.php">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br><br>
        
        <label for="event">Event:</label>
        <input type="text" id="event" name="event" maxlength="255" required><br><br>
        
        <label for="user_id">User:</label>
        <select id="user_id" name="user_id">
            <option value="">Select User</option>
            <?php
            if ($user_result->num_rows > 0) {
                while ($user = $user_result->fetch_assoc()) {
                    echo "<option value='" . $user['id'] . "'>" . $user['id'] . " - " . htmlspecialchars($user['name']) . "</option>";
                }
            } else {
                echo "<option value=''>No active users available</option>";
            }
            ?>
        </select><br><br>
        
        <label for="type">Type:</label>
        <input type="text" id="type" name="type" maxlength="50" required><br><br>
        
        <input type="submit" value="Add Appointment">
    </form>

    <?php
    // Process form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $date = $_POST['date'];
        $event = $_POST['event'];
        $user_id = $_POST['user_id'];
        $type = $_POST['type'];

        $sql = "INSERT INTO personal_appointments (date, event, user_id, type)
                VALUES ('$date', '$event', '$user_id', '$type')";

        if ($conn->query($sql) === TRUE) {
            echo "New appointment added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
    <nav class="navbar">
        <a href="homePage.php" class="active">
            <img src="home.png" alt="Home" class="navbar-icon">
            <span style="font-size: 15px;">Home</span>
        </a>
        <a href="calendar.php">
            <img src="calendar.png" alt="Calendario" class="navbar-icon">
            <span>Calendario</span>
        </a>
        <a href="registrationExam.html">
            <img src="board.png" alt="Bacheca" class="navbar-icon">
            <span>Prenota</span>
        </a>
    </nav>
</body>
</html>
