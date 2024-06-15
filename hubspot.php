<?php

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
    'Authorization: Bearer API KEY'
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


// echo $response;
