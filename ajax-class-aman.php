<?php
session_start();
ini_set('display_errors', 1);
class Action
{
    private $db;
  
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
    $res= '<table border="1" class="table differncetbl table-bordered" id="'.$tblid.'">';
    $res .= "<thead><tr>";
        $m=1;
        $arr=[0,17,18,19,20,21,22];
    $res .= "
    <th></th>
    <th colspan='2'>Date</th>
    <th colspan='2'>Location</th>
    <th></th>
    <th></th>
    <th></td>
    <th colspan='2'>Ranking</th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    </tr>";
    if($tblid=="toppriority"){
    $res .="<tr>
    <th>Company <i class='fa fa-fw fa-sort-up' onclick='sortTable(0,".'"toppriority"'.")'></i></th>
    <th>Next Touch <i class='fa fa-fw fa-sort-up' onclick='sortTable(1,".'"toppriority"'.")'></i></th>
    <th>Actionable Date <i class='fa fa-fw fa-sort-up' onclick='sortTable(2,".'"toppriority"'.")'></i></th>
    <th>State <i class='fa fa-fw fa-sort-up' onclick='sortTable(3,".'"toppriority"'.")'></i></th>
    <th>City <i class='fa fa-fw fa-sort-up' onclick='sortTable(4,".'"toppriority"'.")'></i></th>
    <th>Description <i class='fa fa-fw fa-sort-up' onclick='sortTable(5,".'"toppriority"'.")'></i></th>
    <th>Notes and Next Steps <i class='fa fa-fw fa-sort-up' onclick='sortTable(6,".'"toppriority"'.")'></i></th>
    <th>FTE <i class='fa fa-fw fa-sort-up' onclick='sortTable(7,".'"toppriority"'.")'></i></th>
    <th>AIM Ranking <i class='fa fa-fw fa-sort-up' onclick='sortTable(8,".'"toppriority"'.")'></i></th>
    <th>Known Ranking <i class='fa fa-fw fa-sort-up' onclick='sortTable(9,".'"toppriority"'.")'></i></th>
    <th>Rev <i class='fa fa-fw fa-sort-up' onclick='sortTable(10,".'"toppriority"'.")'></i></th>
    <th>Know Mgmt <i class='fa fa-fw fa-sort-up' onclick='sortTable(11,".'"toppriority"'.")'></i></th>
    <th>Lead <i class='fa fa-fw fa-sort-up' onclick='sortTable(12,".'"toppriority"'.")'></i></th>
    <th>EBITDA <i class='fa fa-fw fa-sort-up' onclick='sortTable(13,".'"toppriority"'.")'></i></th>
    <th>Pipeline Opportunity <i class='fa fa-fw fa-sort-up' onclick='sortTable(14,".'"toppriority"'.")'></i></th>
    <th>AIM - Actionability Date <i class='fa fa-fw fa-sort-up' onclick='sortTable(15,".'"toppriority"'.")'></i></th>
    </tr>
    </thead>";
    }
    if($tblid=="newcompany"){
    $res .="<tr>
    <th>Company <i class='fa fa-fw fa-sort-up' onclick='sortTable(0,".'"newcompany"'.")'></i></th>
    <th>Next Touch <i class='fa fa-fw fa-sort-up' onclick='sortTable(1,".'"newcompany"'.")'></i></th>
    <th>Actionable Date <i class='fa fa-fw fa-sort-up' onclick='sortTable(2,".'"newcompany"'.")'></i></th>
    <th>State <i class='fa fa-fw fa-sort-up' onclick='sortTable(3,".'"newcompany"'.")'></i></th>
    <th>City <i class='fa fa-fw fa-sort-up' onclick='sortTable(4,".'"newcompany"'.")'></i></th>
    <th>Description <i class='fa fa-fw fa-sort-up' onclick='sortTable(5,".'"newcompany"'.")'></i></th>
    <th>Notes and Next Steps <i class='fa fa-fw fa-sort-up' onclick='sortTable(6,".'"newcompany"'.")'></i></th>
    <th>FTE <i class='fa fa-fw fa-sort-up' onclick='sortTable(7,".'"newcompany"'.")'></i></th>
    <th>AIM Ranking <i class='fa fa-fw fa-sort-up' onclick='sortTable(8,".'"newcompany"'.")'></i></th>
    <th>Known Ranking <i class='fa fa-fw fa-sort-up' onclick='sortTable(9,".'"newcompany"'.")'></i></th>
    <th>Rev <i class='fa fa-fw fa-sort-up' onclick='sortTable(10,".'"newcompany"'.")'></i></th>
    <th>Know Mgmt <i class='fa fa-fw fa-sort-up' onclick='sortTable(11,".'"newcompany"'.")'></i></th>
    <th>Lead <i class='fa fa-fw fa-sort-up' onclick='sortTable(12,".'"newcompany"'.")'></i></th>
    <th>EBITDA <i class='fa fa-fw fa-sort-up' onclick='sortTable(13,".'"newcompany"'.")'></i></th>
    <th>Pipeline Opportunity <i class='fa fa-fw fa-sort-up' onclick='sortTable(14,".'"newcompany"'.")'></i></th>
    <th>AIM - Actionability Date <i class='fa fa-fw fa-sort-up' onclick='sortTable(15,".'"newcompany"'.")'></i></th>
    </tr>
    </thead>";
    }
    if($tblid=="generalpipeline"){
    $res .="<tr>
    <th>Company <i class='fa fa-fw fa-sort-up' onclick='sortTable(0,".'"generalpipeline"'.")'></i></th>
    <th>Next Touch <i class='fa fa-fw fa-sort-up' onclick='sortTable(1,".'"generalpipeline"'.")'></i></th>
    <th>Actionable Date <i class='fa fa-fw fa-sort-up' onclick='sortTable(2,".'"generalpipeline"'.")'></i></th>
    <th>State <i class='fa fa-fw fa-sort-up' onclick='sortTable(3,".'"generalpipeline"'.")'></i></th>
    <th>City <i class='fa fa-fw fa-sort-up' onclick='sortTable(4,".'"generalpipeline"'.")'></i></th>
    <th>Description <i class='fa fa-fw fa-sort-up' onclick='sortTable(5,".'"generalpipeline"'.")'></i></th>
    <th>Notes and Next Steps <i class='fa fa-fw fa-sort-up' onclick='sortTable(6,".'"generalpipeline"'.")'></i></th>
    <th>FTE <i class='fa fa-fw fa-sort-up' onclick='sortTable(7,".'"generalpipeline"'.")'></i></th>
    <th>AIM Ranking <i class='fa fa-fw fa-sort-up' onclick='sortTable(8,".'"generalpipeline"'.")'></i></th>
    <th>Known Ranking <i class='fa fa-fw fa-sort-up' onclick='sortTable(9,".'"generalpipeline"'.")'></i></th>
    <th>Rev <i class='fa fa-fw fa-sort-up' onclick='sortTable(10,".'"generalpipeline"'.")'></i></th>
    <th>Know Mgmt <i class='fa fa-fw fa-sort-up' onclick='sortTable(11,".'"generalpipeline"'.")'></i></th>
    <th>Lead <i class='fa fa-fw fa-sort-up' onclick='sortTable(12,".'"generalpipeline"'.")'></i></th>
    <th>EBITDA <i class='fa fa-fw fa-sort-up' onclick='sortTable(13,".'"generalpipeline"'.")'></i></th>
    <th>Pipeline Opportunity <i class='fa fa-fw fa-sort-up' onclick='sortTable(14,".'"generalpipeline"'.")'></i></th>
    <th>AIM - Actionability Date <i class='fa fa-fw fa-sort-up' onclick='sortTable(15,".'"generalpipeline"'.")'></i></th>
    </tr>
    </thead>";
    }
    if($tblid=="allpipeline"){
    $res .="<tr>
   <th>Company <i class='fa fa-fw fa-sort-up' onclick='sortTable(0,".'"allpipeline"'.")'></i></th>
    <th>Next Touch <i class='fa fa-fw fa-sort-up' onclick='sortTable(1,".'"allpipeline"'.")'></i></th>
    <th>Actionable Date <i class='fa fa-fw fa-sort-up' onclick='sortTable(2,".'"allpipeline"'.")'></i></th>
    <th>State <i class='fa fa-fw fa-sort-up' onclick='sortTable(3,".'"allpipeline"'.")'></i></th>
    <th>City <i class='fa fa-fw fa-sort-up' onclick='sortTable(4,".'"allpipeline"'.")'></i></th>
    <th>Description <i class='fa fa-fw fa-sort-up' onclick='sortTable(5,".'"allpipeline"'.")'></i></th>
    <th>Notes and Next Steps <i class='fa fa-fw fa-sort-up' onclick='sortTable(6,".'"allpipeline"'.")'></i></th>
    <th>FTE <i class='fa fa-fw fa-sort-up' onclick='sortTable(7,".'"allpipeline"'.")'></i></th>
    <th>AIM Ranking <i class='fa fa-fw fa-sort-up' onclick='sortTable(8,".'"allpipeline"'.")'></i></th>
    <th>Known Ranking <i class='fa fa-fw fa-sort-up' onclick='sortTable(9,".'"allpipeline"'.")'></i></th>
    <th>Rev <i class='fa fa-fw fa-sort-up' onclick='sortTable(10,".'"allpipeline"'.")'></i></th>
    <th>Know Mgmt <i class='fa fa-fw fa-sort-up' onclick='sortTable(11,".'"allpipeline"'.")'></i></th>
    <th>Lead <i class='fa fa-fw fa-sort-up' onclick='sortTable(12,".'"allpipeline"'.")'></i></th>
    <th>EBITDA <i class='fa fa-fw fa-sort-up' onclick='sortTable(13,".'"allpipeline"'.")'></i></th>
    <th>Pipeline Opportunity <i class='fa fa-fw fa-sort-up' onclick='sortTable(14,".'"allpipeline"'.")'></i></th>
    <th>AIM - Actionability Date <i class='fa fa-fw fa-sort-up' onclick='sortTable(15,".'"allpipeline"'.")'></i></th>
    </tr>
    </thead>";
    }
    
    if($tblid=="")
        $res = '<tbody>';
        
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
                            {$cols.= "<td> 
                            <a href='https://app.hubspot.com/contacts/23372725/record/0-2/$rowid' target='_blank'>" . $value . '</a></td>';}
                            else if($m==14 || $m==11 || $m==8){
                                if($value==0 || $value<0)
                                    $cols.= "<td>&#36;0</td>";
                                else
                                $cols.= "<td>" . htmlspecialchars($value) . '</td>';
                            }
                            elseif($m==2|| $m==3){
                                if($value!=''){
                                    $date = explode("-",$value);
                                    $cols.= "<td>" . $date[1]."-".$date[2]."-".$date[0] . '</td>';
                                }else
                                    $cols.= "<td>" . htmlspecialchars($value) . '</td>';
                            }
                            else
                            $cols.= "<td>" . htmlspecialchars($value) . '</td>';
                        }
                            
                    else
                        $color = trim($value);
                    }
                    
                    $m++;
            }
           
        if( $tblid=="newcompany" && is_numeric($rowid) && $rowid!=0){
            if($color!="red" && $color!="white" ){
                $res.= '<tr class="viewDiff" data-color="'.$color.'" data-id="'.$rowid.'" 
            data-filepath="'.$filepath.'" data-filepath1="'.$filepath1.'"
             style="background-color:'.$color.' !important ">'. $cols.'</tr>';
            }
            
        }elseif(is_numeric($rowid) && $rowid!=0){
            $res.= '<tr class="viewDiff" data-color="'.$color.'" data-id="'.$rowid.'" 
            data-filepath="'.$filepath.'" data-filepath1="'.$filepath1.'"
             style="background-color:'.$color.' !important ">'. $cols.'</tr>';
        }
    }
     if($tblid=="")
      return $res;
   return  $res.= '</tbody></table>';
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
        $date = date("Y-m-d");
        $filename = "csv/" . $date . '.csv';
        file_put_contents($filename, $csvData);
        return "Data imported successfully";
    }


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
         $file1 = 'csv/' . $_POST['objname'] . "-" . $_POST['date'] . '.csv';
         $file2 = 'csv/' . $_POST['objname'] . "-" . $_POST['date2'] . '.csv';

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
        
        $file3Arry = $this->makeAray($file2, "1",3,8);
       
        foreach($file2Arry as $val){
            $pos= array_search($val[$key], array_column($file3Arry, $key));
            unset($file3Arry[$pos]);
        }
        $findDiffFor3 = $file3Arry;
        // 
        $commonObjects = $this->findCommonObjects($file3Arry, $file1Arry, $key);
         foreach($commonObjects as $val){
            $pos= array_search($val[$key], array_column($findDiffFor3, $key));
            unset($findDiffFor3[$pos]);
        }   

        foreach($commonObjects as $val){
              $pos= array_search($val[$key], array_column($file1Arry, $key));
             if(($file1Arry[$pos]['AIM-DirectRelationship']=="" || $file1Arry[$pos]['AIM-DirectRelationship']=="No") && 
                $val['AIM-DirectRelationship']=="Yes"  ){
                $pos2= array_search($val[$key], array_column($file3Arry, $key));
                $file3Arry[$pos2]['rowcolor']="rgb(226, 239, 218)";

             }else{
                $pos2= array_search($val[$key], array_column($file3Arry, $key));
                 $file3Arry[$pos2]['rowcolor']="red";
             }
        }
        $forarray3add='';
         foreach($findDiffFor3 as $val){
             if($val['AIM-DirectRelationship']=="Yes"  ){
                $val['rowcolor']="#16efda";
                 $file3Arry[] = $val;

             }
         }
// section 3
$file4Arry = $this->makeAray($file2, "1",0,0);
        foreach($file2Arry as $val){
            if(isset($val[$key])){
            $pos= array_search($val[$key], array_column($file4Arry, $key));
            unset($file4Arry[$pos]);
            }
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
       
// echo "count file2-".count($file2Arry);
// echo "after second remove". $pos= array_search("17681910016", array_column($file4Arry, $key));;
$newArray =array();
foreach($file4Arry as $val){
    if(isset($val[$key])){
        $pos= array_search($val[$key], array_column($file2Arry, $key));
        if($pos){
            
        }else{
            $newArray[] = $val;
        }
        // unset($file4Arry[$pos]);
    }
}
    // echo "count new-".count($newArray);
    // echo "count file4-".count($file4Arry);
    $file4Arry = $newArray;
// for section 4
$file5Arry = $this->makeAray($file2, "1",8,-1);
    
    
        $toppriority= $this->differnceCsvData($file2Arry, $file1,$file2, "toppriority");
        $toppriorityrows= $this->differnceCsvData($file2Arry, $file1,$file2, "");
            
        $newcompany = $this->differnceCsvData($file3Arry, $file1,$file2, "newcompany");
        $newcompanyrows = $this->differnceCsvData($file3Arry, $file1,$file2, "");
        $generalpipeline = $this->differnceCsvData($file4Arry, $file1,$file2, "generalpipeline");
        $generalpipelinerows = $this->differnceCsvData($file4Arry, $file1,$file2, "");
        $allpipeline = $this->differnceCsvData( $file5Arry, $file1,$file2, "allpipeline");
        $allpipelinerows = $this->differnceCsvData( $file5Arry, $file1,$file2, "");
        // export all
        $res= '<table border="1" class="table " id="exportAll" style="display:none">';
        $res .= "<thead>
        <tr'>
        <th>Company</th>
        <th>Next Touch</th>
        <th>Actionable Date</th>
        <th>State</th>
        <th>City</th>
        <th>Description</th>
        <th>Notes and Next Steps</th>
        <th>FTE</th>
        <th>AIM Ranking</th>
        <th>Known Ranking</th>
        <th>Rev</th>
        <th>Know Mgmt</th>
        <th>Lead</th>
        <th>EBITDA</th>
        <th>Pipeline Opportunity</th>
        <th>AIM - Actionability Date</th>
        <th>Record ID</th>
        <th>Highlighted</th>
        <th>Section1</th>
        <th>Section2</th>
        <th>Section3</th>
        <th>Section4</th>
        </tr></thead>";
        
        $allRow= $this->allDataExport($file2Arry, "1", "", "", "");
        $allRow .= $this->allDataExport($file3Arry, "", "2", "", "");
        $allRow .= $this->allDataExport($file4Arry, "", "", "3", "");
        $allRow .= $this->allDataExport($file5Arry, "", "", "", "4");
        $res .= $allRow."</table>";
        return $toppriority."!@#$%".$newcompany."!@#$%".$generalpipeline."!@#$%".$allpipeline."!@#$%".$res."!@#$%".$toppriorityrows."!@#$%".$newcompanyrows."!@#$%".$generalpipelinerows."!@#$%".$allpipelinerows;
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
                            $cols.= "<td>" .htmlspecialchars(trim($value)) . '</td>';
                         else
                            $color = trim($value);
                    }
                    
                    $m++;
            }

            $cols.= "<td>" .htmlspecialchars(trim($rowid)) . '</td>';
            if($color!='white'){
                $cols.= "<td>Yes</td>";
            }else{
                $cols.= "<td>No</td>";
            }
            $cols .="<td>$section1</td>
            <td>$section2</td>
            <td>$section3</td>
            <td>$section4</td>";
            if($rowid!=0 && $rowid!="")
                $res.= '<tr class="viewDiff">'. $cols.'</tr>';
    }
   return  $res;
}

public function differnceCsvDataForPopUp($csvData, $filepath, $filepath1, $tblid)
{
    $res= '<table border="1" class="table differncetbl" id="'.$tblid.'">';
    // $handle1 = fopen($filepath, "r");
    $res .= "<thead><tr>";
        $m=1;
        $arr=[0,17,18,19,20,21,22];
    $res .= "
    <th></th>
    <th colspan='2'>Date</th>
    <th colspan='2'>Location</th>
    <th></th>
    <th></th>
    <th></th>
    <th colspan='2'>Ranking</th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    </tr>
    <tr>
    <th>Company</th>
    <th>Next Touch</th>
    <th>Actionable Date</th>
    <th>State</th>
    <th>City</th>
    <th>Description</th>
    <th>Notes and Next Steps</th>
    <th>FTE</th>
    <th>AIM Ranking</th>
    <th>Known Ranking</th>
    <th>Rev</th>
    <th>Know Mgmt</th>
    <th>Lead</th>
    <th>EBITDA</th>
    <th>Pipeline Opportunity</th>
    <th>AIM - Actionability Date</th>
    </tr></thead>";
    $res .= "<tbody>";
    foreach ($csvData as $row) {
        $cols='';
        $m=0;
        $color='';
        $rowid=0;
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
   return  $res.= '</tbody></table>';
}
}
