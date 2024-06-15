<?php session_start();
if(!isset($_SESSION['username']) ){
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title> View list</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
    @import url('font/InterTight-Regular.ttf');
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

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {

            .col-25,
            .col-75,
            input[type=submit] {
                width: 100%;
                margin-top: 0;
            }
        }
    </style>
</head>
<?php 
$folderPath = "csv/";
// Get the list of files in the folder
$files = scandir($folderPath);
// Remove "." and ".." from the list
$files = array_diff($files, array('.', '..'));
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
                <div class="col-md-2">
                      <label>&nbsp;</label>
                <a id="btnExportAll" style="display: block; padding: 0.375rem 0.75rem; font-size: 1rem;  font-weight: 400;line-height: 1.5;" onclick="exportTableToExcel('exportAll','All-Data-Export')">Export All <img src="file-export-solid.svg" style='cursor: pointer;' width="20px"/></a>
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
    <div class="panel-title" id='deal1'>Top Priority Deals
     <a id="btnExport" onclick="exportTableToExcel('toppriority','Top-Priority')"> <img src="file-export-solid.svg" style='cursor: pointer;' width="20px"/></a>
     <a id="btnExport" onclick="downloadPDF('toppriority')">Export PDF <img src="file-export-solid.svg" style='cursor: pointer;' width="20px"/></a>
    </div>
        <div class="row" >
            <div class='col-md-2'>
                <select class="form-control" id='filterbyname'>
                    <option value='0' selected disabled> Short Name</option>
                    <option value='asc-toppriority'>Short by Name Asc</option>
                    <option value='desc-toppriority'>Short by Name Des</option>
                </select>
            </div>
            <div class='col-md-2'>
                <select class="form-control" id='filterbyhighlighted'>
                    <option value='0' selected disabled> Short By Color</option>
                    <option value='false-toppriority'>Highlighted</option>
                    <option value='true-toppriority'> Non-Highlighted</option>
                </select>
            </div>
        </div>
    <div class="row" >
        <p><button onclick="sortTableByColor('toppriority', false)">Sort By Highlighted</button></p><p><button onclick="sortTableByColor('toppriority', true)">Sort By Non-Highlighted</button></p>
               <label>
    <input type="checkbox" onclick="toggleColumn(0,'toppriority')"> Company Name
</label>
 <!-- <div style="width:49% ;border:1px solid red; margin-right:10px; overflow: auto;" id="div1"></div> -->
                <div style="width:98% ;border:1px solid blue;  overflow: scroll;" id="div2"></div>
                
            </div>
  </div>
  <div class="panel" id="two-panel">
    <div class="panel-title" id='deal2'>New Company Conversations
    <a id="btnExport" onclick="exportTableToExcel('newcompany','New-Company')"> <img src="file-export-solid.svg" style='cursor: pointer;' width="20px"/></a>
    </div>
    <div class="row" >
                <!-- <div style="width:49% ;border:1px solid red; margin-right:10px; overflow: auto;" id="div1"></div> -->
                <div style="width:98% ;border:1px solid blue;  overflow: scroll;" id="div3"></div>
            </div>
  </div>
  <div class="panel" id="three-panel">
    <div class="panel-title" id="deal3">General Pipeline Updates / Additions
    <a id="btnExport" onclick="exportTableToExcel('generalpipeline','General-Pipeline')"> <img src="file-export-solid.svg" style='cursor: pointer;' width="20px"/></a>
    </div>
    <div class="row" >
                <!-- <div style="width:49% ;border:1px solid red; margin-right:10px; overflow: auto;" id="div1"></div> -->
                <div style="width:98% ;border:1px solid blue;  overflow: scroll;" id="div4"></div>
    </div>
  </div>
  <div class="panel" id="four-panel">
    <div class="panel-title" id="deal4">All pipeline companies
    <a id="btnExport" onclick="exportTableToExcel('allpipeline','All-pipeline')"> <img src="file-export-solid.svg" style='cursor: pointer;' width="20px"/></a></div>
    <div class="row" >
        <p><button onclick="sortTable2(0,'allpipeline')">Sort By Name</button></p>
                <!-- <div style="width:49% ;border:1px solid red; margin-right:10px; overflow: auto;" id="div1"></div> -->
                <div style="width:98% ;border:1px solid blue;  overflow: scroll;" id="div5"></div>
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
<style>
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
@keyframes sp-anime {
  100% { 
    transform: rotate(360deg); 
  }
}
.is-hide{
  display:none;
}
/* Turn off scrollbar when body element has the loading class */
body.loading{
    overflow: hidden;   
}
/* Make spinner image visible when body element has the loading class */
body.loading .overlay{
    display: block;
}
</style>
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
                url: 'ajax-anurag.php?action=logout',
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
                // url: 'ajax.php?action=getdata',
                url: 'ajax-anurag.php?action=comparedata',
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
                         sortTable2(0,'toppriority','asc');
                         sortTableByColor('toppriority', false);
                         //sortTable2(0,'newcompany');
                         //sortTable2(0,'generalpipeline');
                        //  sortTable2(0,'allpipeline','asc');
                           
                    }
                    $('#submit').prop('disabled', false);
                    $("#btnExportAll").prop('disabled',false);
                        
                        // if(date2!=''){
                        //     $.ajax({
                        //         url: 'ajax.php?action=comparedata',
                        //         method: "POST",
                        //         data: {
                        //             date: date, objname:objname,date2:date2
                        //         },
                        //         success: function(res) {
                        //             if(res==1)
                        //                 $("#div2").html("File not found").addClass("alert alert-danger");
                        //             else    
                        //                 $("#div2").html(res);       
                        //         }
                        //     })
                        // }
                }

            })
            }else{
                $("#response").html("Please select the date and Object").addClass("alert alert-danger");
            }

        })

        $("#importFrmHubspot").on("click", function() {
            // $.ajax({
            //     url: 'hubspot-export.php',
            //     method: "GET",
            //     success: function(res) {
            //         $("#response").html("Response added successfully").addClass("alert alert-success");
            //     }

            // })
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
                // getUrlId("company")
            
            // setTimeout(() => {
            //     getUrlId("contact")
            // }, 20000);
            // setTimeout(() => {
            //     getUrlId("company")
            // }, 40000);
        });
    function getUrlId(obj){
        $('#importFrmHubspot').prop('disabled', true);
        
        // $('#importFrmHubspot').prop('disabled', true);
        $.ajax({
                url: 'hubspot-export.php?obj='+obj,
                method: "GET",
                success: function(res) {
                    setTimeout(() => {
                        saveFile(res,obj)
                    }, 20000);
                    // $("#response").html("Response added successfully").addClass("alert alert-success");
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
                // $('#importFrmHubspot').html("Import");
                $('#importFrmHubspot').prop("value", "Import");
                    
                }

            })
    }
    </script>
    <style>
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
@keyframes fadein {
    from {
        opacity:0;
    }
    to {
        opacity:1;
    }
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
    </style>
    <script>
        // $(".viewDiff").on("click", function(){
            $(document).on("click", ".viewDiff", function (evt) {
                evt.preventDefault();
            let rowid = $(this).attr("data-id");
            let color = $(this).attr("data-color");
            let filepath = $(this).attr("data-filepath");
            let filepath1 = $(this).attr("data-filepath1");
            if(color!='white' && color!='blue' ){
                $.ajax({
                    url: 'ajax-anurag.php?action=getDiffData',
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

            // Iterate through rows and cells to extract data
        //     for (let i = 0; i < rows.length; i++) {
        //         if(i>1){
        //         const row = rows[i];
        //         const rowData = [];
        //         const cells = row.querySelectorAll('td, th');

        //         for (let j = 0; j < cells.length; j++) {
        //             rowData.push(sanitizeForCSV(cells[j].innerText));
        //         }

        //         data.push(rowData.join(','));
        //     }
        // }
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

function sortTable2(n, id, direction) {
    var table = document.getElementById(id);
    var rows = Array.from(table.rows).slice(2); // Exclude the header row
    // var dir = table.getAttribute("data-sort-dir") || "asc"; // Get current sort direction or default to "asc"
    var dir =direction;
    function partition(arr, low, high) {
        var pivot = arr[Math.floor((low + high) / 2)].getElementsByTagName("td")[n].textContent;
        var i = low;
        var j = high;
        while (i <= j) {
            if (dir === "asc") {
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
    dir = (dir === "asc") ? "desc" : "asc";
    table.setAttribute("data-sort-dir", dir); // Update sort direction attribute
}




    function sortTableByColor(tableId, reverse) {
    var table = document.getElementById(tableId);
    var rows = table.getElementsByTagName('tr');
    var sortedRows = Array.prototype.slice.call(rows, 2);

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

function toggleColumn(columnIndex, myTable) {
        var table = document.getElementById(myTable);
        if (!table) {
            console.error("Table with ID 'myTable' not found.");
            return;
        }

        var rows = table.rows;
        var isChecked = document.querySelectorAll("input[type='checkbox']")[columnIndex].checked;
        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].cells;
            if (cells.length > columnIndex) {
                var cell = cells[columnIndex];
                cell.style.display = isChecked ? "" : "none";
            }
        }
    }


</script>
<script>
    $("#filterbyname").on("change",function(){
       let order = $("#filterbyname").val();
       if(order!=0){
       order = order.split("-");
       sortTable2(0,order[1],order[0]);    
       }
    })
    
    $("#filterbyhighlighted").on("change",function(){
       let order = $("#filterbyhighlighted").val();
       if(order!=0){
       var data = order.split("-");
       sortTableByColor(data[1],data[0]);    
       }
    })
   
</script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.js"></script>


    <script>
function downloadPDF(id) {
//   const element = document.getElementById(id);
 var element = document.getElementById("toppriority");
  html2pdf(element)
    .from(element)
    .save(id+".pdf");
}
</script>


</body>
<!-- my pat-na1-3f5bf83f-bbf0-4d66-957e-86ef845ce4ba -->
</html>