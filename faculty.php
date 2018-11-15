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
<body background="bg.jpg">
<ul>
  <li style="float:right"><a class="active" href="facultypage.php">Logout</a></li>
</ul>
<div class="container">
<h2><center><u>Duty Allocated</u></center></h2>
<?php

 session_start();
 $name=$password="";
if(isset($_POST["name"])){
 $_SESSION['name']=$_POST["name"];
$_SESSION['pass']=$_POST["pass"];
 }
$name= $_SESSION['name'];
$password=$_SESSION['pass'];

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
  <h2><center><u>Swapping Request</u></center></h2>
      <form method="POST" action="faculty2.php">

<?php 
$d=$_SESSION['srcfno'];
$w="select srcdate as a,srcbegining as b,srcroomno as c,srcsno as d,desdate as e,desbegining as f,desroomno as g from swap where app=2 and desfno='$d'";//2 means still in waiting
 $resultz = mysqli_query($db, $w);
   $count = mysqli_num_rows($resultz);
   if($count==0)
   {
	   echo "<h2><center>Swap request empty</center> </h2>";
   }
   else{?>
<table>
	<thead>
		<tr>
<th width="10%"><b><input type="submit" name="accept" value="acc"><b></th>
   <th>date for req</th>
	<th>Room Number for req</th>
	<th>Begining for req</th>
	<th>date to be swap</th>
   <th>Room Number to be swap</th>
	<th>Begining tobe swap</th>
</tr>
</thead>
<?php while ($row1 = mysqli_fetch_array($resultz)) { ?>
			<tr>
			<td><input type="checkbox" name="chk[]"  class="checkbox" value='<?php echo $row1['d']; ?>'/></td>
		<td><?php echo $row1['a']; ?></td>
		<td><?php echo $row1['c']; ?></td>
		<td><?php echo $row1['b']; ?></td>
		<td><?php echo $row1['e']; ?></td>
		<td><?php echo $row1['g']; ?></td>
		<td><?php echo $row1['f']; ?></td>
		</tr>
   <?php } }?>
   </table>
   
   <?php //swapping request of this person which were accepted?>
     <h2><center><u>Swapping Request which were Accepted</u></center></h2>
      <form method="POST" action="faculty2.php">

<?php 
$ww=$_SESSION['srcfno'];
$w="select srcdate as a,srcbegining as b,srcroomno as c,srcsno as d,desdate as e,desbegining as f,desroomno as g from swap where app=1 and srcfno='$ww'";//2 means still in waiting
 $result3 = mysqli_query($db, $w);
   $count = mysqli_num_rows($result3);
   if($count==0)
   {
	   echo "<h2><center>notting was accepted</center> </h2>";
   }
   else{?>
<table>
	<thead>
		<tr>
   <th>date you reqested</th>
	<th>Room Number </th>
	<th>Begining</th>
	<th>date given to other one</th>
   <th>Room Number to other one</th>
	<th>Begining to to other one</th>
</tr>
</thead>
<?php while ($row1 = mysqli_fetch_array($result3)) { ?>
			<tr>
		<td><?php echo $row1['a']; ?></td>
		<td><?php echo $row1['c']; ?></td>
		<td><?php echo $row1['b']; ?></td>
		<td><?php echo $row1['e']; ?></td>
		<td><?php echo $row1['g']; ?></td>
		<td><?php echo $row1['f']; ?></td>
		</tr>
   <?php } }?>
</body>
</html>
