<?php
include 'config.php';
require 'vendor/autoload.php'; // Ensure PhpSpreadsheet is installed

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['export'])) {
    // Query to get username and exam name from related tables
    $query = "
        SELECT users.name AS username, esami.nome AS exam_name
        FROM registrazioni
        JOIN users ON registrazioni.user_id = users.id
        JOIN esami ON registrazioni.esame_id = esami.id
    ";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Registrations');

        // Header row
        $sheet->setCellValue('A1', 'Username');
        $sheet->setCellValue('B1', 'Exam Name');

        // Fill data
        $row = 2;
        while ($data = $result->fetch_assoc()) {
            $sheet->setCellValue('A' . $row, $data['username']);
            $sheet->setCellValue('B' . $row, $data['exam_name']);
            $row++;
        }

        // Generate Excel file
        $writer = new Xlsx($spreadsheet);
        $fileName = 'registrations.xlsx';
        $writer->save($fileName);

        // Force download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header('Cache-Control: max-age=0');
        readfile($fileName);

        // Remove file after download
        unlink($fileName);
        exit;
    } else {
        echo "<p>No registrations found.</p>";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Registrations</title>
    <style>
        .container {
            text-align: center;
            margin-top: 50px;
        }
        .export-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .export-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Export Registrations</h2>
        <form method="POST">
            <button type="submit" name="export" class="export-button">Download Excel</button>
        </form>
    </div>
</body>
</html>
