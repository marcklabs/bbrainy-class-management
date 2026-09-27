<?php

session_start();



// Assuming the user session contains user_id and username information

if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {

    // Redirect to login if user is not authenticated

    header("Location: index.php");

    exit();

}



// Check if the authenticated user is the admin (user_id: 30 and username: Marco)

if (($_SESSION['user_id'] != 30 || $_SESSION['username'] != 'Marco')&&($_SESSION['user_id'] != 36 || $_SESSION['username'] != 'Gabriele')) {

    // Deny access if not the specified admin

    echo "Access Denied. This page is restricted to admin.";

    exit();

}



// Display the admin content

?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Brainy - Admin</title>

    <link rel="stylesheet" href="adminStyle.css">

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

    <a href="homePage.php"><img src="arrow.png" alt="backArrow" class="back-arrow"></a>
    <h1>BRAINY</h1>

    </header>

        <h1>Ciao, Admin!</h1>

        <div class="rectangle1"><a href="utenti.php"><h1 class="title">UTENTI</h1></a></div>

        <div class="rectangle2"><a href="view_messages.php"><h1 class="title">MESSAGGI</h1></a></div>

        <div class="rectangle3">
            <h1 class="title">CREA</h1>
            <a href="add_announcement.php"><h2 class="new_item">Nuovo annuncio</h2></a>
            <a href="add_exam.php"><h2 class="new_item">Nuovo esame</h2></a>
            <a href="appointments.php"><h2 class="new_item">Nuovo impegno personale</h2></a>
            <a href="classappointments.php"><h2 class="new_item">Nuovo impegno di classe</h2></a>
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

