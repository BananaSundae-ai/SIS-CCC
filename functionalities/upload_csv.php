<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['csv_file'])) {
    $fileTmpPath = $_FILES['csv_file']['tmp_name'];
    $fileName = $_FILES['csv_file']['name'];
    $fileSize = $_FILES['csv_file']['size'];
    $fileType = $_FILES['csv_file']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Check if the file is a CSV
    if ($fileExtension == 'csv') {
        // Process the CSV file
        if (($handle = fopen($fileTmpPath, 'r')) !== false) {
            // Read and process the CSV file
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                // Process each row
                // For example, insert data into the database
                // $column1 = $data[0];
                // $column2 = $data[1];
                // ...
            }
            fclose($handle);
            echo "CSV file has been successfully uploaded and processed.";
        } else {
            echo "Error opening the CSV file.";
        }
    } else {
        echo "Please upload a valid CSV file.";
    }
} else {
    echo "No file uploaded or invalid request.";
}
?>

