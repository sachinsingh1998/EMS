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
</style>
</head>
<body>
<div class="container">
<h2><center><u>Duty Allocated</u></center></h2>
<?php

 session_start();
 $name=$password="";
$name=$_POST["name"];
$password=$_POST["pass"];
$ivemail="";
$invpas="";

$db = mysqli_connect("localhost","root","","ems");
if(!$db){		
				die("Connection failed");
				}
$sql= "SELECT COUNT(*) FROM teacher WHERE fname='$name' and password='$password'";
 $result = mysqli_query($db, $sql);
 if($result === FALSE) { 
    echo "connetion failed"; // TODO: better error handling
}

 if(mysqli_num_rows($result)==0){
echo	"Invalid name or password";
 }
 else{
	$count=0;//to calculate total no of students giving the exam
	$row="SELECT session.roomno as a,session.date as i,session.begining as b,session.ending as c,session.sno as s,teacher.fno as f from session INNER JOIN teacher where teacher.fno=session.invig_duty and teacher.fname='$name'";
 $result = mysqli_query($db, $row);
 ?>
     <form method="POST" action="faculty1.php">
<table>
	<thead>
		<tr>
<th width="10%"><b><input type="submit" name="swap" value="Swap"><b></th>
	<th>Room Number</th>
	<th>date</th>
	<th>Begining</th>
	<th>ending</th>
</tr>
</thead>
<?php 	
while ($row = mysqli_fetch_array($result)) { ?>
 <?php $_SESSION['srcfno']=$row['f']; ?>
	<tr>
		<td><input type="checkbox" name="chk[]"  class="checkbox" value='<?php echo $row['s']; ?>'/></td>
		<td><?php echo $row['a']; ?></td>
		<td><?php echo $row['i']; ?></td>
		<td><?php echo $row['b']; ?></td>
		<td><?php echo $row['c']; ?></td>
	</tr>
	<?php } ?>
 <?php }?>
</table>
</form>
</div>
<?php 

 ?>
      <form method="POST" action="faculty2.php">
<table>
	<thead>
		<tr>
<th width="10%"><b><input type="submit" name="accept" value="acc"><b></th>
	<th>Room Number</th>
	<th>date</th>
	<th>Begining</th>
	<th>ending</th>
</tr>
</thead>
<?php 
$d=$_SESSION['srcfno'];
$w="select srcfno,srcsno,dessno,desfno from swap where app=2 and desfno='$d'";//2 means still in waiting
 $resultz = mysqli_query($db, $w);
while ($row1 = mysqli_fetch_array($resultz)) { ?>
    <?php
	$h="SELECT session.roomno as a,session.date as i,session.begining as b,session.ending as c,session.sno as s,teacher.fno as f from session INNER JOIN teacher where  teacher.fno=session.invig_duty and teacher.fno='".$row1['srcfno']."' and session.sno='".$row1['srcsno']."'";
	 $result1 = mysqli_query($db, $h);?>
	 <h1><?php echo "Requests  Swapping duty"; ?></h1>
	 <?php while ($row2 = mysqli_fetch_array($result1)) { ?>
			<tr>
			<td><input type="checkbox" name="chk[]"  class="checkbox" value='<?php echo $row1['srcsno']; ?>'/></td>
		<td><?php echo $row2['a']; ?></td>
		<td><?php echo $row2['i']; ?></td>
		<td><?php echo $row2['b']; ?></td>
		<td><?php echo $row2['c']; ?></td>
		</tr>
<?php }} ?>
</body>
</html>
