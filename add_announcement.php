<?php
include 'config.php';

// Handle form submission to add a new announcement
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $announcement = $_POST['announcement'];

    // Prepare the SQL statement
    $sql = "INSERT INTO announcements (date, announcement) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if prepare() succeeded
    if ($stmt) {
        $stmt->bind_param("ss", $date, $announcement);

        if ($stmt->execute()) {
            echo "<p>New announcement added successfully.</p>";
        } else {
            echo "<p>Error executing statement: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Error preparing statement: " . $conn->error . "</p>";
    }
}

// Fetch existing announcements
$announcement_query = "SELECT * FROM announcements ORDER BY date DESC";
$announcement_result = $conn->query($announcement_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Announcement</title>
    <link rel="stylesheet" href="view_announcementStyle.css">
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
    <h2>Add New Announcement</h2>

    <div class="form-section">
        <form method="POST" action="add_announcement.php">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required><br><br>
            
            <label for="announcement">Announcement:</label><br>
            <textarea id="announcement" name="announcement" rows="4" cols="50" required></textarea><br><br>
            
            <input type="submit" value="Add Announcement">
        </form>
    </div>

    <h2>Existing Announcements</h2>
    <div class="announcement-list">
        <?php
        if ($announcement_result->num_rows > 0) {
            while ($announcement = $announcement_result->fetch_assoc()) {
                echo "<div class='announcement-box'>";
                echo "<div class='announcement-header'>Announcement on " . htmlspecialchars($announcement['date']) . "</div>";
                echo "<div class='announcement-content'>" . nl2br(htmlspecialchars($announcement['announcement'])) . "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No announcements found.</p>";
        }
        $conn->close();
        ?>
    </div>
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
