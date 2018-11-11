<html>
<head>
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
<body background="bg.jpg">>
	<?php
	session_start();
	if(isset($_POST["swap"]))
	{
	$db = mysqli_connect("localhost","root","","ems");
		for($i=0;$i<count($_POST['chk']);$i++)
	{
	 $row_no=$_POST['chk'][$i];
	 //srcsno of the particular swap
 $X="SELECT date as x,begining as y,roomno as q FROM session WHERE sno='$row_no'";
 $result = mysqli_query($db, $X);
 $row = mysqli_fetch_assoc($result);
 $sql1 = $row["x"];//date of the src which wants to swap
 $sql2 = $row["y"];//begining time of src wants to swap
 $sql3 = $row["q"];//srcroomno 
 $row1="SELECT session.roomno as a,teacher.fname as t,session.date as z,session.begining as b,session.ending as c,session.sno as s,teacher.fno as f from session INNER JOIN teacher where teacher.fno=session.invig_duty and (session.date !='$sql1' and session.begining !='$sql2')";
 $result1 = mysqli_query($db, $row1);
	?>
	  <form method="POST" action="faculty3.php">
	<table>
	<thead>
		<tr>
		<th>Faculty name</th>
	<th>Room Number</th>
	<th>Date</th>
	<th>Begining</th>
	<th>ending</th>
</tr>
</thead>
<?php while ($row = mysqli_fetch_array($result1)) { ?>

		<tr>
		<td><a href="faculty3.php?a=<?php echo $row['f'];?>&b=<?php echo $row['s'];?>&c=<?php echo $row_no?>&sql1=<?php echo $sql1;?>&sql2=<?php echo $sql2;?>&sql3=<?php echo $sql3;?>&sql4=<?php echo $row['a'];?>&sql5=<?php echo $row['b'];?>&sql6=<?php echo $row['z'];?>"</a><?php echo $row['t']; ?></td>
			<td><?php echo $row['a']; ?></td>
			<td><?php echo $row['z']; ?></td>
			<td><?php echo $row['b']; ?></td>
			<td><?php echo $row['c']; ?></td>
		</tr>
	<?php } ?>
<?php }}?>
</table>
</form>	
</body>
</html>
