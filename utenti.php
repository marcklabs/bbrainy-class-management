<?php
// Impostazioni di connessione al database
$servername = "localhost";  // Modifica se necessario
$username = "root";         // Modifica se necessario
$password = "";             // Modifica se necessario
$dbname = "my_bbrainy";

// Creazione della connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Controllo della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Query per ottenere tutti gli utenti
$sql = "SELECT id, username, email, last_login, created_at, updated_at, name, status FROM users";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Utenti</title>
    <link rel="stylesheet" href="utentiStyle.css">
</head>
<body>
    <header>
        <h1>BRAINY</h1>
        <a href="profile.php" class="profile-icon"><img src="profile_icon.png" alt="Profile Icon"></a>
</header>
<div class="content">
<h1>Lista degli Utenti</h1>
    <?php
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Ultimo Accesso</th><th>Creato il</th><th>Aggiornato il</th><th>Nome</th><th>Status</th></tr>";
        
        // Output di ogni riga
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["last_login"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["created_at"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["updated_at"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "Nessun utente trovato.";
    }
    
    // Chiusura della connessione
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
