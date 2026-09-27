<?php
include 'config.php';

// Handle deletion if a delete request is made
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $delete_query = "DELETE FROM messages WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
}

// Fetch messages along with user names
$message_query = "
    SELECT messages.id, messages.message, messages.created_at, users.name AS username 
    FROM messages 
    JOIN users ON messages.user_id = users.id 
    ORDER BY messages.created_at DESC";
$message_result = $conn->query($message_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    li
    <title>View Messages</title>
    <title>BRAINY</title>
    <link rel="stylesheet" href="view_messagesStyle.css">
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
    <h2>User Messages</h2>

    <?php
    if ($message_result->num_rows > 0) {
        while ($message = $message_result->fetch_assoc()) {
            echo "<div class='message-box'>";
            echo "<div class='message-details'>";
            echo "<div class='message-header'>" . htmlspecialchars($message['username']) . "</div>";
            echo "<div class='message-date'>" . htmlspecialchars($message['created_at']) . "</div>";
            echo "<div class='message-content'>" . nl2br(htmlspecialchars($message['message'])) . "</div>";
            echo "</div>";
            echo "<form method='POST' style='margin-left: 10px;'>";
            echo "<input type='hidden' name='delete_id' value='" . $message['id'] . "'>";
            echo "<button type='submit' class='delete-button'>Delete</button>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "<p>No messages found.</p>";
    }

    $conn->close();
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
