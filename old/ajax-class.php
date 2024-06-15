<?php
session_start();
ini_set('display_errors', 1);
Class Action {
private $db;
// public function __construct() {
// ob_start();
// // include 'includes/config.php';
// // $this->db = $con;
// }
// function __destruct() {
// // $this->db->close();
// ob_end_flush();
// }

public function getdata(){
extract($_POST);
     $csvFilePath = 'csv/'.$_POST['objname']."-".$_POST['date'].'.csv';

    if(file_exists($csvFilePath)){
        // Read data from the CSV file
        $csvData = $this->readCsvFile($csvFilePath);
        // Display the CSV data in a table
         return $this->displayCsvData($csvData);
    }else{
        return 1;
    }
}

// Function to display CSV data in a table
public function displayCsvData($csvData) {
    echo '<table border="1" class="table table-striped">';
    $i=0;
    foreach ($csvData as $row) {
        echo '<tr>';
        if($i==0){
            foreach ($row as $value) {
                echo '<th>' . trim($value) . '</th>';
            }
        }else{
            foreach ($row as $value) {
                echo '<td>' . trim($value) . '</td>';
            }
        }
        
        echo '</tr>';
        $i++;
    }
    echo '</table>';
}

// Function to read data from a CSV file
public function readCsvFile($filePath) {
    $csvData = [];

    if (($handle = fopen($filePath, 'r')) !== false) {
        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            $csvData[] = $data;
        }
        fclose($handle);
    }

    return $csvData;
}

public function importdata()  {
    
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.hubapi.com/crm/v3/objects/companies?properties=name%2Ccity%2Cdomain',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer pat-na1-3f5bf83f-bbf0-4d66-957e-86ef845ce4ba'
  ),
));

$response = curl_exec($curl);

// echo "<pre>";
// print_r($data);


curl_close($curl);
$data = json_decode($response, true);
$results = $data['results'];

// CSV header
$csvData = "ID,Name,City,Created Date,Last Modified Date,Archived\n";

// Process and use the data as needed
foreach ($results as $result) {
    $id = $result['id'];
    $name = isset($result['properties']['name']) ? $result['properties']['name'] : '';
    $city = isset($result['properties']['city']) ? $result['properties']['city'] : '';
    $city = isset($result['properties']['domain']) ? $result['properties']['domain'] : '';
    $createdDate = isset($result['properties']['createdate']) ? $result['properties']['createdate'] : '';
    $lastModifiedDate = isset($result['properties']['hs_lastmodifieddate']) ? $result['properties']['hs_lastmodifieddate'] : '';
    $archived = $result['archived'] ? 'true' : 'false';

    // Append data to CSV
    $csvData .= "$id,$name,$city,$createdDate,$lastModifiedDate,$archived\n";
}

// Save CSV to a file
$date =date("Y-m-d");
$filename = "csv/". $date.'.csv';
file_put_contents($filename, $csvData);
return "Data imported successfully";
}


}