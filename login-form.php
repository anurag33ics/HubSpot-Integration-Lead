<!DOCTYPE html> 
<html> 

<head> 
	<title>Hubspot</title> 
	<link rel="stylesheet"
		href="style.css"> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
.buttonload {
  background-color: #04AA6D; /* Green background */
  border: none; /* Remove borders */
  color: white; /* White text */
  padding: 12px 24px; /* Some padding */
  font-size: 16px; /* Set a font-size */
}

/* Add a right margin to each icon */
.fa {
  margin-left: -12px;
  margin-right: 8px;
}
</style>
</head> 

<body> 
	<div class="main"> 
		<div>
        <img src="AIM Equity Partners Logo -Blue.jpg" style="height: 80px;width:150px;">  
       <!--  <h1>Pipeline Sorting Project</h1>  -->
		   </div>
        <h2>Login</h2>    
      
		<form > 
			<label for="first"> 
				Username: 
			</label> 
			<input type="text"
				id="username"
				name="first"
				placeholder="Enter your Username" required> 

			<label for="password"> 
				Password: 
			</label> 
			<input type="password"
				id="password"
				name="password"
				placeholder="Enter your Password" required> 

			<div class="wrap"> 
				<button type="button" id="submit" > <i  id="spin" class="fa fa-spinner fa-spin "></i>	Submit 	</button> 
			</div> 
		</form> 
		 <p id='response'> </p> 
	</div> 
    <script>
        $('#spin').hide();
        $("#submit").on("click", function() {

            let username = $("#username").val();
            let password = $("#password").val();
           
            if(username!='' && password!='' ){
                $('#submit').prop('disabled', true);
                $('#spin').show();
                $.ajax({
            
                url: 'ajax.php?action=verifyLogin',
                method: "POST",
                data: {
                    username: username, password:password
                },
                success: function(res) {
                       if(res==0){
                        $('#submit').prop('disabled', false);

                        $("#response").html("Invalid Credentials").css("color","red");
                        $('#spin').hide();
                       }
                        
                    else {  
                        $('#submit').prop('disabled', false);
                        $("#response").html("Login Successfully").css("color","green");
                        setTimeout(function(){
                            $('#spin').hide();
                            window.location.href='hubspot-dataview.php';
                        },2000 );
                    }

                }
            })
            }else{
                $("#response").html("Please enter username and password").css("color","red");
            }

        })

    </script>
</body> 

</html>
