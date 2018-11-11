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
	 echo "updated are done";
}
$q=mysqli_query($db,"update swap set app='0' where dessno='$_SESSION['srcfno']'");
	}
session_destroy();?>
<a href="faculty.php">HOME</a> 	
?>
