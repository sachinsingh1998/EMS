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
	<h1> <?php  echo "message sent"?></h1>
	<?php
	 }
	 
}
 }
	}}
 
 ?>

 