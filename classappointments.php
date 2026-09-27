<?php
// Include your database configuration
include('config.php');

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for adding a new appointment
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $date = $_POST['date'];
    $event = $_POST['event'];

    // Insert new appointment
    $stmt = $conn->prepare("INSERT INTO class_appointments (date, event) VALUES (?, ?)");
    $stmt->bind_param("ss", $date, $event);
    $stmt->execute();
    $stmt->close();
}

// Handle delete request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];

    // Delete appointment
    $stmt = $conn->prepare("DELETE FROM class_appointments WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Fetch existing appointments
$result = $conn->query("SELECT * FROM class_appointments");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Appointments</title>
    <link rel="stylesheet" href="classappointmentsStyle.css">
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
        <a href="admin.php"><img src="arrow.png" alt="backArrow" class="back-arrow"></a>
        <h1>BRAINY</h1>
    </header>
    <h2>Class Appointments</h2>
    
    <!-- Form to add a new appointment -->
    <form action="" method="POST" class="inserimento">
        <label for="date">Date:</label><br>
        <input type="date" id="date" name="date" required><br>
        
        <label for="event">Event:</label><br>
        <input type="text" id="event" name="event" required><br>
        
        <button type="submit" name="add">Add Appointment</button>
    </form>

    <h2>Existing Appointments</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Event</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"]. "</td>
                        <td>" . $row["date"]. "</td>
                        <td>" . $row["event"]. "</td>
                        <td>
                            <form action='' method='POST' style='display:inline;'>
                                <input type='hidden' name='delete_id' value='" . $row["id"] . "'>
                                <button type='submit'>Delete</button>
                            </form>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No appointments found</td></tr>";
        }
        ?>
    </table>

    <?php $conn->close(); ?>
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
