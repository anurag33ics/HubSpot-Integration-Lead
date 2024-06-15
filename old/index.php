<!DOCTYPE html>
<html>

<head>
    <title> View list</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
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

<body>


    <div class="container">
        <form>
            <div class="row">
                <div class="col-100" style="text-align: center;font-weight:bold">
                    Display Data
                </div>

            </div>
            <div class="row">
                <div class="col-md-2">
                    <label>Date 1</label>
                    <input type="date" class="form-control" id="date" name="date">
                </div>
                <div class="col-md-2">
                    <label>Date 2</label>
                    <input type="date" class="form-control" id="date2" name="date2">
                </div>
                <div class="col-md-2">
                    <label >Select Object </label>
                    <select id="objname" class="form-control">
                        <option value="company">Company</option>
                        <option value="contact">Contact</option>
                        <option value="deals">Deals</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>&nbsp;</label>
                    <input type="button" id="submit" value="Submit" class="form-control" style="width: 100px;" >
                </div>
                <div class="col-2">    
                    <input type="button" id="importFrmHubspot" value="Import" class="form-control" >
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">&nbsp;
                </div>
            </div>
            <div class="row" id="response">
                <div style="width:49% ;border:1px solid red; margin-right:10px; overflow: auto;" id="div1"></div>
                <div style="width:49% ;border:1px solid blue;  overflow: auto;" id="div2"></div>
            </div>
        </form>
    </div>
    <script>
        $("#submit").on("click", function() {
            let date = $("#date").val();
            let date2 = $("#date2").val();
            let objname = $("#objname").val();
            if(date!='' && objname!='' ){
                $.ajax({
                url: 'ajax.php?action=getdata',
                method: "POST",
                data: {
                    date: date, objname:objname, date2:date2
                },
                success: function(res) {
                    if(res==1)
                        $("#div1").html("File not found").addClass("alert alert-danger");
                    else    
                        $("#div1").html(res);
                        if(date2!=''){
                            $.ajax({
                                url: 'ajax.php?action=getdata',
                                method: "POST",
                                data: {
                                    date: date2, objname:objname,
                                },
                                success: function(res) {
                                    if(res==1)
                                        $("#div2").html("File not found").addClass("alert alert-danger");
                                    else    
                                        $("#div2").html(res);       
                                }
                            })
                        }
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
            
                getUrlId("deals")
            
            setTimeout(() => {
                getUrlId("contact")
            }, 20000);
            setTimeout(() => {
                getUrlId("company")
            }, 40000);
        });
    function getUrlId(obj){
        $.ajax({
                url: 'hubspot-export.php?obj='+obj,
                method: "GET",
                success: function(res) {
                    setTimeout(() => {
                        saveFile(res,obj)
                    }, 10000);
                    // $("#response").html("Response added successfully").addClass("alert alert-success");
                }

            })
    }
    function saveFile(url,obj){
        $.ajax({
                url: 'get-file.php?obj='+obj+'&url='+url,
                method: "GET",
                success: function(res) {
                  if(res=="0")
                    saveFile(url,obj)  
                 else
                    $("#response").html("data imported successfully").addClass("alert alert-success");
                }

            })
    }
    </script>
</body>
<!-- my pat-na1-3f5bf83f-bbf0-4d66-957e-86ef845ce4ba -->
</html>