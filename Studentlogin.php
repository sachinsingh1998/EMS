<?php
$regno="";
$password="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
if(empty($_POST["regno"]))
{
$ivemail="enter a your registration number";
}
else
{
	$regno=$_POST['regno']; 
	$_SESSION["regno"]=$regno;
	 header('location : student.php');
}
}
?>				
	
	<html>
		<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <meta name="description" content="Custom Login Form Styling with CSS3" />
        <meta name="keywords" content="css3, login, form, custom, input, submit, button, html5, placeholder" />
        <meta name="author" content="Codrops" />
<link rel="shortcut icon" href="../favicon.ico"> 
	<script src="js/jquery-1.3.2.min.js" type="text/javascript"></script>
	<script src="js/jquery.backgroundPosition.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(function(){
		
		  $('#midground').css({backgroundPosition: '0px 0px'});
		  $('#foreground').css({backgroundPosition: '0px 0px'});
		  $('#background').css({backgroundPosition: '0px 0px'});
		
			$('#midground').animate({
				backgroundPosition:"(-10000px -2000px)"
			}, 240000, 'linear');
			
			$('#foreground').animate({
				backgroundPosition:"(-10000px -2000px)"
			}, 120000, 'linear');
			
			$('#background').animate({
				backgroundPosition:"(-10000px -2000px)"
			}, 480000, 'linear');
			
		});
	</script>
	<style>
.error {color: #FF0000;}
body {
 background-image : url(stud.jpg);
    font-weight: 300;
    font-size: 15px;
    color: #000;
    -webkit-font-smoothing: antialiased;
}
h1,u {
	   font-family: "Times New Roman", Times, serif;
	   color : white;
    font-size: 36px;
    line-height: 40px;
}
.form-1 {
    /* Size & position */
    width: 300px;
    margin: 60px auto 30px;
    padding: 10px;
    position: relative; /* For the submit button positioning */

    /* Styles */
    box-shadow: 
        0 0 1px rgba(0, 0, 0, 0.3), 
        0 3px 7px rgba(0, 0, 0, 0.3), 
        inset 0 1px rgba(255,255,255,1),
        inset 0 -3px 2px rgba(0,0,0,0.25);
    border-radius: 5px;
    background: linear-gradient(#eeefef, #ffffff 10%);
}

.form-1 .field {
    position: relative; /* For the icon positioning */
}
.form-1 .field i {
    /* Size and position */
    left: 0px;
    top: 0px;
    position: absolute;
    height: 36px;
    width: 36px;

    /* Line */
    border-right: 1px solid rgba(0, 0, 0, 0.1);
    box-shadow: 1px 0 0 rgba(255, 255, 255, 0.7);

    /* Styles */
    color: #777777;
    text-align: center;
    line-height: 42px;
    transition: all 0.3s ease-out;
    pointer-events: none;
}
.form-1 input[type=text],
.form-1 input[type=password] {
    font-family: 'Lato', Calibri, Arial, sans-serif;
    font-size: 13px;
    font-weight: 400;
    text-shadow: 0 1px 0 rgba(255,255,255,0.8);

    /* Size and position */
    width: 100%;
    padding: 10px 18px 10px 45px;

    /* Styles */
    border: none; /* Remove the default border */
    box-shadow: 
        inset 0 0 5px rgba(0,0,0,0.1),
        inset 0 3px 2px rgba(0,0,0,0.1);
    border-radius: 3px;
    background: #f9f9f9;
    color: #777;
    transition: color 0.3s ease-out;
}

.form-1 input[type=text] {
    margin-bottom: 10px;
}

.form-1 input[type=text]:hover ~ i,
.form-1 input[type=password]:hover ~ i {
    color: #52cfeb;
}

.form-1 input[type=text]:focus ~ i,
.form-1 input[type=password]:focus ~ i {
    color: #42A2BC;
}

.form-1 input[type=text]:focus,
.form-1 input[type=password]:focus,
.form-1 button[type=submit]:focus {
    outline: none;
}
.form-1 .submit {
    /* Size and position */
    width: 65px;
    height: 65px;
    position: absolute;
    top: 17px;
    right: -25px;
    padding: 10px;
  
    /* Styles */
    background: #ffffff;
    border-radius: 50%;
    box-shadow: 
        0 0 2px rgba(0,0,0,0.1),
        0 3px 2px rgba(0,0,0,0.1),
        inset 0 -3px 2px rgba(0,0,0,0.2);
}
.form-1 button {
    /* Size and position */
    width: 100%;
    height: 100%;
    margin-top: -1px;

    /* Icon styles */
    font-size: 1.4em;
    line-height: 1.75;
    color: white;

    /* Styles */
    border: none; /* Remove the default border */
    border-radius: inherit;
    background: #52cfeb; /* Fallback */
    background: -moz-linear-gradient(#52cfeb, #42A2BC);
    background: -ms-linear-gradient(#52cfeb, #42A2BC);
    background: -o-linear-gradient(#52cfeb, #42A2BC);
    background: -webkit-gradient(linear, 0 0, 0 100%, from(#52cfeb), to(#42A2BC));
    background: -webkit-linear-gradient(#52cfeb, #42A2BC);
    background: linear-gradient(#52cfeb, #42A2BC);
    box-shadow: 
        inset 0 1px 0 rgba(255,255,255,0.3),
        0 1px 2px rgba(0,0,0,0.35),
        inset 0 3px 2px rgba(255,255,255,0.2),
        inset 0 -3px 2px rgba(0,0,0,0.1);

    cursor: pointer;
}

.icon-arrow-right:before          { content: "\f061"; }
.container{
    padding-top: 90px;
    padding-bottom: 90px;
}
		</style>
		<style>

</style>
	<title>
Faculty page
	</title>
		</head>
 <body>
<div class="container">
	
 <h1><center><u>STUDENT LOGIN</u></center> </h1>
 	<form  method="POST" action="student.php"  class="form-1"> 
	Registration number:
	<p class="field">
	<input type="text" name="regno" placeholder="Registration  number" >
	<i class="fa fa-address-book"></i>
	</p>
	<br>
	<p class="submit">
    	<button type="submit" name="submit" onsubmit="first.php"><i class="fa fa-arrow-circle-right"  style="font-size:38px;color:white"></i></button>
	</p>
	  </form>
</div>
</div></body>
</html>