<html>
<head>
<title>
Duty allocated
</title>
<style>
table {
    border-collapse: collapse;
    width: 100%;
}
th{
    text-align: left;
    padding: 10px;
  border: 3px solid black;
	}
td{
    text-align: left;
    padding: 10px;
  border: 1px solid black;
	}
.container{
    padding-top: 90px;
    padding-bottom: 90px;
}
tr:nth-child(even) {background-color: #f2f2f2;}
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #111;
}

.active {
    background-color: #4CAF50;
}
</style>
</head>
<body>

<ul>
 <li style="float:right"><a class="active" href="facultypage.php">Logout</a></li>
 <li style="float:right"><a  class="active" href="faculty.php">Home</a></li>
 
</ul>
<?php

 session_start();
if(isset($_GET['a']))/*desfno and dessno of the faculty*/{
	$desfno=$_GET['a'];
	if(isset($_GET['b']))
	{
		if(isset($_GET['sql1'])){
			$srcdate=$_GET['sql1'];
		if(isset($_GET['sql2'])){
$srcbeg=$_GET['sql2'];
$srcroomno=$_GET['sql3'];			
		$dessno=$_GET['b'];
	if(isset($_GET['c'])){//	 //srcsno of the particular swap
$srcsno=$_GET['c'];
$srcfno=$_SESSION['srcfno'];
$desroomno=$_GET['sql4'];
$desbeg=$_GET['sql5'];
$desdate=$_GET['sql6'];
	$db = mysqli_connect("localhost","root","","ems");
	$x="insert into swap values ('$srcdate','$srcbeg','$srcroomno','$srcfno','$srcsno','$desfno','$dessno','$desroomno','$desbeg','$desdate',2)";
	 $result1 = mysqli_query($db, $x);
	 if($result1){?>
	<h1><center> <?php  echo "message sent"?><center></h1>
	<?php
	 }
	 
}
 }
}}}
 ?>
 </body>
</html>


 