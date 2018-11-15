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
   <li style="float:right"><a  class="active" href="faculty.php">Home</a></li>
</ul>
	<?php
	
	 session_start();
if(isset($_POST["accept"]))
	{
$db = mysqli_connect("localhost","root","","ems");
	for($i=0;$i<count($_POST['chk']);$i++)
{
 $row_no=$_POST['chk'][$i];
 $r=mysqli_query($db,"update swap set app='1' where srcsno='$row_no'");
 if($r)
 {
	 echo "<h1>updated are done</h1> <br>";
}
//$q=mysqli_query($db,"update swap set app='0' where dessno='$_SESSION['srcfno']'");
	}}?>
</body>
</html>
