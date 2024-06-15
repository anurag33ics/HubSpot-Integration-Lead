

<?php
session_start();
ini_set('display_errors', 1);
class Action
{
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

    public function getdata()
    {
        extract($_POST);
        $csvFilePath = 'csv/' . $_POST['objname'] . "-" . $_POST['date'] . '.csv';

        if (file_exists($csvFilePath)) {
            // Read data from the CSV file
            $csvData = $this->readCsvFile($csvFilePath);
            // Display the CSV data in a table
            return $this->displayCsvData($csvData);
        } else {
            return 1;
        }
    }

    // Function to display CSV data in a table
    public function displayCsvData($csvData)
    {
        echo '<table border="1" class="table table-striped">';
        $i = 0;
        foreach ($csvData as $row) {
            echo "<tr  >";
            if ($i == 0) {
                //  echo '<th>' . trim($row[116]) . '</th>';
                // die;
                foreach ($row as $value) {
                    echo "<th>" . trim($value) . "</th>";
                }
            } else {
                // if ($row[8] == "Yes" && $row[7] == "Yes") {
                    foreach ($row as $value) {
                        echo '<td>' . trim($value) . '</td>';
                    }
                // }
            }

            echo '</tr>';
            $i++;
        }
        echo '</table>';
    }
// differnce array
public function differnceCsvData($csvData, $filepath, $filepath1, $tblid)
{
    $res= '<table border="1" class="table differncetbl" id="'.$tblid.'">';
    // $handle1 = fopen($filepath, "r");
    $res .= "<tr >";
        $m=1;
        $arr=[0,17,18,19,20,21,22];
    $res .= "<tr style='background-color: #14354a; border: 1px solid black;'>
    <td style='width: 112px; border: 1px solid black; '></td>
    <td style='width: 138px; border: 1px solid black; text-align: center;color: #fff' colspan='2'>Date</td>
    <td style='width: 96px; border: 1px solid black; text-align: center; color: #fff' colspan='2'>Location</td>
    <td style='width: 23px; border: 1px solid black;'></td>
    <td style='width: 101px; border: 1px solid black;'></td>
    <td style='width: 57px; border: 1px solid black;'></td>
    <td style='width: 81px; border: 1px solid black; text-align: center; color: #fff' colspan='2'>Ranking</td>
    <td style='width: 81px; border: 1px solid black;'></td>
    <td style='width: 52px; border: 1px solid black;'></td>
    <td style='width: 52px; border: 1px solid black;'></td>
    <td style='width: 70px; border: 1px solid black;'></td>
    <td style='width: 50px; border: 1px solid black;'></td>
    <td style='width: 22px; border: 1px solid black;'></td>
    </tr>
    <tr style='background-color: #14354a; border: 1px solid black; '>
    <td style='width: 112px; border: 1px solid black; color: #fff'>Company</td>
    <td style='width: 84px; border: 1px solid black; color: #fff'>Next Touch</td>
    <td style='width: 54px; border: 1px solid black; color: #fff'>Actionable Date</td>
    <td style='width: 47px; border: 1px solid black; color: #fff'>State</td>
    <td style='width: 49px; border: 1px solid black; color: #fff'>City</td>
    <td style='width: 23px; border: 1px solid black; color: #fff'>Description</td>
    <td style='width: 101px; border: 1px solid black; color: #fff '>Notes and Next Steps</td>
    <td style='width: 57px; border: 1px solid black; color: #fff'>FTE</td>
    <td style='width: 29.4625px; border: 1px solid black; color: #fff '>AIM Ranking</td>
    <td style='width: 51.5375px; border: 1px solid black; color: #fff'>Known Ranking</td>
    <td style='width: 81px; border: 1px solid black; color: #fff'>Rev</td>
    <td style='width: 52px; border: 1px solid black; color: #fff'>Know Mgmt</td>
    <td style='width: 52px; border: 1px solid black; color: #fff'>Lead</td>
    <td style='width: 70px; border: 1px solid black; color: #fff'>EBITDA</td>
    <td style='width: 50px; border: 1px solid black; color: #fff'>Pipeline Opportunity</td>
    <td style='width: 22px; border: 1px solid black; color: #fff'>AIM - Actionability Date</td>
    </tr>";
    
    if($tblid=="")
        $res = '';
    // $res .= "<tr><th>Record ID</th><th>AIM - Actionability Date</th><th>AIM - Company Notes</th><th>AIM - Direct Relationship</th><th>AIM - EBITDA Estimate</th><th>AIM - Ranking</th><th>AIM - Revenue Estimate</th><th>AIM - Top Prospect</th><th>Pipeline Opportunity</th></tr>";
    foreach ($csvData as $row) {
        $cols='';
        $m=0;
        $color='';
        $rowid=0;
        // $row[9];
                foreach ($row as $value) {
                    if($m==0)
                        $rowid= trim($value);
                    else{
                        if( !in_array($m,$arr)){
                            if($m==1)
                            {$cols.= "<td style=' border:1px solid black'> 
                            <a href='https://app.hubspot.com/contacts/23372725/record/0-2/$rowid' target='_blank'>" . $value . '</a></td>';}
                            else if($m==14 || $m==11 || $m==8){
                                if($value==0 || $value<0)
                                    $cols.= "<td style=' border:1px solid black'>&#36;0</td>";
                                else
                                $cols.= "<td style=' border:1px solid black'>" . htmlspecialchars($value) . '</td>';
                            }
                            else
                            $cols.= "<td style=' border:1px solid black'>" . htmlspecialchars($value) . '</td>';
                        }
                            
                    else
                        $color = trim($value);
                    }
                    
                    $m++;
            }
            $res.= '<tr class="viewDiff" data-color="'.$color.'" data-id="'.$rowid.'" 
            data-filepath="'.$filepath.'" data-filepath1="'.$filepath1.'"
             style="background-color:'.$color.' !important ">'. $cols.'</tr>';
    }
     if($tblid=="")
      return $res;
   return  $res.= '</table>';
}
    // Function to read data from a CSV file
    public function readCsvFile($filePath)
    {
        $csvData = [];

        if (($handle = fopen($filePath, 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $csvData[] = $data;
                // print_r($data);
                // die;
            }
            fclose($handle);
        }

        return $csvData;
    }

    public function importdata()
    {

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
        $date = date("Y-m-d");
        $filename = "csv/" . $date . '.csv';
        file_put_contents($filename, $csvData);
        return "Data imported successfully";
    }

    // 

    function compareCSV($file1, $file2)
    {
        $handle1 = fopen($file1, "r");
        $handle2 = fopen($file2, "r");

        $differences = [];

        while (($row1 = fgetcsv($handle1)) !== false && ($row2 = fgetcsv($handle2)) !== false) {
            // Compare each cell in the row
            for ($i = 0; $i < count($row1); $i++) {
                if ($row1[$i] != $row2[$i]) {
                    $differences[] = "Row " . ($i + 1) . ", Column " . ($i + 1) . ": $row1[$i] is different from $row2[$i]";
                }
            }
        }

        fclose($handle1);
        fclose($handle2);

        return $differences;
    }
    function comparedata()
    {
        extract($_POST);
        //  $csvFilePath = 'csv/'.$_POST['objname']."-".$_POST['date'].'.csv';
         $file1 = 'csv/' . $_POST['objname'] . "-" . $_POST['date'] . '.csv';
         $file2 = 'csv/' . $_POST['objname'] . "-" . $_POST['date2'] . '.csv';

        // $differences = $this->compareCSV($file1, $file2);
        // $file1Arry = $this->makeAray($file1, "2");
        $file2Arry = $this->makeAray($file2, "1",8,7);
        $key = 'RecordID';
        $file1Arry=[];
        $handle1 = fopen($file1, "r");
        $m=1;
        while (($row1 = fgetcsv($handle1)) !== false) {
            if ($m > 1) {
                $file1Arry[] = array(
                    "RecordID" => $row1[0],
                    "CompanyName" => $row1[9],
                    "AIM-NextTouchDate" => $row1[11],
                    "AIM-ActionableDate" => $row1[12],
                    "State-Region" => $row1[13],
                    "City" => $row1[14],
                    "Description" => $row1[15],
                    "AIM-CompanyNotes" => $row1[2],
                    "FTE" => $row1[17],
                    "AIM-Ranking" => $row1[5],
                    "AIM - Known Ranking" => $row1[16],
                    "AIM-RevenueEstimate" => $row1[6],
                    "AIM-DirectRelationship" => $row1[3],
                    "CompanyOwner" => $row1[10],
                    "AIM-EBITDA-Estimate" => $row1[4],                    
                    "PipelineOpportunity" => $row1[8],
                    "AIM-ActionabilityDate" => $row1[1],                
                                        
                    "AIM-TopProspect" => $row1[7],
                    "AIM-ActionableDate" => $row1[12],
                    "CreateDate" => $row1[18],
                    "LastModifiedDate" => $row1[19],
                    "Associated Company" => $row1[20],
                    "Associated Company IDs" => $row1[21],
                    "rowcolor"=>"white"
                );
            }
            $m++;
        }
        // Find common objects based on the specified key
        $commonObjects = $this->findCommonObjects($file2Arry, $file1Arry, $key);
        // print_r($commonObjects);
        
        foreach($commonObjects as $val){
              $pos= array_search($val[$key], array_column($file1Arry, $key));
             if($file1Arry[$pos]['AIM-ActionabilityDate']!=$val['AIM-ActionabilityDate'] ||
             $file1Arry[$pos]['AIM-CompanyNotes']!=$val['AIM-CompanyNotes']||
             $file1Arry[$pos]['AIM-DirectRelationship']!=$val['AIM-DirectRelationship']||
             $file1Arry[$pos]['AIM-EBITDA-Estimate']!=$val['AIM-EBITDA-Estimate']||
             $file1Arry[$pos]['AIM-Ranking']!=$val['AIM-Ranking']||
             $file1Arry[$pos]['AIM-RevenueEstimate']!=$val['AIM-RevenueEstimate'] ){
                // $finalobject[]= $val;
                $pos2= array_search($val[$key], array_column($file2Arry, $key));
                $file2Arry[$pos2]['rowcolor']="rgb(226, 239, 218)";

             }
        }
        // print_r($finalobject);
        
        $file3Arry = $this->makeAray($file2, "1",3,8);
       
        foreach($file2Arry as $val){
            $pos= array_search($val[$key], array_column($file3Arry, $key));
            unset($file3Arry[$pos]);
        }
        

        // 
        $commonObjects = $this->findCommonObjects($file3Arry, $file1Arry, $key);
        

        foreach($commonObjects as $val){
              $pos= array_search($val[$key], array_column($file1Arry, $key));
             if($file1Arry[$pos]['AIM-ActionabilityDate']!=$val['AIM-ActionabilityDate'] ||
             $file1Arry[$pos]['AIM-CompanyNotes']!=$val['AIM-CompanyNotes']||
             $file1Arry[$pos]['AIM-DirectRelationship']!=$val['AIM-DirectRelationship']||
             $file1Arry[$pos]['AIM-EBITDA-Estimate']!=$val['AIM-EBITDA-Estimate']||
             $file1Arry[$pos]['AIM-Ranking']!=$val['AIM-Ranking']||
             $file1Arry[$pos]['AIM-RevenueEstimate']!=$val['AIM-RevenueEstimate'] ){
                // $finalobject[]= $val;
                $pos2= array_search($val[$key], array_column($file3Arry, $key));
                $file3Arry[$pos2]['rowcolor']="rgb(226, 239, 218)";

             }
        }
        
        
        // echo "<pre>";
        // print_r($newcompany);

// section 3
$file4Arry = $this->makeAray($file2, "1",0,0);
       
        foreach($file2Arry as $val){
            $pos= array_search($val[$key], array_column($file4Arry, $key));
            unset($file4Arry[$pos]);
        }
        foreach($file3Arry as $val){
            if(isset($val[$key])){
                $pos= array_search($val[$key], array_column($file4Arry, $key));
                unset($file4Arry[$pos]);
            }
        }

         $commonObjects = $this->findCommonObjects($file4Arry, $file1Arry, $key);
        

        foreach($commonObjects as $val){
              $pos= array_search($val[$key], array_column($file1Arry, $key));
             if($file1Arry[$pos]['AIM-ActionabilityDate']!=$val['AIM-ActionabilityDate'] ||
             $file1Arry[$pos]['AIM-CompanyNotes']!=$val['AIM-CompanyNotes']||
             $file1Arry[$pos]['AIM-DirectRelationship']!=$val['AIM-DirectRelationship']||
             $file1Arry[$pos]['AIM-EBITDA-Estimate']!=$val['AIM-EBITDA-Estimate']||
             $file1Arry[$pos]['AIM-Ranking']!=$val['AIM-Ranking']||
             $file1Arry[$pos]['AIM-RevenueEstimate']!=$val['AIM-RevenueEstimate'] ){
                // $finalobject[]= $val;
                $pos2= array_search($val[$key], array_column($file4Arry, $key));
                $file4Arry[$pos2]['rowcolor']="rgb(226, 239, 218)";

             }
        }

// for section 4
$file5Arry = $this->makeAray($file2, "1",8,-1);
    
    
            $toppriority= $this->differnceCsvData($file2Arry, $file1,$file2, "toppriority");
            $toppriorityrows= $this->differnceCsvData($file2Arry, $file1,$file2, "");
            
            
        // print_r($toppriority);
        $newcompany = $this->differnceCsvData($file3Arry, $file1,$file2, "newcompany");
        $newcompanyrows = $this->differnceCsvData($file3Arry, $file1,$file2, "");
        $generalpipeline = $this->differnceCsvData($file4Arry, $file1,$file2, "generalpipeline");
        $generalpipelinerows = $this->differnceCsvData($file4Arry, $file1,$file2, "");
        $allpipeline = $this->differnceCsvData( $file5Arry, $file1,$file2, "allpipeline");
        $allpipelinerows = $this->differnceCsvData( $file5Arry, $file1,$file2, "");
        // export all
        $res= '<table border="1" class="table " id="exportAll" style="display:none">';
        $res .= "<thead>
        <tr style='background-color: #14354a; border: 1px solid black; '>
        <th style='width: 112px; border: 1px solid black; color: #fff'>Company</th>
        <th style='width: 84px; border: 1px solid black; color: #fff'>Next Touch</th>
        <th style='width: 54px; border: 1px solid black; color: #fff'>Actionable Date</th>
        <th style='width: 47px; border: 1px solid black; color: #fff'>State</th>
        <th style='width: 49px; border: 1px solid black; color: #fff'>City</th>
        <th style='width: 23px; border: 1px solid black; color: #fff'>Description</th>
        <th style='width: 101px; border: 1px solid black; color: #fff '>Notes and Next Steps</th>
        <th style='width: 57px; border: 1px solid black; color: #fff'>FTE</th>
        <th style='width: 29.4625px; border: 1px solid black; color: #fff '>AIM Ranking</th>
        <th style='width: 51.5375px; border: 1px solid black; color: #fff'>Known Ranking</th>
        <th style='width: 81px; border: 1px solid black; color: #fff'>Rev</th>
        <th style='width: 52px; border: 1px solid black; color: #fff'>Know Mgmt</th>
        <th style='width: 52px; border: 1px solid black; color: #fff'>Lead</th>
        <th style='width: 70px; border: 1px solid black; color: #fff'>EBITDA</th>
        <th style='width: 50px; border: 1px solid black; color: #fff'>Pipeline Opportunity</th>
        <th style='width: 22px; border: 1px solid black; color: #fff'>AIM - Actionability Date</th>
        <th style='width: 22px; border: 1px solid black; color: #fff'>Record ID</th>
        <th style='width: 22px; border: 1px solid black; color: #fff'>Highlighted</th>
        <th style='width: 22px; border: 1px solid black; color: #fff'>Section1</th>
        <th style='width: 22px; border: 1px solid black; color: #fff'>Section2</th>
        <th style='width: 22px; border: 1px solid black; color: #fff'>Section3</th>
        <th style='width: 22px; border: 1px solid black; color: #fff'>Section4</th>
        </tr>
        </thead>";
        
        $allRow= $this->allDataExport($file2Arry, "1", "", "", "");
        $allRow .= $this->allDataExport($file3Arry, "", "2", "", "");
        $allRow .= $this->allDataExport($file4Arry, "", "", "3", "");
        $allRow .= $this->allDataExport($file5Arry, "", "", "", "4");
        $res .= "<tbody>".$allRow."</tbody></table>";
        return $toppriority."!@#$%".$newcompany."!@#$%".$generalpipeline."!@#$%".$allpipeline."!@#$%".$res."!@#$%".$toppriorityrows."!@#$%".$newcompanyrows."!@#$%".$generalpipelinerows."!@#$%".$allpipelinerows;
        // Output the common objects
        // return $toppriority."!@#$%".$newcompany."!@#$%".$generalpipeline."!@#$%".$allpipeline;
        // Output the common objects
    }

    
    function makeAray($file, $type, $index1, $index2)
    {
        // echo "type-".$type;
        $handle1 = fopen($file, "r");
        $arr = [];
        if ($type == "1") {
            while (($row1 = fgetcsv($handle1)) !== false) {
                if($index1==0 && $index2==0){
                    $arr[] = array(
                        "RecordID" => $row1[0],
                        // "RecordID" => $row1[0],
                    "CompanyName" => $row1[9],
                    "AIM-NextTouchDate" => $row1[11],
                    "AIM-ActionableDate" => $row1[12],
                    "State-Region" => $row1[13],
                    "City" => $row1[14],
                    "Description" => $row1[15],
                    "AIM-CompanyNotes" => $row1[2],
                    "FTE" => $row1[17],
                    "AIM-Ranking" => $row1[5],
                    "AIM - Known Ranking" => $row1[16],
                    "AIM-RevenueEstimate" => $row1[6],
                    "AIM-DirectRelationship" => $row1[3],
                    "CompanyOwner" => $row1[10],
                    "AIM-EBITDA-Estimate" => $row1[4],                  
                    "PipelineOpportunity" => $row1[8],
                    "AIM-ActionabilityDate" => $row1[1],                
                    "AIM-TopProspect" => $row1[7],
                    "AIM-ActionableDate" => $row1[12],
                    "CreateDate" => $row1[18],
                    "LastModifiedDate" => $row1[19],
                    "Associated Company" => $row1[20],
                    "Associated Company IDs" => $row1[21],
                        "rowcolor"=>"white"
                    );
                }else if($row1[$index1] == "Yes" && $index2==-1){
                    $arr[] = array(
                        "RecordID" => $row1[0],
                    "CompanyName" => $row1[9],
                    "AIM-NextTouchDate" => $row1[11],
                    "AIM-ActionableDate" => $row1[12],
                    "State-Region" => $row1[13],
                    "City" => $row1[14],
                    "Description" => $row1[15],
                    "AIM-CompanyNotes" => $row1[2],
                    "FTE" => $row1[17],
                    "AIM-Ranking" => $row1[5],
                    "AIM - Known Ranking" => $row1[16],
                    "AIM-RevenueEstimate" => $row1[6],
                    "AIM-DirectRelationship" => $row1[3],
                    "CompanyOwner" => $row1[10],
                    "AIM-EBITDA-Estimate" => $row1[4],                    
                    "PipelineOpportunity" => $row1[8],
                    "AIM-ActionabilityDate" => $row1[1],                
                    "AIM-TopProspect" => $row1[7],
                    "AIM-ActionableDate" => $row1[12],
                    "CreateDate" => $row1[18],
                    "LastModifiedDate" => $row1[19],
                    "Associated Company" => $row1[20],
                    "Associated Company IDs" => $row1[21],
                        "rowcolor"=>"white"
                    );
                }
                else if ($row1[$index1] == "Yes" && $row1[$index2] == "Yes") {
                    $arr[] = array(
                        "RecordID" => $row1[0],
                        "CompanyName" => $row1[9],
                        "AIM-NextTouchDate" => $row1[11],
                        "AIM-ActionableDate" => $row1[12],
                        "State-Region" => $row1[13],
                        "City" => $row1[14],
                        "Description" => $row1[15],
                        "AIM-CompanyNotes" => $row1[2],
                        "FTE" => $row1[17],
                        "AIM-Ranking" => $row1[5],
                        "AIM - Known Ranking" => $row1[16],
                        "AIM-RevenueEstimate" => $row1[6],
                        "AIM-DirectRelationship" => $row1[3],
                        "CompanyOwner" => $row1[10],
                        "AIM-EBITDA-Estimate" => $row1[4],                    
                    "PipelineOpportunity" => $row1[8],
                    "AIM-ActionabilityDate" => $row1[1],                
                        "AIM-TopProspect" => $row1[7],
                        "AIM-ActionableDate" => $row1[12],
                        "CreateDate" => $row1[18],
                        "LastModifiedDate" => $row1[19],
                        "Associated Company" => $row1[20],
                        "Associated Company IDs" => $row1[21],
                        "rowcolor"=>"white"
                    );
                }
            }
        } 
        

        return $arr;
    }
    function findCommonObjects($array1, $array2, $key)
    {
        $commonObjects = array();

        // Create a lookup table for objects in $array2 based on the specified key
        $lookup = array();
        foreach ($array2 as $obj) {
            $lookup[$obj[$key]] = $obj;
        }

        // Iterate through $array1 and check if the key exists in the lookup table
        foreach ($array1 as $obj) {
            if (isset($lookup[$obj[$key]])) {
                $commonObjects[] = $obj;
            }
        }

        return $commonObjects;
    }


    function verifyLogin(){
        extract($_POST);
        $preusername ="pipelinesortingdata";
        $prepassword= "sorting@##pipeline";
        if($username==$preusername && $prepassword==$password){
            session_start();
            $_SESSION['username']= $username;
            $_SESSION['password']= $password;
            return 1;
        }else{
            return 0;
        }
    }
function logout(){
    session_start();
    session_unset();
    session_destroy();
    return 1;

}

function getDiffData()  {
    extract($_POST);
    $handle1 = fopen($_POST['filepath'], "r");
    $m=1;
    while (($row1 = fgetcsv($handle1)) !== false) {
        if ($m > 1) {
            $file1Arry[] = array(
                "RecordID" => $row1[0],
                "CompanyName" => $row1[9],
                "AIM-NextTouchDate" => $row1[11],
                "AIM-ActionableDate" => $row1[12],
                "State-Region" => $row1[13],
                "City" => $row1[14],
                "Description" => $row1[15],
                "AIM-CompanyNotes" => $row1[2],
                "FTE" => $row1[17],
                "AIM-Ranking" => $row1[5],
                "AIM - Known Ranking" => $row1[16],
                "AIM-RevenueEstimate" => $row1[6],
                "AIM-DirectRelationship" => $row1[3],
                "CompanyOwner" => $row1[10],
                "AIM-EBITDA-Estimate" => $row1[4],                    
            "PipelineOpportunity" => $row1[8],
            "AIM-ActionabilityDate" => $row1[1],                
                "AIM-TopProspect" => $row1[7],
                "AIM-ActionableDate" => $row1[12],
                "CreateDate" => $row1[18],
                "LastModifiedDate" => $row1[19],
                "Associated Company" => $row1[20],
                "Associated Company IDs" => $row1[21],
                "rowcolor"=>"white"
            );
        }
        $m++;
    }
    $handle2 = fopen($_POST['filepath1'], "r");
    $m=1;
    while (($row1 = fgetcsv($handle2)) !== false) {
        if ($m > 1) {
            $file2Arry[] = array(
                "RecordID" => $row1[0],
                "CompanyName" => $row1[9],
                "AIM-NextTouchDate" => $row1[11],
                "AIM-ActionableDate" => $row1[12],
                "State-Region" => $row1[13],
                "City" => $row1[14],
                "Description" => $row1[15],
                "AIM-CompanyNotes" => $row1[2],
                "FTE" => $row1[17],
                "AIM-Ranking" => $row1[5],
                "AIM - Known Ranking" => $row1[16],
                "AIM-RevenueEstimate" => $row1[6],
                "AIM-DirectRelationship" => $row1[3],
                "CompanyOwner" => $row1[10],
                "AIM-EBITDA-Estimate" => $row1[4],                    
            "PipelineOpportunity" => $row1[8],
            "AIM-ActionabilityDate" => $row1[1],                
                "AIM-TopProspect" => $row1[7],
                "AIM-ActionableDate" => $row1[12],
                "CreateDate" => $row1[18],
                "LastModifiedDate" => $row1[19],
                "Associated Company" => $row1[20],
                "Associated Company IDs" => $row1[21],
                "rowcolor"=>"white"
            );
        }
        $m++;
    }
    $rowid =$_POST['rowid'];
    $key = 'RecordID';
        
    $pos1= array_search($rowid, array_column($file1Arry, $key));
    $pos2= array_search($rowid, array_column($file2Arry, $key));
    $arr1[]= $file1Arry[$pos1];
    $arr2[]= $file2Arry[$pos2];
    // print_r($arr2);
    if($arr1[0]['AIM-ActionabilityDate']!=$arr2[0]['AIM-ActionabilityDate'] ){
        if($arr1[0]['AIM-ActionabilityDate']=="")
            $arr1[0]['AIM-ActionabilityDate'] = "<span style='color:#e2efda'>-</span>";
        else
            $arr1[0]['AIM-ActionabilityDate'] = "<span style='color:#e2efda'>".$arr1[0]['AIM-ActionabilityDate']."</span>";
    }
    
    if($arr1[0]['AIM-CompanyNotes']!=$arr2[0]['AIM-CompanyNotes'] ){
        if($arr1[0]['AIM-CompanyNotes']=="")
            $arr1[0]['AIM-CompanyNotes'] = "<span style='color:#e2efda'>-</span>";
        else
            $arr1[0]['AIM-CompanyNotes'] = "<span style='color:#e2efda'>".$arr1[0]['AIM-CompanyNotes']."</span>";
    }
    if($arr1[0]['AIM-DirectRelationship']!=$arr2[0]['AIM-DirectRelationship'] ){
        if($arr1[0]['AIM-DirectRelationship']=="")
            $arr1[0]['AIM-DirectRelationship'] = "<span style='color:#e2efda'>-</span>";
        else
        $arr1[0]['AIM-DirectRelationship'] = "<span style='color:#e2efda'    >".$arr1[0]['AIM-DirectRelationship']."</span>";
            
    }
    if($arr1[0]['AIM-EBITDA-Estimate']!=$arr2[0]['AIM-EBITDA-Estimate'] ){
        
        if($arr1[0]['AIM-EBITDA-Estimate']=="")
            $arr1[0]['AIM-EBITDA-Estimate'] = "<span style='color:#e2efda'>-</span>";
        else
            $arr1[0]['AIM-EBITDA-Estimate'] = "<span style='color:#e2efda'>".$arr1[0]['AIM-EBITDA-Estimate']."</span>";
    }
    if($arr1[0]['AIM-Ranking']!=$arr2[0]['AIM-Ranking'] ){
        if($arr1[0]['AIM-Ranking']=="")
        $arr1[0]['AIM-Ranking'] = "<span style='color:#e2efda'>-</span>";
        else
        $arr1[0]['AIM-Ranking'] = "<span style='color:#e2efda'>".$arr1[0]['AIM-Ranking']."</span>";
    }
    if($arr1[0]['AIM-RevenueEstimate']!=$arr2[0]['AIM-RevenueEstimate'] ){
        if($arr1[0]['AIM-RevenueEstimate']=="")
        $arr1[0]['AIM-RevenueEstimate'] = "<span style='color:#e2efda'>-</span>";
        else
        $arr1[0]['AIM-RevenueEstimate'] = "<span style='color:#e2efda'>".$arr1[0]['AIM-RevenueEstimate']."</span>";
    }
    
    return $this->differnceCsvDataForPopUp($arr1 , $_POST['filepath'],$_POST['filepath1'],"Difference"); 
}


public function allDataExport($csvData, $section1, $section2, $section3, $section4)
{
    $m=1;
    $arr=[0,17,18,19,20,21,22];
    $res = "";
    
    foreach ($csvData as $row) {
        $cols='';
        $m=0;
        $color='';
        $rowid=0;
        // $row[9];
                foreach ($row as $value) {
                    if($m==0)
                        $rowid= trim($value);
                    else{
                        if( !in_array($m,$arr))
                            $cols.= "<td style=' border:1px solid black'>" .htmlspecialchars(trim($value)) . '</td>';
                         else
                            $color = trim($value);
                    }
                    
                    $m++;
            }

            $cols.= "<td style=' border:1px solid black'>" .htmlspecialchars(trim($rowid)) . '</td>';
            if($color!='white'){
                $cols.= "<td style=' border:1px solid black'>Yes</td>";
            }else{
                $cols.= "<td style=' border:1px solid black'>No</td>";
            }
            $cols .="<td style=' border:1px solid black'>$section1</td>
            <td style=' border:1px solid black'>$section2</td>
            <td style=' border:1px solid black'>$section3</td>
            <td style=' border:1px solid black'>$section4</td>";
            if($rowid!=0 && $rowid!="")
                $res.= '<tr class="viewDiff">'. $cols.'</tr>';
            // $res.= '<tr class="viewDiff">'. $cols.'</tr>';
    }
   return  $res;
}

public function differnceCsvDataForPopUp($csvData, $filepath, $filepath1, $tblid)
{
    $res= '<table border="1" class="table differncetbl" id="'.$tblid.'">';
    // $handle1 = fopen($filepath, "r");
    $res .= "<tr >";
        $m=1;
        $arr=[0,17,18,19,20,21,22];
    $res .= "<tr style='background-color: #14354a; border: 1px solid black;'>
    <td style='width: 112px; border: 1px solid black; '></td>
    <td style='width: 138px; border: 1px solid black; text-align: center;color: #fff' colspan='2'>Date</td>
    <td style='width: 96px; border: 1px solid black; text-align: center; color: #fff' colspan='2'>Location</td>
    <td style='width: 23px; border: 1px solid black;'></td>
    <td style='width: 101px; border: 1px solid black;'></td>
    <td style='width: 57px; border: 1px solid black;'></td>
    <td style='width: 81px; border: 1px solid black; text-align: center; color: #fff' colspan='2'>Ranking</td>
    <td style='width: 81px; border: 1px solid black;'></td>
    <td style='width: 52px; border: 1px solid black;'></td>
    <td style='width: 52px; border: 1px solid black;'></td>
    <td style='width: 70px; border: 1px solid black;'></td>
    <td style='width: 50px; border: 1px solid black;'></td>
    <td style='width: 22px; border: 1px solid black;'></td>
    </tr>
    <tr style='background-color: #14354a; border: 1px solid black; '>
    <td style='width: 112px; border: 1px solid black; color: #fff'>Company</td>
    <td style='width: 84px; border: 1px solid black; color: #fff'>Next Touch</td>
    <td style='width: 54px; border: 1px solid black; color: #fff'>Actionable Date</td>
    <td style='width: 47px; border: 1px solid black; color: #fff'>State</td>
    <td style='width: 49px; border: 1px solid black; color: #fff'>City</td>
    <td style='width: 23px; border: 1px solid black; color: #fff'>Description</td>
    <td style='width: 101px; border: 1px solid black; color: #fff '>Notes and Next Steps</td>
    <td style='width: 57px; border: 1px solid black; color: #fff'>FTE</td>
    <td style='width: 29.4625px; border: 1px solid black; color: #fff '>AIM Ranking</td>
    <td style='width: 51.5375px; border: 1px solid black; color: #fff'>Known Ranking</td>
    <td style='width: 81px; border: 1px solid black; color: #fff'>Rev</td>
    <td style='width: 52px; border: 1px solid black; color: #fff'>Know Mgmt</td>
    <td style='width: 52px; border: 1px solid black; color: #fff'>Lead</td>
    <td style='width: 70px; border: 1px solid black; color: #fff'>EBITDA</td>
    <td style='width: 50px; border: 1px solid black; color: #fff'>Pipeline Opportunity</td>
    <td style='width: 22px; border: 1px solid black; color: #fff'>AIM - Actionability Date</td>
    </tr>";
    // $res .= "<tr><th>Record ID</th><th>AIM - Actionability Date</th><th>AIM - Company Notes</th><th>AIM - Direct Relationship</th><th>AIM - EBITDA Estimate</th><th>AIM - Ranking</th><th>AIM - Revenue Estimate</th><th>AIM - Top Prospect</th><th>Pipeline Opportunity</th></tr>";
    foreach ($csvData as $row) {
        $cols='';
        $m=0;
        $color='';
        $rowid=0;
        // $row[9];
                foreach ($row as $value) {
                    if($m==0)
                        $rowid= trim($value);
                    else{
                        if( !in_array($m,$arr)){
                            if(strpos($value,"color:#e2efda")) {
                                
                                $rep= str_replace("</span>","", str_replace("<span style='color:#e2efda'>","",$value));
                                
                                $cols.= "<td style='border:1px solid black; background-color: #e2efda !important;'>" . $rep . '</td>'; 
                            }else{
                                
                                $cols.= "<td style=' border:1px solid black'>" . $value . '</td>'; 
                            }
                            
                           
                        }
                        
                    else
                        $color = trim($value);
                    }
                    
                    $m++;
            }
            $res.= '<tr class="viewDiff" data-color="'.$color.'" data-id="'.$rowid.'" 
            data-filepath="'.$filepath.'" data-filepath1="'.$filepath1.'"
             style="background-color:'.$color.' !important ">'. $cols.'</tr>';
    }
   return  $res.= '</table>';
}
}
