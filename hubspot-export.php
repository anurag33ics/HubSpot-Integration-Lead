<?php
$obj = $_GET['obj'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.hubapi.com/crm/v3/exports/export/async',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => '{
  "exportType": "VIEW",
  "format": "CSV",
  "exportName": "' . date("Y-m-d") . '",
  "associatedObjectType": "' . $obj . '",
  "objectType": "' . $obj . '",
  "objectProperties": [
    "aim___year_asset_is_actionable",
    "aim___company_notes",
    "direct_relationship_with_aim_",
    "aim___ebitda_estimate",
    "asset_quality",
    "arr_estimate",   
    "aim___top_prospect",
    "pipeline_opportunity", 
    "name",
    "hubspot_owner_id",
    "aim___next_touch_date",
    "aim___actionable_date", 
    "State" ,
    "City",
    "description",
    "direct_relationship_with_aim_",
    "aim___known_ranking",
    "fte"   
  ],
  "language": "EN"
}',
  CURLOPT_HTTPHEADER => array(
    'authorization: Bearer API_KEY',
    'content-type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$data = json_decode($response, true);
echo $results = $data['links']["status"];

// get link of csv
// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => $results,
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'GET',
//   CURLOPT_HTTPHEADER => array(
//     'authorization: Bearer API_KEY',
//     'Cookie: __cf_bm=wTL8tTTc7HkJMDEc_Om0O5YNuoQkzGO8Gt3U2oI1U_w-1706435946-1-AZmQNyn8/oaTnv70ZUYLAp1yBmHEbPvPLS+mx9VjIKn2csZFAGon9gKhi0Rx0WXv5lzKMawUAWCBc8qlUuuRtMg=; _cfuvid=p3Q50Tkk9XZIof7hqaZ.zR0nutgT4VJQha4YvB4lAX4-1706435946411-0-604800000'
//   ),
// ));

// $response = curl_exec($curl);

// curl_close($curl);
// $urlLinkData = json_decode($response, true);
// echo "<pre>";
// print_r($urlLinkData);

// $url = $urlLinkData['result'];
//     // Use basename() function to return the base name of file 
//     $file_name = "csv/".date("Y-m-d").".csv"; 
      
//     // Use file_get_contents() function to get the file 
//     // from url and use file_put_contents() function to 
//     // save the file by using base name 
//     if (file_put_contents($file_name, file_get_contents($url))) 
//     { 
//         echo "File downloaded successfully"; 
//     } 
//     else
//     { 
//         echo "File downloading failed."; 
//     } 
