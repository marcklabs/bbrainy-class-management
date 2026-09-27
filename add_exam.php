<?php
include 'config.php';

// Handle form submission to add a new exam
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $orario = $_POST['orario'];
    $posti_disponibili = $_POST['posti_disponibili'];
    $orario_inizio_iscrizione = $_POST['orario_inizio_iscrizione'];
    $alter = $_POST['alter'];

    // Prepare the SQL statement with backticks for `alter`
    $sql = "INSERT INTO esami (nome, orario, posti_disponibili, orario_inizio_iscrizione, `alter`)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if prepare() succeeded
    if ($stmt) {
        $stmt->bind_param("ssiss", $nome, $orario, $posti_disponibili, $orario_inizio_iscrizione, $alter);

        if ($stmt->execute()) {
            echo "<p>New exam added successfully.</p>";
        } else {
            echo "<p>Error executing statement: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Error preparing statement: " . $conn->error . "</p>";
    }
}

// Fetch existing exams
$exam_query = "SELECT * FROM esami ORDER BY orario DESC";
$exam_result = $conn->query($exam_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Exam</title>
    <link rel="stylesheet" href="add_examStyle.css">
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
    <h2>Add New Exam</h2>

    <div class="form-section">
        <form method="POST" action="add_exam.php">
            <label for="nome">Exam Name:</label><br>
            <input type="text" id="nome" name="nome" maxlength="255" required><br><br>
            
            <label for="orario">Exam Date and Time:</label><br>
            <input type="datetime-local" id="orario" name="orario" required><br><br>
            
            <label for="posti_disponibili">Available Seats:</label><br>
            <input type="number" id="posti_disponibili" name="posti_disponibili" required><br><br>
            
            <label for="orario_inizio_iscrizione">Registration Start Date and Time:</label><br>
            <input type="datetime-local" id="orario_inizio_iscrizione" name="orario_inizio_iscrizione"><br><br>
            
            <label for="alter">Alternate Information:</label><br>
            <input type="text" id="alter" name="alter" maxlength="255" required><br><br>
            
            <input type="submit" value="Add Exam">
        </form>
    </div>

    <h2>Existing Exams</h2>
    <div class="exam-list">
        <?php
        if ($exam_result->num_rows > 0) {
            while ($exam = $exam_result->fetch_assoc()) {
                echo "<div class='exam-box'>";
                echo "<div class='exam-header'>" . htmlspecialchars($exam['nome']) . "</div>";
                echo "<div class='exam-detail'>Date and Time: " . htmlspecialchars($exam['orario']) . "</div>";
                echo "<div class='exam-detail'>Available Seats: " . htmlspecialchars($exam['posti_disponibili']) . "</div>";
                echo "<div class='exam-detail'>Registration Starts: " . ($exam['orario_inizio_iscrizione'] ?? 'Not specified') . "</div>";
                echo "<div class='exam-detail'>Alternate Info: " . htmlspecialchars($exam['alter']) . "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No exams found.</p>";
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
