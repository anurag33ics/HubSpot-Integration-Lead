<?php 

$curl = curl_init();
$obj= $_GET['obj'];
$linkurl=$_GET['url'];
curl_setopt_array($curl, array(
  CURLOPT_URL => $linkurl,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'authorization: Bearer APIKEY',
    'Cookie: __cf_bm=wTL8tTTc7HkJMDEc_Om0O5YNuoQkzGO8Gt3U2oI1U_w-1706435946-1-AZmQNyn8/oaTnv70ZUYLAp1yBmHEbPvPLS+mx9VjIKn2csZFAGon9gKhi0Rx0WXv5lzKMawUAWCBc8qlUuuRtMg=; _cfuvid=p3Q50Tkk9XZIof7hqaZ.zR0nutgT4VJQha4YvB4lAX4-1706435946411-0-604800000'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$urlLinkData = json_decode($response, true);

$url = $urlLinkData['result'];

    // Use basename() function to return the base name of file 
    $file_name = "csv/$obj-".date("Y-m-d").".csv"; 
      
    // Use file_get_contents() function to get the file 
    // from url and use file_put_contents() function to 
    // save the file by using base name 
    if($urlLinkData['status']=="COMPLETE"){
        // if(file_exists($file_name))
        //     unlink($file_name);
        
        // if (file_put_contents($file_name, file_get_contents($url))) 
        // { 
        //     echo "1"; 
        // } 
        // else
        // { 
        //     echo "-1"; 
        // }
        

        if(strpos($url,".csv")){
            if(file_exists($file_name))
            unlink($file_name);
        
        if (file_put_contents($file_name, file_get_contents($url))) 
        { 
            echo "1"; 
        } 
        else
        { 
            echo "-1"; 
        }
        }
       else if(strpos($url, ".zip")){
            if (file_put_contents("current.zip", file_get_contents($url))) {
            $zip = new ZipArchive;
            $res = $zip->open('current.zip');
            if ($res === TRUE) {
            $zip->extractTo('old/');
            $zip->close();
            
            if(file_exists("old/".date("Y-m-d").".csv"))
                rename("old/".date("Y-m-d").".csv", "csv/company-".date("Y-m-d").".csv");
            
             else if(file_exists("old/".date("Y-m-d").".csv"))
                rename("old/string.csv", "/csv/company-".date("Y-m-d").".csv");
            
            echo "1";
            } else {
            echo "0";
            }
        }
    }
    }else{
        echo "0";
    }
     
