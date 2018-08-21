<?php
	$date=$coursecode=$begining=$ending='';
	$dateerr=$coursecodeerr=$beginingerr=$endingerr=$technicalerr='';
	$winner='';
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		
		if(!empty($_POST["date"]))
			$date=$_POST["date"];
		else
			$dateerr="Specify date";
		
		if(!empty($_POST["coursecode"]))
			$coursecode=$_POST["coursecode"];
		else
			$coursecodeerr="Specify coursecode";
		
		if(!empty($_POST["begining"]))
			$begining=$_POST["begining"];
		else
			$beginingerr="Specify begining time";
		
		if(!empty($_POST["ending"]))
			$ending=$_POST["ending"];
		else
			$endingerr="Specify ending time";
		
		$conn=mysqli_connect("localhost","root","sagrika2016","ems");
		if(!$conn){		
				die("Connection failed");
				}
		$sql="select * from subject where subjectcode='$coursecode'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)==0)
			$coursecodeerr="Invalid coursecode";	
									
		if($dateerr==''&&$coursecodeerr==''&&$beginingerr==''&&$endingerr==''){
				$count=0;//to calculate total no of students giving the exam
				$sql="SELECT COUNT(*) as number from student INNER JOIN subject where student.semister=subject.subtype and subjectcode='$coursecode'";
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					while($row=mysqli_fetch_assoc($result))
						$count+=$row["number"];
					
				}
				
				$sql="SELECT COUNT(*) as number from back INNER JOIN subject where back.subjectcode=subject.subjectcode and back.subjectcode='$coursecode'";
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					while($row=mysqli_fetch_assoc($result))
						$count+=$row["number"];
					
				}
				$classcapacity=30;
				$count=$count/$classcapacity;
				$count=ceil($count);//no of classes required
				$classcount=0;
				$sql="SELECT COUNT(*) as number from classroom";
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					while($row=mysqli_fetch_assoc($result))
						$classcount+=$row["number"];//no of classes avilable
					
				}
				$tcount=0;
				$sql="SELECT COUNT(*) as number from teacher where designation-noofduties>0";
				$result=mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)>0){
					while($row=mysqli_fetch_assoc($result))
						$tcount+=$row["number"];//no of teachers who are free
					
				}
	
				if($classcount<$count){
						$technicalerr="Not sufficient classroom";
				}
				else if($tcount<$count){
					$technicalerr="Not sufficient teachers";
				}
				else{
					$sql="select fno from teacher where designation-noofduties>0 order by time,designation-noofduties desc limit $count";//geting teachers who are free 
					$result=mysqli_query($conn,$sql);
						while($teacher=mysqli_fetch_assoc($result)){
							$fno=$teacher["fno"];
							$sql1="insert into session(date,coursecode,begining,ending,invig_duty)values('$date','$coursecode','$begining','$ending','$fno')";//creating new sessions	
							$result1=mysqli_query($conn,$sql1);
							$sql2="update teacher set noofduties=noofduties+1,time='$date+$begining' where fno='$fno'";//updating the teachers value
							$result1=mysqli_query($conn,$sql2);
							
							}//teachers are alloted
						
						$sql1="SELECT * from classroom limit $count";//selecting classrooms
						$result1=mysqli_query($conn,$sql1);
						$sql2="SELECT sno from session where roomno is NULL";//sessions where room no has not been alloted
						$result2=mysqli_query($conn,$sql2);
							while($session=mysqli_fetch_assoc($result2)){
									$room=mysqli_fetch_assoc($result1);
									$roomno=$room["roomno"];
									$sno=$session["sno"];
									$sql="update session set roomno='$roomno' where sno='$sno'";
									$result=mysqli_query($conn,$sql);
							}//classroom alloted
						
						$count=0;//noofsemstudentstoallocate
						$sql="SELECT COUNT(*) as number from student INNER JOIN subject where student.semister=subject.subtype and subjectcode='$coursecode'";
						$result=mysqli_query($conn,$sql);
							while($row=mysqli_fetch_assoc($result))
								$count+=$row["number"];
						$bcount=0;
						$sql="SELECT COUNT(*) as number from back INNER JOIN subject where back.subjectcode=subject.subjectcode and back.subjectcode='$coursecode'";
						$result=mysqli_query($conn,$sql);
							while($row=mysqli_fetch_assoc($result))
								$bcount+=$row["number"]; 
						$sql1="SELECT regno from student INNER JOIN subject where student.semister=subject.subtype and subjectcode='$coursecode' ";//sem students
						$sql3="SELECT regno from back INNER JOIN subject where back.subjectcode=subject.subjectcode and back.subjectcode='$coursecode' ";//back students
						$sql2="SELECT * from session where coursecode='$coursecode' ";//session list
						$result1=mysqli_query($conn,$sql1);
						$result3=mysqli_query($conn,$sql3);
						$result2=mysqli_query($conn,$sql2);
						
						$sc=0;//keeping track of no of student
							while($sc<($count+$bcount)){//alloting all students memory
										$cur_session=mysqli_fetch_assoc($result2);//new session
										$ccount=0;//no of student alloted in a particular session
										while($ccount<$classcapacity and $sc<($count+$bcount)){//keeping track of no of student in class
											if($sc<$count){//sem students are being allocated
												$student=mysqli_fetch_assoc($result1);
												$regno=$student["regno"];
												$sno=$cur_session["sno"];
											}
											else{//back students are being allocated
												$student=mysqli_fetch_assoc($result3);
												$regno=$student["regno"];
												$sno=$cur_session["sno"];	
											}
													$sql="insert into exam (regno,sno) values ('$regno','$sno')";
													$result=mysqli_query($conn,$sql);
													$ccount++;
													$sc++;
											}
						}
						$sc+1;
						$winner="Rooms,Teacher,Student have been alloted for course code '$coursecode'. No of students alloted : $sc";
			}//everything done
				mysqli_close($conn);
		}	
		
		}
			
?>

<!doctype html>
<html>
 <head>
	<title>ADMIN</title>
	<style> 
		.error {color:#FF0000;}
		.success {color:#228B22}
	</style>
 </head>
	<body>
	
  
		   <h1>Exam allocation</h1></br>
			<form action="" method="POST">
			  <strong>Date</strong>:<br>
				<input  type="date" name="date" id="date" value="<?php echo $date; ?>"/><br>
				<span class="error">* <?php echo $dateerr;?></span>
				<br><br>
			  <strong>Subject Code:</strong><br>
				<input  type="text" name="coursecode" id="coursecode" value="<?php echo $coursecode; ?>" /><br>
				<span class="error">* <?php echo $coursecodeerr;?></span>
				<br><br>
			  <strong>Starting Time:</strong><br>
				<input  type="time" name="begining" id="begining" value="<?php echo $begining; ?>" /><br>
				<span class="error">* <?php echo $beginingerr;?></span>
				<br><br>
			  <strong>Ending Time:</strong><br>
				<input  type="time" name="ending" id="ending"  value="<?php echo $ending; ?>"/><br>
				<span class="error">* <?php echo $endingerr;?></span>
					<br><br>
				<span class="error">* <?php echo $technicalerr;?></span><br/><br/>	
				<span class="success"><?php echo $winner;?></span><br/><br/>
			  <input type="submit" name="submit"  /></input><br>
			 <input type="reset" name="reseet" ></input><br/><br/>
		   </form>	
				
	   
	</body>

</html>