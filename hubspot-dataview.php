    <?php session_start();
    if(!isset($_SESSION['username']) ){
        header("Location:index.php");
    }
    ?>
    
    <!DOCTYPE html>
    <html>
    
    <head>
    <title> View list</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/css/bootstrap-multiselect.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
       
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="stylesheet" href='style.css'>-->
    <style>
        
    @import url('font/InterTight-Regular.ttf');
* {
    box-sizing: border-box;
}

            * {
                box-sizing: border-box;
            }
    
            input[type=text],
            select,
            textarea {
                width: 100%;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 4px;
                resize: vertical;
            }
    
            label {
                padding: 12px 12px 12px 0;
                display: inline-block;
            }
    
            input[type=submit] {
                background-color: #04AA6D;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                float: right;
            }
    
            input[type=submit]:hover {
                background-color: #45a049;
            }
    
            .container {
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
            }
    
            .col-25 {
                float: left;
                width: 25%;
                margin-top: 6px;
            }
    
            .col-75 {
                float: left;
                width: 75%;
                margin-top: 6px;
            }


            .row:after {
                content: "";
                display: table;
                clear: both;
            }
            #overlay{	
              position: fixed;
              top: 0;
              z-index: 100;
              width: 100%;
              height:100%;
              display: none;
              background: rgba(0,0,0,0.6);
            }
            .cv-spinner {
              height: 100%;
              display: flex;
              justify-content: center;
              align-items: center;  
            }
            .spinner {
              width: 40px;
              height: 40px;
              border: 4px #ddd solid;
              border-top: 4px #2e93e6 solid;
              border-radius: 50%;
              animation: sp-anime 0.8s infinite linear;
            }
   
    .is-hide{
      display:none;
    }


    body.loading{
        overflow: hidden;   
    }
 
 
    body.loading .overlay{
        display: block;
    }
     .differncetbl tr td {
        background-color:transparent !important
    }
    
    
    body{
      background:rgb(20,53,74);;
      font-family: 'InterTight-Regular';
    }
    h2{
      color:#000;
      text-align:center;
      font-size:2em;
    }
   
    a {
        background-color: inherit !important;
    }
    
     .warpper{
      display:flex;
      flex-direction: column;
      align-items: center;
    }
    .tab{
      cursor: pointer;
      padding:10px 20px;
      margin:0px 2px;
      background:#000;
      display:inline-block;
      color:#fff;
      border-radius:3px 3px 0px 0px;
      box-shadow: 0 0.5rem 0.8rem #00000080;
    }
    .panels{
      background:#fffffff6;
      box-shadow: 0 2rem 2rem #00000080;
      min-height:200px;
      width:100%;
      max-width:99%;
      border-radius:3px;
      overflow:hidden;
      padding:20px;  
    }
    .panel{
      display:none;
      animation: fadein .8s;
    }
    
     
    .panel-title{
      font-size:1.5em;
      font-weight:bold
    }
    .radio{
      display:none;
    }
    #one:checked ~ .panels #one-panel,
    #two:checked ~ .panels #two-panel,
    #three:checked ~ .panels #three-panel,
    #four:checked ~ .panels #four-panel{
      display:block
    }
    #one:checked ~ .tabs #one-tab,
    #two:checked ~ .tabs #two-tab,
    #three:checked ~ .tabs #three-tab,
    #four:checked ~ .tabs #four-tab{
      background:#fffffff6;
      color:#000;
      border-top: 3px solid #000;
    }
             /*Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    
            
            .table>thead {
                --bs-table-bg: #14354a;
                border: 1px solid black;
            }
            
            tr, td{
                border: 1px solid black !important;
                text-align: center !important;
            }
            
            th {
        text-align: center !important;
        color: #fff !important;
    }
    
     /*Apply styles to the second column */
    table tr td:nth-child(2) {
        width: 1%;
        white-space: nowrap;
    }
    
     /*Apply styles to the third column */
    table tr td:nth-child(3) {
        width: 1%;
        white-space: nowrap;
    }
    
    .multiselect {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: var(--bs-body-color);
        /*-webkit-appearance: none;*/
        /*-moz-appearance: none;*/
        /*appearance: none;*/
        background-color: var(--bs-body-bg);
        background-clip: padding-box;
        border: var(--bs-border-width) solid var(--bs-border-color);
        border-radius: var(--bs-border-radius);
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .multiselect-container .multiselect-option.active:not(.multiselect-active-item-fallback){
            background-color: #ffffff !important;
    }
    
    @keyframes sp-anime {
      100% { 
        transform: rotate(360deg); 
      }
    }
    @keyframes fadein {
        from {
            opacity:0;
        }
        to {
            opacity:1;
        }
    }
    
            @media screen and (max-width: 600px) {
                .col-25,
                .col-75,
                input[type=submit] {
                    width: 100%;
                    margin-top: 0;
                }
            }
            
            .icons{
                cursor: pointer;
                width: 30px;
                font-size: 24px;
            }
    
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/1.1.2/js/bootstrap-multiselect.min.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js" integrity="sha512-2/YdOMV+YNpanLCF5MdQwaoFRVbTmrJ4u4EpqS/USXAQNUDgI5uwYi6J98WVtJKcfe1AbgerygzDFToxAlOGEQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>
    <?php 
    $folderPath = "csv/";
    // Get the list of files in the folder
    $files = scandir($folderPath);
    // Remove "." and ".." from the list
    $files = array_diff($files, array('.', '..'));
    
    // Output the list of files
    
    ?>
    <body>
    
        <div class="container">
            <form>
                <div class="row">
                    <div class="col-md-10">    
                        <p style="text-align: center;font-weight:bold"> Display Data</p>
                    </div>
                    <div class="col-md-2" >
                        <p >
                        <img src='img/logo2.png' width="190" height="70px" ></p>
                    </div>
    
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <label>Date 1</label>
                        <select name="date" id="date" class="form-control">
                            <!--str_contains($file,"company")-->
                            <?php foreach ($files as $file) {
                                    if(strpos($file, "company") !== false){
                                        $arrstr= str_replace("company-","", str_replace('.csv',"",$file));
                                        $arr = explode("-",$arrstr);
                                        echo "<option value='".$arrstr."'> ".$arr[1]."-".$arr[2]."-".$arr[0]." </option>";
                                    }
                            } ?>
                            
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>Date 2</label>
                        <select name="date2" id="date2" class="form-control">
                            <?php 
                            foreach ($files as $file) {
                                
                                    if(strpos($file, "company") !== false){
                                        $arrstr= str_replace("company-","", str_replace('.csv',"",$file));
                                        $arr = explode("-",$arrstr);
                                        echo "<option value='".$arrstr."'> ".$arr[1]."-".$arr[2]."-".$arr[0]." </option>";
                                    }
                            } ?>
                            
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label >Select Object </label>
                        <select id="objname" class="form-control">
                            <option value="company">Company</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label>&nbsp;</label>
                        <input type="button" id="submit" value="Submit" class="form-control" style="width: 100px;" >
                    </div>
                    <div class="col-md-2" style="margin-top: auto;">
                        <label>&nbsp;</label>
                          <label>Export All</label>
                    <i id="btnExportAll" class="icons fa-solid fa-file-csv" onclick="exportTableToExcel('exportAll','All-Data-Export')"></i>
                                                <i class="icons fa-solid fa-file-pdf" onclick="exportToPDF()"></i>
                    </div>
                    <div class="col-1">    
                    </div>
                    <div class="col-1">    
                        <input type="button" id="importFrmHubspot" value="Import" class="form-control" >
                    </div>
                    <div class="col-1" class="bg-danger text-white">    
                        <input type="button" id="logout" value="Logout" class="form-control text-danger" >
                    </div>
                </div>
                <div class="row">
                </div>
            </form>
            
        </div>
    <div class="warpper">
      <input class="radio" id="one" name="group" type="radio" checked>
      <input class="radio" id="two" name="group" type="radio">
      <input class="radio" id="three" name="group" type="radio">
      <input class="radio" id="four" name="group" type="radio">
        <div class="tabs">
          <label class="tab" id="one-tab" for="one">Section 1 – Top Priority Deals</label>
          <label class="tab" id="two-tab" for="two">Section 2 – New Company Conversations</label>
          <label class="tab" id="three-tab" for="three">Section 3 – General Pipeline Updates / Additions</label>
          <label class="tab" id="four-tab" for="four">Section 4 – All pipeline companies</label>
        </div>
        <div class="panels">
            <div class="panel" id="one-panel">
                <div class="panel-title" id='deal1'>
                        <div class="row" >
                        <div class='col-md-2'>
                            Top Priority Deals
                            <i class="icons fa-solid fa-file-csv" onclick="exportTableToExcel('toppriority','Top-Priority')"></i>
                        </div>
                        <div class='col-md-2'>
                            
                            <select id="sortcolortp" class="form-control" onchange="sortTableByColor(this, 'toppriority')" >
                                <option value='0' selected disabled> Sort By Color</option>
                                <option value=false>Highlighted</option>
                                <option value=true> Non-Highlighted</option>
                            </select>
                        </div>
                        <div class='col-md-1'>
                            <select id="HidenShowSelecttp" multiple class="form-control" onchange="handlechange('toppriority', 'HidenShowSelecttp')">
                                <option selected value="0">Company Name</option>
                                <option selected value="5">Description</option>
                                <option selected value="6">Notes and Next Steps</option>
                                <option selected value="7">FTE</option>
                                <option selected value="10">Rev</option>
                                <option selected value="11">Know Mgmt</option>
                                <option selected value="12">Lead</option>
                                <option selected value="13">EBITDA</option>
                                <option selected value="14">Pipeline Opportunity</option>
                                <option selected value="15">AIM - Actionability Date</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding: 10px;">
                    <div class='col-md-12'></div>
                </div>
            
                <div class="row">
                   <!--         <div id="pageprint">-->
                   <!--<div id="reportbox"></div>-->
                </div> 
                <div style="overflow: scroll;padding-left: unset;padding-right: unset;" id="div2"></div>  
            </div>
            <div class="panel" id="two-panel">
                <div class="panel-title" id='deal2'>
                    <div class="row" >
                        <div class='col-md-3'>
                            New Company Conversations
                            <i class="icons fa-solid fa-file-csv" onclick="exportTableToExcel('newcompany','New-Company')"></i>
                        </div>
                        <div class='col-md-2'>
                            <select class="form-control" id='sortcolornc' onchange="sortTableByColor(this, 'newcompany')" >
                                <option value='0' selected disabled> Sort By Color</option>
                                <option value='false'>Highlighted</option>
                                <option value='true'> Non-Highlighted</option>
                            </select>
                        </div>
                        <div class='col-md-2'>
                            <select id="HidenShowSelectnc" multiple class="form-control" onchange="handlechange('newcompany', 'HidenShowSelectnc')">
                                <option selected value="0">Company Name</option>
                                <option selected value="5">Description</option>
                                <option selected value="6">Notes and Next Steps</option>
                                <option selected value="7">FTE</option>
                                <option selected value="10">Rev</option>
                                <option selected value="11">Know Mgmt</option>
                                <option selected value="12">Lead</option>
                                <option selected value="13">EBITDA</option>
                                <option selected value="14">Pipeline Opportunity</option>
                                <option selected value="15">AIM - Actionability Date</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding: 10px;">
                    <div class='col-md-12'></div>
                </div>
                <div class="row" >
                    <div style="overflow: scroll;padding-left: unset;padding-right: unset;" id="div3"></div>
                </div>
            </div>
            <div class="panel" id="three-panel">
                <div class="panel-title" id="deal3">
                    <div class="row" >
                        <div class='col-md-4'>
                            General Pipeline Updates / Additions
                            <i class="icons fa-solid fa-file-csv" onclick="exportTableToExcel('generalpipeline','General-Pipeline')"></i>
                        </div>
                        <div class='col-md-2'>
                            <select class="form-control" id='sortcolorgpu' onchange="sortTableByColor(this,'generalpipeline')" >
                                <option value='0' selected disabled> Sort By Color</option>
                                <option value='false'>Highlighted</option>
                                <option value='true'> Non-Highlighted</option>
                            </select>
                        </div>
                        <div class='col-md-2'>
                            <select id="HidenShowSelectgpu" multiple class="form-control" onchange="handlechange('generalpipeline', 'HidenShowSelectgpu')">
                                <option selected value="0">Company Name</option>
                                <option selected value="5">Description</option>
                                <option selected value="6">Notes and Next Steps</option>
                                <option selected value="7">FTE</option>
                                <option selected value="10">Rev</option>
                                <option selected value="11">Know Mgmt</option>
                                <option selected value="12">Lead</option>
                                <option selected value="13">EBITDA</option>
                                <option selected value="14">Pipeline Opportunity</option>
                                <option selected value="15">AIM - Actionability Date</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding: 10px;">
                    <div class='col-md-12'></div>
                </div>
                <div class="row" >
                    <div style="overflow: scroll;padding-left: unset;padding-right: unset;" id="div4"></div>
                </div>
            </div>
            <div class="panel" id="four-panel">
                <div class="panel-title" id="deal4">
                    <div class="row" >
                        <div class='col-md-2'>
                            All pipeline companies
                            <i class="icons fa-solid fa-file-csv" onclick="exportTableToExcel('allpipeline','All-pipeline')"></i>
                        </div>
                        <div class='col-md-2'>
                            <select id="HidenShowSelectapc" multiple class="form-control" onchange="handlechange('allpipeline', 'HidenShowSelectapc')">
                                <option selected value="0">Company Name</option>
                                <option selected value="5">Description</option>
                                <option selected value="6">Notes and Next Steps</option>
                                <option selected value="7">FTE</option>
                                <option selected value="10">Rev</option>
                                <option selected value="11">Know Mgmt</option>
                                <option selected value="12">Lead</option>
                                <option selected value="13">EBITDA</option>
                                <option selected value="14">Pipeline Opportunity</option>
                                <option selected value="15">AIM - Actionability Date</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding: 10px;">
                    <div class='col-md-12'></div>
                </div>
                <div class="row" >
                     <div style="overflow: scroll;padding-left: unset;padding-right: unset;" id="div5"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="showdiffdata">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTitle"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="modalBody" style="overflow: auto;">
            
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    
    <div id="overlay">
      <div class="cv-spinner">
        <span class="spinner"></span>
      </div>
    </div>
        <script>
             $("#overlay").hide();
            $(document).on({
        ajaxStart: function(){
            $("body").addClass("loading"); 
            $("#overlay").fadeIn(1000);　
        },
        ajaxStop: function(){ 
            $("#overlay").fadeOut(300);
            $("body").removeClass("loading"); 
        }    
    });
            $("#logout").on("click", function(){
                let cnf =confirm("Are you sure want to logout");
                if(cnf){
                    $.ajax({
                    url: 'ajax.php?action=logout',
                    method: "POST",
                    data: {         },
                    success: function(res) {
                        alert("Logout Successfully");
                        setTimeout(() => {
                            window.location.href='index.php';
                        }, 2000);
                    }
    
                })
                }
            })
            $("#btnExportAll").prop('disabled',true);
            $("#submit").on("click", function() {
                $("#btnExportAll").prop('disabled',true);
                let date = $("#date").val();
                let date2 = $("#date2").val();
                let objname = $("#objname").val();
                if(date!='' && objname!='' && date2!='' ){
                    $.ajax({
                    url: 'ajax.php?action=comparedata',
                    method: "POST",
                    data: {
                        date: date, objname:objname, date2:date2
                    },
                    
                    success: function(res) {
                        $('#submit').prop('disabled', true);
                           if(res==1)
                            $("#div2").html("File not found").addClass("alert alert-danger");
                        else {
                            let divideSec = res.split("!@#$%");
                            $("#div2").html(divideSec[0]);
                            $("#div3").html(divideSec[1]);
                            $("#div4").html(divideSec[2]);
                            $("#div5").html(divideSec[3]);
                             $("#div2").append(divideSec[4]);
                             sortTable(0,'toppriority');
                             sortTableByColor('false', 'toppriority');
                             sortTable(0,'newcompany');
                             sortTableByColor('false', 'newcompany');
                             sortTable(0,'generalpipeline');
                             sortTableByColor('false', 'generalpipeline');
                             sortTable(0,'allpipeline');
                               
                        }
                        $('#submit').prop('disabled', false);
                        $("#btnExportAll").prop('disabled',false);
                    }
    
                })
                }else{
                    $("#response").html("Please select the date and Object").addClass("alert alert-danger");
                }
    
            })
    
            $("#importFrmHubspot").on("click", function() {
                $('#importFrmHubspot').prop('disabled', false);
                $('#importFrmHubspot').prop("value", "Processing..");
                
                    const d = new Date();
                    const year= d.getFullYear();
                    let month= d.getMonth()+1;
                    let day= d.getDate();
                    if(day<10)
                        day= "0"+day;
                    if(month<10)
                        month ="0"+month;
                    const filename ="csv/company-"+year+"-"+month+"-"+day+".csv";
                    var http = new XMLHttpRequest();
                    http.open('HEAD', filename, false);
                    http.send();
                    if( http.status!=404){
                        alert("Today's File exist, not need to import");
                    }else{
                       getUrlId("company")
                    }
            });
        function getUrlId(obj){
            $('#importFrmHubspot').prop('disabled', true);
            $.ajax({
                    url: 'hubspot-export.php?obj='+obj,
                    method: "GET",
                    success: function(res) {
                        setTimeout(() => {
                            saveFile(res,obj)
                        }, 20000);
                    }
    
                })
        }
        function saveFile(url,obj){
            $.ajax({
                    url: 'get-file.php?obj='+obj+'&url='+url,
                    method: "GET",
                    success: function(res) {
                      if(res=="0"){setTimeout(() => {
                    $('#importFrmHubspot').prop('disabled', true);
                            saveFile(url,obj)
                            
                        }, 10000);}  
                     else
                        $("#response").html("data imported successfully").addClass("alert alert-success");
                    $('#importFrmHubspot').prop('disabled', false);
                    $('#importFrmHubspot').prop("value", "Import");
                        
                    }
    
                })
        }
        </script>
        <style>
       
        </style>
        <script>
                $(document).on("click", ".viewDiff", function (evt) {
    
                let rowid = $(this).attr("data-id");
                let color = $(this).attr("data-color");
                let filepath = $(this).attr("data-filepath");
                let filepath1 = $(this).attr("data-filepath1");
                if(color!='white' && color!='#16efda'){
                    $.ajax({
                        url: 'ajax.php?action=getDiffData',
                        method: "POST",
                        data:{rowid:rowid, filepath:filepath, filepath1:filepath1},
                        success: function(res) {
                            $("#modalTitle").html("Show for Record Id- "+rowid);
                            $("#modalBody").html(res);
                            $("#showdiffdata").modal("show");
                        }
                    })
                    
                }
            })
            
    function exportTableToExcel(tableId, filename = ''){
                const table = document.getElementById(tableId);
                const rows = table.querySelectorAll('tr');
                const data = [];
            if(table.id =="exportAll"){
                    for (let i = 0; i < rows.length; i++) {
                
                    const row = rows[i];
                    const rowData = [];
                    const cells = row.querySelectorAll('td, th');
    
                    for (let j = 0; j < cells.length; j++) {
                        rowData.push(sanitizeForCSV(cells[j].innerText));
                    }
    
                    data.push(rowData.join(','));
                
                    }
                }else{
                    for (let i = 0; i < rows.length; i++) {
                    if(i>1){
                    const row = rows[i];
                    const rowData = [];
                    const cells = row.querySelectorAll('td, th');
    
                    for (let j = 0; j < cells.length; j++) {
                        rowData.push(sanitizeForCSV(cells[j].innerText));
                    }
    
                    data.push(rowData.join(','));
                }
            }
                }
                // Convert data to CSV formatt
                const csvContent =  data.join('\n');
    
                // Create a Blob
                const blob = new Blob([csvContent], { type: 'text/csv' });
    
                // Create a download link
                const link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = `${filename}.csv`;
    
                // Append the link to the document
                document.body.appendChild(link);
    
                // Trigger a click on the link to start the download
                link.click();
    
                // Remove the link from the document
                document.body.removeChild(link);
            }
    function sanitizeForCSV(input) {
        // If the input contains a comma or double quote, wrap it in double quotes
        if (input.includes(',') || input.includes('"') || input.includes('/')) {
            return '"' + input.replace(/"/g, '""') + '"';
        } else {
            return input;
        }
    }
        </script>
       <script>
    
    function sortTable(n, id) {
        var table = document.getElementById(id);
        var rows = Array.from(table.rows).slice(2); // Exclude the header row
        var th = table.rows[1].getElementsByTagName("th")[n];
        var icon= th.children[0];
        if (icon.classList.contains('fa-sort-up')) {
          dir = "fa-sort-up";
        }else{
            dir = "fa-sort-down";
        }
    
        function partition(arr, low, high) {
            var pivot = arr[Math.floor((low + high) / 2)].getElementsByTagName("td")[n].textContent;
            var i = low;
            var j = high;
            while (i <= j) {
                if (dir === "fa-sort-up") {
                    while (arr[i].getElementsByTagName("td")[n].textContent.toLowerCase() < pivot.toLowerCase()) {
                        i++;
                    }
                    while (arr[j].getElementsByTagName("td")[n].textContent.toLowerCase() > pivot.toLowerCase()) {
                        j--;
                    }
                } else {
                    while (arr[i].getElementsByTagName("td")[n].textContent.toLowerCase() > pivot.toLowerCase()) {
                        i++;
                    }
                    while (arr[j].getElementsByTagName("td")[n].textContent.toLowerCase() < pivot.toLowerCase()) {
                        j--;
                    }
                }
                if (i <= j) {
                    [arr[i], arr[j]] = [arr[j], arr[i]];
                    i++;
                    j--;
                }
            }
            return i;
        }
        
        function quickSort(arr, low, high) {
            if (low < high) {
                var pi = partition(arr, low, high);
                quickSort(arr, low, pi - 1);
                quickSort(arr, pi, high);
            }
        }
    
        quickSort(rows, 0, rows.length - 1);
    
        // Reconstruct the table with sorted rows
        for (var i = 0; i < rows.length; i++) {
            table.appendChild(rows[i]);
        }
        
        // Toggle sort direction for next click
        icon.classList.remove(dir);
        dir = (dir === "fa-sort-up") ? "fa-sort-down" : "fa-sort-up";
        icon.classList.add(dir);
    }
    
    function sortTableByColor(selected, tableId) {
        var selectedValue = selected.value;
        var reverse = selectedValue === 'true';
        var table = document.getElementById(tableId);
        var rows = table.getElementsByTagName('tr');
        var sortedRows = Array.prototype.slice.call(rows, 2); // Skip the first two rows
    
        sortedRows.sort(function(a, b) {
            var colorA = a.style.backgroundColor || window.getComputedStyle(a).backgroundColor;
            var colorB = b.style.backgroundColor || window.getComputedStyle(b).backgroundColor;
            return colorA.localeCompare(colorB);
        });
    
        if (reverse) {
            sortedRows.reverse();
        }
    
        for (var i = 0; i < sortedRows.length; i++) {
            table.appendChild(sortedRows[i]);
        }
    }
    
    $(document).ready(function(){
          $('#HidenShowSelecttp').multiselect();
          $('#HidenShowSelectnc').multiselect();
          $('#HidenShowSelectgpu').multiselect();
          $('#HidenShowSelectapc').multiselect();
        });
    
        // Define your JavaScript function
        function handlechange(myTable, id) {
          // Get the selected values
          var selectedValues = $('#'+id).val();
          selectedValues.push('1');
          selectedValues.push('2');
          selectedValues.push('3');
          selectedValues.push('4');
          selectedValues.push('8');
          selectedValues.push('9');
          // Call toggleColumn with selected values
          toggleColumn(selectedValues, myTable);
        }
    
        // Toggle columns based on selected values
        function toggleColumn(selectedColumns, myTable) {
          var table = document.getElementById(myTable);
          if (!table) {
            console.error("Table with ID 'myTable' not found.");
            return;
          }
    
          var rows = table.rows;
          for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].cells;
            for (var j = 0; j < cells.length; j++) {
              cells[j].style.display = selectedColumns.includes(j.toString()) ? "" : "none";
            }
          }
        }
    function exportToPDF() {
      const doc = new window.jspdf.jsPDF('l', 'pt', 'a3');
      const table1 = document.getElementById('toppriority');
      const tableWidth = 1170; // Adjust according to your table size
      const tableHeight = 900; // Adjust according to your table size
      const pageWidth = doc.internal.pageSize.getWidth();
      const pageHeight = doc.internal.pageSize.getHeight();
      const marginX = 20; // Adjust margins as needed
      let startY = 30; // Adjust startY position for each table
      // Calculate available space for the table on the page
      //const marginX = (pageWidth - tableWidth) / 2;
      const marginY = (pageHeight - tableHeight) / 2;
    
      // Set the styles for the table headers to match the table color
      const tableStyles = {
        fillColor: [20, 53, 74], // Set your table color here (RGB)
        lineWidth: 1, // Set the border line width
      };
    
      // Set position for the table
      doc.autoTable({
        html: table1,
        startY: startY,
        margin: { left: marginX, right: marginX },
        headStyles: tableStyles, // Apply styles to the table headers
        styles: {
          lineWidth: 1, // Set the border line width for the entire table
        },
        rowPageBreak: 'avoid',
        didDrawPage: function(data) {
        doc.text("Top Priority Deals", data.settings.margin.left, 20);
       }
      });
      
        startY += table1.clientHeight + 20; // Adjust vertical spacing

      // Table 2
      const table2 = document.getElementById('newcompany');
      doc.autoTable({
        html: table2,
        startY: startY,
        margin: { left: marginX, right: marginX },
        headStyles: tableStyles, // Apply styles to the table headers
        styles: {
          lineWidth: 1, // Set the border line width for the entire table
        },
        rowPageBreak: 'avoid',
        didDrawPage: function(data) {
        doc.text("New Company Conversations", data.settings.margin.left, 20);
       }
      });

      //startY += table2.clientHeight + 20; // Adjust vertical spacing
    
       //Table 3
      //const table3 = document.getElementById('generalpipeline');
      //doc.autoTable({
        //html: table3,
        //startY: startY,
        //margin: { left: marginX, right: marginX },
       // headStyles: tableStyles, // Apply styles to the table headers
        //styles: {
        //  lineWidth: 1, // Set the border line width for the entire table
       // },
       // rowPageBreak: 'avoid',
       //   didDrawPage: function(data) {
       //   doc.text("General Pipeline Updates / Additions", data.settings.margin.left, 20);
       //  }
//});

      startY += table2.clientHeight + 20; // Adjust vertical spacing
    
      // Table 3
      const table4 = document.getElementById('allpipeline');
      doc.autoTable({
        html: table4,
        startY: startY,
        margin: { left: marginX, right: marginX },
        headStyles: tableStyles, // Apply styles to the table headers
        styles: {
          lineWidth: 1, // Set the border line width for the entire table
        },
        rowPageBreak: 'avoid',
        didDrawPage: function(data) {
        doc.text("All pipeline companies", data.settings.margin.left, 20);
       }
      });

      // Save the PDF
      doc.save('table.pdf');
    }
    
      async function exportToPDF2() {
      const doc = new window.jspdf.jsPDF('l', 'pt', 'a3');
      const table1 = document.getElementById('toppriority');
      const tableWidth = 1170; // Adjust according to your table size
      const tableHeight = 900; // Adjust according to your table size
      const pageWidth = doc.internal.pageSize.getWidth();
      const pageHeight = doc.internal.pageSize.getHeight();
      const marginX = 20; // Adjust margins as needed
      let startY = 30; // Adjust startY position for each table
      // Calculate available space for the table on the page
      //const marginX = (pageWidth - tableWidth) / 2;
      const marginY = (pageHeight - tableHeight) / 2;
    
      // Set the styles for the table headers to match the table color
      const tableStyles = {
        fillColor: [20, 53, 74], // Set your table color here (RGB)
        lineWidth: 1, // Set the border line width
      };
      
          // Function to generate table with pagination
    const generateTableWithPagination = async (tableElement, startYPosition) => {
      const tableChunks = [];

      // Split table into chunks of 1000 rows each
      for (let i = 0; i < tableElement.rows.length; i += 2000) {
        const chunk = Array.from(tableElement.rows).slice(i, i + 2000);
        const chunkTable = document.createElement('table');
        chunkTable.appendChild(document.createElement('tbody'));
        chunkTable.querySelector('tbody').append(...chunk);
        tableChunks.push(chunkTable);
      }

      // Generate PDF for each chunk
      for (let i = 0; i < tableChunks.length; i++) {
        if (i > 0) {
          doc.addPage();
        }
        await new Promise(resolve => {
          doc.autoTable({
            html: tableChunks[i],
            startY: startYPosition,
            margin: { left: marginX, right: marginX },
            headStyles: { fillColor: [20, 53, 74] }, // Set your table color here (RGB)
            styles: { lineWidth: 1 },
            rowPageBreak: 'avoid',
            didDrawPage: function(data) {
            doc.text("General Pipeline Updates / Additions", data.settings.margin.left, 20);
           }
          });
          resolve();
        });
        if (i < tableChunks.length - 1) {
          startYPosition = 30;
        }
      }
      return startYPosition;
    };
    
      // Set position for the table
      doc.autoTable({
        html: table1,
        startY: startY,
        margin: { left: marginX, right: marginX },
        headStyles: tableStyles, // Apply styles to the table headers
        styles: {
          lineWidth: 1, // Set the border line width for the entire table
        },
        rowPageBreak: 'avoid',
        didDrawPage: function(data) {
        doc.text("Top Priority Deals", data.settings.margin.left, 20);
       }
      });
      
        startY += table1.clientHeight + 20; // Adjust vertical spacing

      // Table 2
      const table2 = document.getElementById('newcompany');
      doc.autoTable({
        html: table2,
        startY: startY,
        margin: { left: marginX, right: marginX },
        headStyles: tableStyles, // Apply styles to the table headers
        styles: {
          lineWidth: 1, // Set the border line width for the entire table
        },
        rowPageBreak: 'avoid',
        didDrawPage: function(data) {
        doc.text("New Company Conversations", data.settings.margin.left, 20);
       }
      });

      startY += table2.clientHeight + 20; // Adjust vertical spacing
    
       //Table 3
      const table3 = document.getElementById('generalpipeline');
      //doc.autoTable({
        //html: table3,
        //startY: startY,
        //margin: { left: marginX, right: marginX },
        //headStyles: tableStyles, // Apply styles to the table headers
        //styles: {
          //lineWidth: 1, // Set the border line width for the entire table
       // },
        //rowPageBreak: 'avoid',
          //didDrawPage: function(data) {
          //doc.text("General Pipeline Updates / Additions", data.settings.margin.left, 20);
         //}
      // });
      
      startY = await generateTableWithPagination(table3, startY);

      startY += table3.clientHeight + 20; // Adjust vertical spacing
    
      // Table 3
      const table4 = document.getElementById('allpipeline');
      doc.autoTable({
        html: table4,
        startY: startY,
        margin: { left: marginX, right: marginX },
        headStyles: tableStyles, // Apply styles to the table headers
        styles: {
          lineWidth: 1, // Set the border line width for the entire table
        },
        rowPageBreak: 'avoid',
        didDrawPage: function(data) {
        doc.text("All pipeline companies", data.settings.margin.left, 20);
       }
      });

      // Save the PDF
      doc.save('table.pdf');
    }
    
    async function exportToPDF1() {
    $("#overlay").fadeIn(1000);

    const doc = new window.jspdf.jsPDF('l', 'pt', 'a3');
    const pageWidth = doc.internal.pageSize.getWidth();
    const marginX = 20; // Adjust margins as needed
    let startY = 30; // Adjust startY position for each table
    
    // Set the styles for the table headers to match the table color
    const tableStyles = {
        fillColor: [20, 53, 74], // Set your table color here (RGB)
        lineWidth: 1, // Set the border line width
    };
    
    // Helper function to retrieve table data in chunks
    async function getTableData(tableElement) {
        const chunkSize = 2000; // Adjust the chunk size as needed
        const tableRows = Array.from(tableElement.rows);
        const chunks = [];
        
        for (let i = 0; i < tableRows.length; i += chunkSize) {
            const chunk = tableRows.slice(i, i + chunkSize);
            const chunkHtml = chunk.map(row => row.outerHTML).join('');
            chunks.push(chunkHtml);
        }
        
        return chunks;
    }
    
    // Function to add table to PDF
    async function addTableToPDF(tableElement, title) {
        const chunks = await getTableData(tableElement);
        
        for (let i = 0; i < chunks.length; i++) {
            if (i > 0) {
                doc.addPage(); // Add new page for subsequent chunks
                startY = 30; // Reset startY for new page
            }
            doc.text(title, marginX, 20);
            doc.autoTable({
                html: chunks[i],
                startY: startY + 20,
                margin: { left: marginX, right: marginX },
                headStyles: tableStyles,
                styles: { lineWidth: 1 },
                didDrawPage: function(data) {
                    doc.text(title, data.settings.margin.left, 20);
                }
            });
            startY = doc.autoTable.previous.finalY; // Update startY for next chunk
        }
    }
    
    // Add tables to PDF
    await addTableToPDF(document.getElementById('toppriority'), "Top Priority Deals");
    await addTableToPDF(document.getElementById('newcompany'), "New Company Conversations");
    await addTableToPDF(document.getElementById('generalpipeline'), "General Pipeline Updates / Additions");
    await addTableToPDF(document.getElementById('allpipeline'), "All pipeline companies");
    $("#overlay").hide();
    // Save the PDF
    doc.save('table.pdf');
}



    
    </script>
    </body>
    </html>