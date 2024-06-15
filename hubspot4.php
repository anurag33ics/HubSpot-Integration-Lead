<?php session_start();
// echo"ss". isset($_SESSION['username']);
if(!isset($_SESSION['username']) ){
    header("Location:index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title> View list</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
* {
  box-sizing: border-box;
}

input[type="text"],
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

input[type="submit"] {
  background-color: #04aa6d;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type="submit"]:hover {
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
  input[type="submit"] {
    width: 100%;
    margin-top: 0;
  }
}

#overlay {
  position: fixed;
  top: 0;
  z-index: 100;
  width: 100%;
  height: 100%;
  display: none;
  background: rgba(0, 0, 0, 0.6);
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
.is-hide {
  display: none;
}
/* Turn off scrollbar when body element has the loading class */
body.loading {
  overflow: hidden;
}
/* Make spinner image visible when body element has the loading class */
body.loading .overlay {
  display: block;
}

.differncetbl tr td {
  background-color: transparent !important;
}

@import url("font/InterTight-Regular.ttf");
body {
  background: rgb(20, 53, 74);
  font-family: "InterTight-Regular";
}
h2 {
  color: #000;
  text-align: center;
  font-size: 2em;
}
.warpper {
  display: flex;
  flex-direction: column;
  align-items: center;
}
.tab {
  cursor: pointer;
  padding: 10px 20px;
  margin: 0px 2px;
  background: #000;
  display: inline-block;
  color: #fff;
  border-radius: 3px 3px 0px 0px;
  box-shadow: 0 0.5rem 0.8rem #00000080;
}
.panels {
  background: #fffffff6;
  box-shadow: 0 2rem 2rem #00000080;
  min-height: 200px;
  width: 100%;
  max-width: 99%;
  border-radius: 3px;
  overflow: hidden;
  padding: 20px;
}
.panel {
  display: none;
  animation: fadein 0.8s;
}
@keyframes fadein {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
.panel-title {
  font-size: 1.5em;
  font-weight: bold;
}
.radio {
  display: none;
}
#one:checked ~ .panels #one-panel,
#two:checked ~ .panels #two-panel,
#three:checked ~ .panels #three-panel,
#four:checked ~ .panels #four-panel {
  display: block;
}
#one:checked ~ .tabs #one-tab,
#two:checked ~ .tabs #two-tab,
#three:checked ~ .tabs #three-tab,
#four:checked ~ .tabs #four-tab {
  background: #fffffff6;
  color: #000;
  border-top: 3px solid #000;
}

    </style>
</head>
<?php 
$folderPath = "csv/";
// Get the list of files in the folder
$files = scandir($folderPath);
// Remove "." and ".." from the list
$files = array_diff($files, array('.', '..'));

// Output the list of files

?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

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
                    <!-- <input type="date" class="form-control" id="date" name="date"> -->
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
                    <!-- <input type="date" class="form-control" id="date2" name="date2"> -->
                </div>
                <div class="col-md-2">
                    <label >Select Object </label>
                    <select id="objname" class="form-control">
                        <option value="company">Company</option>
                        <!-- <option value="contact">Contact</option>
                        <option value="deals">Deals</option> -->
                    </select>
                </div>
                <div class="col-md-1">
                    <label>&nbsp;</label>
                    <input type="button" id="submit" value="Submit" class="form-control" style="width: 100px;" >
                </div>
                <div class="col-md-2">
                      <label>&nbsp;</label>
                <a id="btnExportAll" style="display: block; 
                padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;" onclick="exportTableToExcel('exportAll','All-Data-Export')">Export All <img src="file-export-solid.svg" style='cursor: pointer;' width="20px"/></a>
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
                <!--<div class="col-md-3">-->
                <!--<a id="btnExportAll" onclick="exportTableToExcel('exportAll','All-Data-Export')">Export All <img src="file-export-solid.svg" style='cursor: pointer;' width="20px"/></a>-->
                <!--</div>-->
            </div>
            <!-- <div class="row" id="response"> -->
                <!-- <div style="width:49% ;border:1px solid red; margin-right:10px; overflow: auto;" id="div1"></div> -->
                <!-- <div style="width:98% ;border:1px solid blue;  overflow: auto;" id="div2"></div>
            </div> -->
        </form>
        
    </div>
    <!-- <h2></h2> -->
<div class="warpper">
  <input class="radio" id="one" name="group" type="radio" checked>
  <input class="radio" id="two" name="group" type="radio">
  <input class="radio" id="three" name="group" type="radio">
  <input class="radio" id="four" name="group" type="radio">
  <div class="tabs">
  <label class="tab" id="one-tab" for="one">Section 1 – Top Priority Deals</label>
  <label class="tab" id="two-tab" for="two" onclick="setDataForTableTwo()">Section 2 – New Company Conversations</label>
  <label class="tab" id="three-tab" for="three">Section 3 – General Pipeline Updates / Additions</label>
  <label class="tab" id="four-tab" for="four">Section 4 – All pipeline companies</label>
    </div>
  <div class="panels">
  <div class="panel" id="one-panel">
    <div class="panel-title" id='deal1'>Top Priority Deals
     <a id="btnExport" onclick="exportTableToExcel('toppriority','Top-Priority')"> <img src="file-export-solid.svg" style='cursor: pointer;' width="20px"/></a>
    </div>
    <div class="row" >
        
        
        <table border="1" class="table differncetbl" id="tblUser">
        <thead>
            <tr style='background-color: #14354a; border: 1px solid black;'>
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
        </tr>
        </thead>
        <tbody id="topprio"></tbody>
        </table>
        
                <!-- <div style="width:49% ;border:1px solid red; margin-right:10px; overflow: auto;" id="div1"></div> -->
                <div style="display:none;width:98% ;border:1px solid blue;  overflow: auto;" id="div2"></div>
            </div>
  </div>
  <div class="panel" id="two-panel">
    <div class="panel-title" id='deal2'>New Company Conversations
    <a id="btnExport" onclick="exportTableToExcel('newcompany','New-Company')"> <img src="file-export-solid.svg" style='cursor: pointer;' width="20px"/></a>
    </div>
    <div class="row" >
           <table border="1" class="table differncetbl" id="tblUser1" style="width: -webkit-fill-available !important;">
        <thead>
            <tr style='background-color: #14354a; border: 1px solid black;'>
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
    </tr>
        </thead>
        <tbody id="newcomp">
            <tr></tr>
        </tbody>
        </table>
                <div style="display:none;width:98% ;border:1px solid blue;  overflow: auto;" id="div3"></div>
            </div>
  </div>
  <div class="panel" id="three-panel">
    <div class="panel-title" id="deal3">General Pipeline Updates / Additions
    <a id="btnExport" onclick="exportTableToExcel('generalpipeline','General-Pipeline')"> <img src="file-export-solid.svg" style='cursor: pointer;' width="20px"/></a>
    </div>
    <div class="row" >
                 <table border="1" class="table differncetbl" id="tblUser2">
        <thead>
            <tr style='background-color: #14354a; border: 1px solid black;'>
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
    </tr>
        </thead>
        <tbody id="genpipe"></tbody>
        </table>
                <div style="display:none;width:98% ;border:1px solid blue;  overflow: auto;" id="div4"></div>
    </div>
  </div>
  <div class="panel" id="four-panel">
    <div class="panel-title" id="deal4">All pipeline companies
    <a id="btnExport" onclick="exportTableToExcel('allpipeline','All-pipeline')"> <img src="file-export-solid.svg" style='cursor: pointer;' width="20px"/></a></div>
    <div class="row" >
                 <table border="1" class="table differncetbl" id="tblUser3">
        <thead>
            <tr style='background-color: #14354a; border: 1px solid black;'>
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
    </tr>
        </thead>
        <tbody id="allpipe"></tbody>
        </table>
                <div style="display:none;width:98% ;border:1px solid blue;  overflow: auto;" id="div5"></div>
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

</style>
    <script>
    
    let _dateOfTableTwo = '';
$("#overlay").hide();
$(document).on({
    ajaxStart: function() {
        $("body").addClass("loading");
        $("#overlay").fadeIn(1000);
    },
    ajaxStop: function() {
        $("#overlay").fadeOut(300);
        $("body").removeClass("loading");
    }
});

$("#logout").on("click", function() {
    let cnf = confirm("Are you sure want to logout");
    if (cnf) {
        $.ajax({
            url: 'ajax.php?action=logout',
            method: "POST",
            data: {},
            success: function(res) {
                alert("Logout Successfully");
                setTimeout(() => {
                    window.location.href = 'index.php';
                }, 2000);
            }

        })
    }
})
$("#btnExportAll").prop('disabled', true);
$("#submit").on("click", function() {
    $("#btnExportAll").prop('disabled', true);
    let date = $("#date").val();
    let date2 = $("#date2").val();
    let objname = $("#objname").val();
    if (date != '' && objname != '' && date2 != '') {
        $.ajax({
            // url: 'ajax.php?action=getdata',
            url: 'ajax1.php?action=comparedata',
            method: "POST",
            data: {
                date: date,
                objname: objname,
                date2: date2
            },

            success: function(res) { 
                $('#submit').prop('disabled', true);
                if (res == 1)
                    $("#div2").html("File not found").addClass("alert alert-danger");
                else {
                    let divideSec = res.split("!@#$%");
                    // console.table(divideSec);
                    // console.log('divideSec.length '+divideSec.length);
                    // for compa
                    // $("#div2").html(divideSec[0]);
                    // $("#div3").html(divideSec[1]);
                    // $("#div4").html(divideSec[2]);
                    // $("#div5").html(divideSec[3]);
                    // $("#div2").append(divideSec[4]);
                    //              for data tables

                     
                    _dateOfTableTwo = divideSec[6];
                    

                    // let table1 = $('#tblUser1').DataTable();
                    // table1.destroy();
                    
                        let table = $('#tblUser').DataTable();
                        table.destroy();

                        $("#topprio").html(divideSec[5]);
                        table =$('#tblUser').DataTable();

                    // $("#newcomp").html(divideSec[6]);
                    // $("#genpipe").html(divideSec[7]);
                    // $("#allpipe").html(divideSec[8]);
                    
                    // let table1 = $('#tblUser1').DataTable();
                    // //table1.destroy();

                    // $("#newcomp").html(divideSec[6]);
                    // table1 =$('#tblUser1').DataTable();
                        
                    
                    // var table = $('#tblUser3').DataTable();
                    //     table.destroy();

                    //     $("#allpipe").html(divideSec[8]);
                    //     table =$('#tblUser').DataTable( {
                    //         buttons: [
                    //             'copy', 'excel', 'pdf'
                    //         ]
                    //     } );
                    $('#submit').prop('disabled', false);
                    $("#btnExportAll").prop('disabled', false);

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
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error:", textStatus, errorThrown);
                // Handle error here
                $("#overlay").fadeOut(300);
                $("body").removeClass("loading");
            }
        })

    } else {
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
    const year = d.getFullYear();
    let month = d.getMonth() + 1;
    let day = d.getDate();
    if (day < 10)
        day = "0" + day;
    if (month < 10)
        month = "0" + month;
    const filename = "csv/company-" + year + "-" + month + "-" + day + ".csv";
    var http = new XMLHttpRequest();
    http.open('HEAD', filename, false);
    http.send();
    if (http.status != 404) {
        alert("Today's File exist, not need to import");
    } else {
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

function getUrlId(obj) {
    $('#importFrmHubspot').prop('disabled', true);

    // $('#importFrmHubspot').prop('disabled', true);
    $.ajax({
        url: 'hubspot-export.php?obj=' + obj,
        method: "GET",
        success: function(res) {
            setTimeout(() => {
                saveFile(res, obj)
            }, 20000);
            // $("#response").html("Response added successfully").addClass("alert alert-success");
        }

    })
}

function saveFile(url, obj) {
    $.ajax({
        url: 'get-file.php?obj=' + obj + '&url=' + url,
        method: "GET",
        success: function(res) {
            if (res == "0") {
                setTimeout(() => {
                    $('#importFrmHubspot').prop('disabled', true);
                    saveFile(url, obj)

                }, 10000);
            } else
                $("#response").html("data imported successfully").addClass("alert alert-success");
            $('#importFrmHubspot').prop('disabled', false);
            // $('#importFrmHubspot').html("Import");
            $('#importFrmHubspot').prop("value", "Import");

        }

    })
}

// $(".viewDiff").on("click", function(){
$(document).on("click", ".viewDiff", function(evt) {
    evt.preventDefault();
    let rowid = $(this).attr("data-id");
    let color = $(this).attr("data-color");
    let filepath = $(this).attr("data-filepath");
    let filepath1 = $(this).attr("data-filepath1");
    if (color != 'white') {
        $.ajax({
            url: 'ajax.php?action=getDiffData',
            method: "POST",
            data: {
                rowid: rowid,
                filepath: filepath,
                filepath1: filepath1
            },
            success: function(res) {
                $("#modalTitle").html("Show for Record Id- " + rowid);
                $("#modalBody").html(res);
                $("#showdiffdata").modal("show");
            }
        })

    }
})



function exportTableToExcel(tableId, filename = '') {
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
    if (table.id == "exportAll") {
        for (let i = 0; i < rows.length; i++) {

            const row = rows[i];
            const rowData = [];
            const cells = row.querySelectorAll('td, th');

            for (let j = 0; j < cells.length; j++) {
                rowData.push(sanitizeForCSV(cells[j].innerText));
            }

            data.push(rowData.join(','));

        }
    } else {
        for (let i = 0; i < rows.length; i++) {
            if (i > 1) {
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
    const csvContent = data.join('\n');

    // Create a Blob
    const blob = new Blob([csvContent], {
        type: 'text/csv'
    });

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
    if (input.includes(',') || input.includes('"')) {
        return '"' + input.replace(/"/g, '""') + '"';
    } else {
        return input;
    }
}
    </script>
    
    <script>
jQuery(document).ready(function($) {
    $('#tblUser').DataTable( {
        buttons: [
            'copy', 'excel', 'pdf'
        ]
    } );
    
    

} );

function setDataForTableTwo(){
    
    console.log('called');

 
    
    //$('#tblUser1, #tblUse2, #tblUse3').DataTable().destroy(); 

    // Clear existing table bodies
    $('#tblUser1 tbody, #tblUser2 tbody, #tblUser3 tbody').empty();
     
  
    $("#newcomp").append(_dateOfTableTwo);
      console.log('called end');
    $('#tblUser1').DataTable();                    
console.log('called end 2');
    
}
</script>
</body>
<!-- my pat-na1-3f5bf83f-bbf0-4d66-957e-86ef845ce4ba -->
</html>