<?php
// Function to display CSV data in a table
function displayCsvData($csvData) {
    echo '<table border="1">';
    foreach ($csvData as $row) {
        echo '<tr>';
        foreach ($row as $value) {
            echo '<td>' . $value . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}

// Function to read data from a CSV file
function readCsvFile($filePath) {
    $csvData = [];

    if (($handle = fopen($filePath, 'r')) !== false) {
        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            $csvData[] = $data;
        }
        fclose($handle);
    }

    return $csvData;
}

// Specify the path to your CSV file
$csvFilePath = 'path/to/your/file.csv';

// Read data from the CSV file
$csvData = readCsvFile($csvFilePath);

// Display the CSV data in a table
displayCsvData($csvData);
?>
