<?php 
	SESSION_START();
	if($_SESSION['id']=="true")
	{
?>
<!DOCTYPE html>
	<html>
		<head>
			<meta charset="UTF-8">
			<title>
				Employee Performance Review
			</title>
			<link rel="stylesheet" href="../css/empreview.css">
			<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
			<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
			<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
			<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
			<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
			<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<link rel="icon" type="image/ico" href="../images/icon.jpg">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			
			<script>
				$(function() 
				{
					$('input[name="fromdate"]').daterangepicker();
				});			
			</script>
			
			<script>
				$(document).ready(function()
				{
				$("#box").keyup(function()
				{
				var value=$(this).val();
				if(value!='')
				{
						$.ajax({
							url:"ajaxcall.php",
							method:"post",
							data:{searcht:value},
							dataType:"text",
							success:function(data)
							{
								$('#secdiv').html(data);
							}
						});
				}
				else
				{
						$('#secdiv').html('');
						$.ajax({
							url:"ajaxcall.php",
							method:"post",
							data:{searcht:value},
							dataType:"text",
							success:function(data)
							{
								$('#secdiv').html(data);
							}
						});
				}
				});
				});

				$(document).ready(function()
				{
				$("#mbox").keyup(function()
				{
				var value=$(this).val();
				if(value!='')
				{
						$.ajax({
							url:"ajaxcall.php",
							method:"post",
							data:{search:value},
							dataType:"text",
							success:function(data)
							{
								$('#secdiv').html(data);
							}
						});
				}
				else
				{
						$('#secdiv').html('');
						$.ajax({
							url:"ajaxcall.php",
							method:"post",
							data:{search:value},
							dataType:"text",
							success:function(data)
							{
								$('#secdiv').html(data);
							}
						});
				}
				});
				});
</script>

			<script src="../js/addreviewvalidation.js" type="text/javascript"></script>
			</head>
		<body style="background-color:#839192">
			<div class="headerStyle">
				<header>
					<form action="" method="post">
						<img src="../images/logo.jpg" height="80px" width="90px">
						<input class="logoutButton" type="submit" value="logout" name="logout">
					</form>
				</header>
			</div>
			<form class="container" method="post" id="mainform" action="" style="width:70%;margin-top:50px">
<?php
	if($_SESSION['position']=="teamlead")
	{
?>
				<center style="height:400px">
					<input type="submit" class="clickbutton" value="Add review" name="teamLeadAddReview">
					<input type="submit" class="clickbutton" value="View review" name="teamLeadViewReview">
<?php
	if((isset($_POST['teamLeadViewReview']))||(isset($_POST['search1']))||(isset($_POST['searchDuration'])))
	{
?>
					<input type="text" name="searchData" id="box">
					<button type="submit" value="search" name="search1"><i class="fa fa-search"></i></button><br><br>
					<select name="duration">
						<option value="default">select duration</option>
						<option value="3">last 3 months</option>
						<option value="6">last 6 months</option>
						<option value="9">last 9 months</option>
						<option value="12">last 1 year</option>
					</select>
					<input type="submit" name="searchDuration" value="search by duration">
<?php
	}
?>
				</center>
<?php
	}
	else if($_SESSION['position']=="manager")
	{
?>
				<center style="height:400px">
					<input type="submit" class="clickbutton clicksubmit" value="Add review" name="managerAddReview">
					<input type="submit" class="clickbutton clicksubmit" value="View review" name="managerViewReview">
					<input type="submit" class="clickbutton" id="clickadd" style="width:120px" value="Add employee" name="managerAddEmployee">
					<input type="submit" class="clickbutton clicksubmit" style="width:135px" value="Delete employee" name="managerDeleteEmployee">
					
<?php
	if((isset($_POST['managerViewReview']))||(isset($_POST['search2']))||(isset($_POST['msearchDuration'])))
	{
?>
					<input type="text" name="msearchData" id="mbox">
					<button type="submit" value="search" name="search2"><i class="fa fa-search"></i></button><br><br> 
					<select name="mduration">
						<option value="default">select duration</option>
						<option value="3">last 3 months</option>
						<option value="6">last 6 months</option>
						<option value="9">last 9 months</option>
						<option value="12">last 1 year</option>
					</select>
					<input type="submit" name="msearchDuration" value="search by duration">
<?php
	}
?>
				</center>
<?php
	}
	if((isset($_POST['teamLeadViewReview']))||(isset($_POST['managerViewReview'])||(isset($_POST['search1']))||(isset($_POST['searchDuration']))
		||(isset($_POST['search2']))||(isset($_POST['msearchDuration']))))
	{
		$teamlead=$_SESSION['username'];
		if(isset($_POST['teamLeadViewReview']))
		{
			$viewquery="select e.employee_name,r.employeeid,r.average from employee_details as e
					    INNER JOIN reviewdetails as r on r.employeeid=e.employee_id where teamlead='$teamlead';";
		}
		if(isset($_POST['managerViewReview']))
		{
			$viewquery="select e.employee_name,r.employeeid,r.average from employee_details as e
					INNER JOIN reviewdetails as r on r.employeeid=e.employee_id";
		}
		if(isset($_POST['search1']))
		{
			$name=$_POST['searchData'];
			$viewquery="select e.employee_name,r.employeeid,r.average from employee_details as e
						INNER JOIN reviewdetails as r on r.employeeid=e.employee_id where teamlead='$teamlead' and e.employee_name='$name';";
		}
		if(isset($_POST['searchDuration']))
		{
			$month=$_POST['duration'];
			$viewquery="select e.employee_name,r.employeeid,r.average from employee_details as e
						INNER JOIN reviewdetails as r on  r.employeeid=e.employee_id where (r.date >= DATE_SUB(now(), INTERVAL '$month' MONTH)) and teamlead='$teamlead'";
		}
		if(isset($_POST['search2']))
		{
			$name=$_POST['msearchData'];
			$viewquery="select e.employee_name,r.employeeid,r.average from employee_details as e
						INNER JOIN reviewdetails as r on r.employeeid=e.employee_id where e.employee_name='$name';";
		}
		if(isset($_POST['msearchDuration']))
		{
			$month=$_POST['mduration'];
			$viewquery="select e.employee_name,r.employeeid,r.average from employee_details as e
						INNER JOIN reviewdetails as r on  r.employeeid=e.employee_id where r.date >= DATE_SUB(now(), INTERVAL '$month' MONTH)";
		}
			include 'connection.php';
			$var=mysqli_query($conn,$viewquery);
?>
	
		<div align="center" style="height:auto;position:relative;margin-top:-250px" id="secdiv">
			<table border=1 class='table table-hover' style="background-color:white;margin-top:50px">
				<tr>
					<th>Employee Name</th>
					<th>Employee Id</th>
					<th>Average rating</th>
					<th>Edit</th>
				</tr>
<?php
	while($i=mysqli_fetch_array($var))
	{              
?>
		<tr>
			<td><?php echo $i['employee_name']; ?></td>
			<td><?php echo $i['employeeid']; ?></td>
			<td><?php echo $i['average']; ?></td>
			<td><button type="submit" name="editdetails" value="<?php echo $i['employeeid']; ?>" >Edit</button></td>
			<td><button type="submit" name="printdetails" value="<?php echo $i['employeeid']; ?>" >Print</button></td>
		</tr>
<?php
	}
}
?>
			</table>
		</div>
<?php
	if(isset($_POST['managerAddEmployee']))
	{
?>
	<center>
	<div class="addempblock" style="position:relative;margin-top:-300px">
		<div class="fieldset">
			<span class="lable">Employee Name:</span>
			<span class="inputdiv"><input type="text" class="input" id="empname" name="employee_name"></span>
			<span id="empnamespan" class="errmsg" ></span>
		</div>
		<div class="fieldset">
			<span class="lable">Employee Id:</span>
			<span class="inputdiv"><input type="text" class="input"  id="empid" name="employee_id"></span>
			<span id="empidspan" class="errmsg" ></span>
		</div>
		<div class="fieldset">
			<span class="lable">Department:</span>
			<span class="inputdiv">
				<select id="dept" name="department">
					<option value="none">Select department</option>
					<option value="Mesh">Mesh</option>
					<option value="IOS">IOS</option>
					<option value="Android">Android</option>
					<option value="Dot_Net">Dot Net</option>
				</select>
			</span>
			<span id="empdeptspan" class="errmsg" ></span>
		</div>
		<div class="fieldset">
			<span class="lable">Team Lead:</span>
			<span class="inputdiv">
				<select  id="teamlead" name="teamlead">
					<option value="none">Select teamlead</option>
					<option value="Mesh">Subbu</option>
					<option value="IOS">Anjali</option>
					<option value="Android">Durga</option>
					<option value="Dot_Net">Arun</option>
				</select>
			</span>
			<span id="emptlspan" class="errmsg"></span>
		</div>
		<div class="fieldset">
			<span class="lable">Position:</span>
			<span class="inputdiv"><input type="text" class="input" id="pos" name="position"></span>
			<span id="empposspan" class="errmsg"></span>
		</div>
		<div class="button fieldset">
			<input type="submit" value="Add" class="clickbut" name="addEmployee">
		</div>
	</div>
	</center>
<?php			
	}
    if(isset($_POST['managerDeleteEmployee']))
	{
		include 'connection.php';
		$delquery="select * from employee_details";
		$del=mysqli_query($conn,$delquery);
		?>
		<div align="center" style="height:auto;position:relative;margin-top:-250px"">
			<table border=1 class='table table-hover' style="background-color:white;margin-top:50px">
				<tr>
					<th>Employee Name</th>
					<th>Employee Id</th>
					<th>delete</th>
				</tr>
				<?php
				while($i=mysqli_fetch_array($del))
				{              
?>
					<tr>
					<td><?php echo $i['employee_name']; ?></td>
					<td><?php echo $i['employee_id']; ?></td>
					<td><button type="submit" name="deldetails" value="<?php echo $i['employee_id']; ?>" >delete</button></td>
					</tr>
	<?php
				}?>
				</table>
				</div>
		<?php
	}
	if(isset($_POST['addEmployee']))
	{
		extract($_POST);
		include 'connection.php';
		$addEmpQuery="insert into employee_details values('','$employee_name','$employee_id','$department','$teamlead','$position',now())";
		mysqli_query($conn,$addEmpQuery);
	}
	if(isset($_POST['deldetails']))
	{
		extract($_POST);
		include 'connection.php';
		$addEmpQuery="delete from employee_details where employee_id='$deldetails'";
		mysqli_query($conn,$addEmpQuery);
	}
	
	if((isset($_POST['teamLeadAddReview']))||(isset($_POST['managerAddReview'])))
	{
?>
		<center style="position:relative;margin-top:-300px">
			<h1 style="color:black;font-family:arial">Employee Performance Review</h1>
				<div class="empInformation">
					Employee Information
				</div>
				<div class="leftColumn">
					<div class="labels">
						<span class="details">Employee Name</span>
						<span class="userField">
							<select name="select" id="selectbox">
								<option value="select_employee">Select employee</option>
								<?php
								include 'connection.php';
								if(isset($_POST['teamLeadAddReview']))
								{
								    $teamlead=$_SESSION['username'];
									$get_employees="select employee_name,employee_id from employee_details where teamlead='$teamlead'";
								}
								if(isset($_POST['managerAddReview']))
								{
									$get_employees="select employee_name,employee_id from employee_details where position='teamlead'";
								}
								$res=mysqli_query($conn,$get_employees);
								while($row=mysqli_fetch_assoc($res))
								{
								?>
								<script>
								var y=document.getElementById("selectbox");
								var option=document.createElement("option");
								option.text="<?php echo $row['employee_name']; ?>";
								option.value="<?php echo $row['employee_id']; ?>";
								y.add(option);
								</script>
								<?php
								}
								?>
							</select>
						</span>
					</div>
					<div class="labels">
						<span class="details">Department</span>
						<span class="userField">
							<input type="text" name="dept" class="deptstyle defvalue" value="<?php echo $_SESSION['department'];?>" readonly>
						</span>
					</div>
					<div class="labels">
						<span class="details">Reviewer</span>
						<span class="userField">
							<input type="text" name="dept" class="deptstyle defvalue" value="<?php echo $_SESSION['username'];?>" readonly>
						</span>
					</div>
				</div>
				<div class="rightColumn">
					<div class="labels">
						<span class="details">Date</span>
						<span class="userField">
							<input class="defvalue" type="text" value="<?php echo date('d-m-Y');?>" readonly>
						</span>
					</div>
					<div class="labels">
						<span class="details">Period of Review</span>
						<span class="userField">
							<input id="fromdate" class="date" name="fromdate" type="text">
						</span>
					</div>
					<div class="labels">
						<span class="details">Reviewers Title</span>
						<span class="userField">
							<input type="text" name="dept" class="deptstyle defvalue" value="<?php echo $_SESSION['position'];?>" readonly>
						</span>
					</div>
				</div>
				<div class="perEvaluation">Performance Evaluation</div>
				<div class="perEvaluationblock">
					<div class="perEvaluationRow">
						<span class="fields"><label>Job Knowledge</label></span>
						<span class="inputFields">
							<input name="job" type="radio" value="4"><span>Excellent</span>
							<input name="job" type="radio" value="3"><span>Good</span>
							<input name="job" type="radio" value="2"><span>Fair</span>
							<input name="job" type="radio" value="1"><span>Poor</span>
							<input type="radio" name="job" value="0" class="radiobutton" checked>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="jobcomm" rows="3" cols="15"></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Productivity</label></span>
						<span class="inputFields">
							<input name="product" type="radio" value="4"><span>Excellent</span>
							<input name="product" type="radio" value="3"><span>Good</span>
							<input name="product" type="radio" value="2"><span>Fair</span>
							<input name="product" type="radio" value="1"><span>Poor</span>
							<input type="radio" name="product" value="0" class="radiobutton" checked>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="procomm" rows="3" cols="15"></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Work Quality</label></span>
						<span class="inputFields">
							<input name="work" type="radio" value="4"><span>Excellent</span>
							<input name="work" type="radio" value="3"><span>Good</span>
							<input name="work" type="radio" value="2"><span>Fair</span>
							<input name="work" type="radio" value="1"><span>Poor</span>
							<input type="radio" name="work" value="0" class="radiobutton" checked>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="workcomm"  rows="3" cols="15"></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Technical Skills</label></span>
						<span class="inputFields">
							<input name="technical" type="radio" value="4"><span>Excellent</span>
							<input name="technical" type="radio" value="3"><span>Good</span>
							<input name="technical" type="radio" value="2"><span>Fair</span>
							<input name="technical" type="radio" value="1"><span>Poor</span>
							<input type="radio" name="technical" value="0" class="radiobutton" checked>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="techcomm" rows="3" cols="15"></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Work Consistency</label></span>
						<span class="inputFields">
							<input name="consistency" type="radio" value="4"><span>Excellent</span>
							<input name="consistency" type="radio" value="3"><span>Good</span>
							<input name="consistency" type="radio" value="2"><span>Fair</span>
							<input name="consistency" type="radio" value="1"><span>Poor</span>
							<input type="radio" name="consistency" value="0" class="radiobutton" checked>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="consiscomm" rows="3" cols="15"></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Enthusiasm</label></span>
						<span class="inputFields">
							<input  name="enthusiasm" type="radio" value="4"><span>Excellent</span>
							<input  name="enthusiasm" type="radio" value="3"><span>Good</span>
							<input  name="enthusiasm" type="radio" value="2"><span>Fair</span>
							<input  name="enthusiasm" type="radio" value="1"><span>Poor</span>
							<input type="radio" name="enthusiasm" value="0" class="radiobutton" checked>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="encomm" rows="3" cols="15"></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Cooperation</label></span>
						<span class="inputFields">
							<input name="cooperation"  type="radio" value="4"><span>Excellent</span>
							<input name="cooperation"  type="radio" value="3"><span>Good</span>
							<input name="cooperation"  type="radio"  value="2"><span>Fair</span>
							<input name="cooperation"  type="radio" value="1"><span>Poor</span>
							<input type="radio" name="cooperation" value="0" class="radiobutton" checked>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="cocomm" rows="3" cols="15"></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Attitude</label></span>
						<span class="inputFields">
							<input name="attitude" type="radio" value="4"><span>Excellent</span>
							<input name="attitude" type="radio" value="3"><span>Good</span>
							<input name="attitude" type="radio" value="2"><span>Fair</span>
							<input name="attitude" type="radio" value="1"><span>Poor</span>
							<input type="radio" name="attitude" value="0" class="radiobutton" checked>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="atticomm"rows="3" cols="15"></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Initiative</label></span>
						<span class="inputFields">
							<input name="initiative" type="radio" value="4"><span>Excellent</span>
							<input name="initiative" type="radio" value="3"><span>Good</span>
							<input name="initiative" type="radio" value="2"><span>Fair</span>
							<input name="initiative" type="radio" value="1"><span>Poor</span>
							<input type="radio" name="initiative" value="0" class="radiobutton" checked>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="initcomm" rows="3" cols="15"></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Work Relations</label></span>
						<span class="inputFields">
							<input name="relations" type="radio" value="4"><span>Excellent</span>
							<input name="relations" type="radio" value="3"><span>Good</span>
							<input name="relations" type="radio" value="2"><span>Fair</span>
							<input name="relations" type="radio" value="1"><span>Poor</span>
							<input type="radio" name="relations" value="0" class="radiobutton" checked>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="relcomm" rows="3" cols="15"></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Creativity</label></span>
						<span class="inputFields">
							<input name="creativity" type="radio" value="4"><span>Excellent</span>
							<input name="creativity" type="radio" value="3"><span>Good</span>
							<input name="creativity" type="radio" value="2"><span>Fair</span>
							<input name="creativity" type="radio" value="1"><span>Poor</span>
							<input type="radio" name="creativity" value="0" class="radiobutton" checked>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="crecomm" rows="3" cols="15"></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Punctuality</label></span>
						<span class="inputFields">
							<input name="punctuality" type="radio" value="4"><span>Excellent</span>
							<input name="punctuality" type="radio" value="3"><span>Good</span>
							<input name="punctuality" type="radio" value="2"><span>Fair</span>
							<input name="punctuality" type="radio" value="1"><span>Poor</span>
							<input type="radio" name="punctuality" value="0" class="radiobutton" checked>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="punccomm" rows="3" cols="15"></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Attendance</label></span>
						<span class="inputFields">
							<input name="attendance" type="radio" value="4"><span>Excellent</span>
							<input name="attendance" type="radio" value="3"><span>Good</span>
							<input name="attendance" type="radio" value="2"><span>Fair</span>
							<input name="attendance" type="radio" value="1"><span>Poor</span>
							<input type="radio" name="attendance" value="0" class="radiobutton" checked>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="attencomm" rows="3" cols="15"></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Dependability</label></span>
						<span class="inputFields">
							<input name="Dependability" type="radio" value="4"><span>Excellent</span>
							<input name="Dependability" type="radio" value="3"><span>Good</span>
							<input name="Dependability" type="radio" value="2"><span>Fair</span>
							<input name="Dependability" type="radio" value="1"><span>Poor</span>
							<input type="radio" name="Dependability" value="0" class="radiobutton" checked>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="Depcomm" rows="3" cols="15"></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Communication Skills</label></span>
						<span class="inputFields">
							<input  name="Communication"  type="radio" value="4"><span>Excellent</span>
							<input  name="Communication"  type="radio" value="3"><span>Good</span>
							<input  name="Communication"  type="radio" value="2"><span>Fair</span>
							<input  name="Communication"  type="radio" value="1"><span>Poor</span>
							<input type="radio" name="Communication" value="0" class="radiobutton" checked>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="Commcomm" rows="3" cols="15"></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Overall Rating</label></span>
						<span class="inputFields">
							<input name="Rating" type="radio" value="4"><span>Excellent</span>
							<input name="Rating" type="radio" value="3"><span>Good</span>
							<input name="Rating" type="radio" value="2"><span>Fair</span>
							<input name="Rating" type="radio" value="1"><span>Poor</span>
							<input type="radio" name="Rating" value="0" class="radiobutton" checked>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="Ratingcomm"  rows="3" cols="15"></textarea>
						</span>
					</div>
				</div>
				<div class="oppForDevolop">
					Opportunities for Development
				</div>
				<div class="oppForDevoloptxt">
						<textarea name="oppdevelop" rows="7" cols="70"></textarea>
				</div>
				<div class="oppForDevolop">
					Reviewers Comments
				</div>
				<div class="oppForDevoloptxt">
					<textarea name="revcomm" rows="7" cols="70"></textarea>
				</div>
				<input class="subButton" type="submit" value="Submit" name="submitForm">
			</center>
<?php
	}
?>
<?php
	if(isset($_POST['submitForm']))
	{
		extract($_POST);
		include 'connection.php';
		$fdate=substr($fromdate,0,10);
		$tdate=substr($fromdate,12,20);
		$fstring = strtotime($fdate);
		$frmdate=date("Y-m-d", $fstring);
		$tstring= strtotime($tdate);
		$todate=date("Y-m-d", $tstring);
		$average=(($job+$product+$work+$technical+$consistency+$enthusiasm+$cooperation+$attitude+
		$initiative+$relations+$creativity+$punctuality+$attendance+$Dependability+$Communication+
		$Rating)/16);
	
		$performquery="insert into reviewdetails values('','$select','$dept','$frmdate','$todate','$job','$jobcomm','$product','$procomm','$work',
		'$workcomm','$technical','$techcomm','$consistency','$consiscomm','$enthusiasm','$encomm',
		'$cooperation','$cocomm','$attitude','$atticomm','$initiative','$initcomm','$relations','$relcomm',
		'$creativity','$crecomm','$punctuality','$punccomm','$attendance','$attencomm','$Dependability',
		'$Depcomm','$Communication','$Commcomm','$Rating','$Ratingcomm','$oppdevelop','$revcomm',now(),'$average')";
		$que=mysqli_query($conn,$performquery);
		
	}
	if(isset($_POST['logout']))
	{
		SESSION_START();
		SESSION_DESTROY();
		header('Location:../index.php');
	}
	if(isset($_POST['editdetails']))
	{
		$id=$_POST['editdetails'];
		$_SESSION['editid']="$id";
		include 'connection.php';
		$editquery="select * from reviewdetails where employeeid='$id'";
		$que=mysqli_query($conn,$editquery);
		$result=mysqli_fetch_assoc($que);
		?>
				<div style="height:auto;position:relative;margin-top:-250px">
					<div class="perEvaluationRow">
						<span class="fields"><label>Job Knowledge</label></span>
						<span class="inputFields">
							<input name="job" type="radio" value="4" <?php if($result['jobper']=="4") {echo "checked";}?>><span>Excellent</span>
							<input name="job" type="radio" value="3" <?php if($result['jobper']=="3") {echo "checked";}?>><span>Good</span>
							<input name="job" type="radio" value="2" <?php if($result['jobper']=="2") {echo "checked";}?>><span>Fair</span>
							<input name="job" type="radio" value="1" <?php if($result['jobper']=="1") {echo "checked";}?>><span>Poor</span>
							<input type="radio" name="job" value="none" class="radiobutton" <?php if($result['jobper']=="none") {echo "checked";}?> >
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="jobcomm" rows="3" cols="15"><?php echo $result['jobcomments'];?></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Productivity</label></span>
						<span class="inputFields">
							<input name="product" type="radio" value="4" <?php if($result['productivity']=="4") {echo "checked";}?>><span>Excellent</span>
							<input name="product" type="radio" value="3" <?php if($result['productivity']=="3") {echo "checked";}?>><span>Good</span>
							<input name="product" type="radio" value="2" <?php if($result['productivity']=="2") {echo "checked";}?>><span>Fair</span>
							<input name="product" type="radio" value="1" <?php if($result['productivity']=="1") {echo "checked";}?>><span>Poor</span>
							<input type="radio" name="product" value="none" class="radiobutton" <?php if($result['productivity']=="none") {echo "checked";}?>>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="procomm" rows="3" cols="15"><?php echo $result['procomments'];?></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Work Quality</label></span>
						<span class="inputFields">
							<input name="work" type="radio" value="4" <?php if($result['workquality']=="4") {echo "checked";}?>><span>Excellent</span>
							<input name="work" type="radio" value="3" <?php if($result['workquality']=="3") {echo "checked";}?>><span>Good</span>
							<input name="work" type="radio" value="2" <?php if($result['workquality']=="2") {echo "checked";}?>><span>Fair</span>
							<input name="work" type="radio" value="1" <?php if($result['workquality']=="1") {echo "checked";}?>><span>Poor</span>
							<input type="radio" name="work" value="none" class="radiobutton" <?php if($result['workquality']=="none") {echo "checked";}?>>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="workcomm" rows="3" cols="15"><?php echo $result['workcomments'];?></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Technical Skills</label></span>
						<span class="inputFields">
							<input name="technical" type="radio" value="4" <?php if($result['techskills']=="4") {echo "checked";}?>><span>Excellent</span>
							<input name="technical" type="radio" value="3" <?php if($result['techskills']=="3") {echo "checked";}?>><span>Good</span>
							<input name="technical" type="radio" value="2" <?php if($result['techskills']=="2") {echo "checked";}?>><span>Fair</span>
							<input name="technical" type="radio" value="1" <?php if($result['techskills']=="1") {echo "checked";}?>><span>Poor</span>
							<input type="radio" name="technical" value="none" class="radiobutton" <?php if($result['techskills']=="none") {echo "checked";}?>>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="techcomm" rows="3" cols="15"><?php echo $result['techcomments'];?></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Work Consistency</label></span>
						<span class="inputFields">
							<input name="consistency" type="radio" value="4" <?php if($result['workconsis']=="4") {echo "checked";}?>><span>Excellent</span>
							<input name="consistency" type="radio" value="3" <?php if($result['workconsis']=="3") {echo "checked";}?>><span>Good</span>
							<input name="consistency" type="radio" value="2" <?php if($result['workconsis']=="2") {echo "checked";}?>><span>Fair</span>
							<input name="consistency" type="radio" value="1" <?php if($result['workconsis']=="1") {echo "checked";}?>><span>Poor</span>
							<input type="radio" name="consistency" value="none" class="radiobutton" <?php if($result['workconsis']=="none") {echo "checked";}?>>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="consiscomm" rows="3" cols="15"><?php echo $result['consiscomments'];?></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Enthusiasm</label></span>
						<span class="inputFields">
							<input  name="enthusiasm" type="radio" value="4" <?php if($result['enthusiasm']=="4") {echo "checked";}?>><span>Excellent</span>
							<input  name="enthusiasm" type="radio" value="3" <?php if($result['enthusiasm']=="3") {echo "checked";}?>><span>Good</span>
							<input  name="enthusiasm" type="radio" value="2" <?php if($result['enthusiasm']=="2") {echo "checked";}?>><span>Fair</span>
							<input  name="enthusiasm" type="radio" value="1" <?php if($result['enthusiasm']=="1") {echo "checked";}?>><span>Poor</span>
							<input type="radio" name="enthusiasm" value="none" class="radiobutton" <?php if($result['enthusiasm']=="none") {echo "checked";}?>>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="encomm" rows="3" cols="15"><?php echo $result['enthcomments'];?></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Cooperation</label></span>
						<span class="inputFields">
							<input name="cooperation"  type="radio" value="4" <?php if($result['cooperation']=="4") {echo "checked";}?>><span>Excellent</span>
							<input name="cooperation"  type="radio" value="3" <?php if($result['cooperation']=="3") {echo "checked";}?>><span>Good</span>
							<input name="cooperation"  type="radio"  value="2" <?php if($result['cooperation']=="2") {echo "checked";}?>><span>Fair</span>
							<input name="cooperation"  type="radio" value="1" <?php if($result['cooperation']=="1") {echo "checked";}?>><span>Poor</span>
							<input type="radio" name="cooperation" value="none" class="radiobutton" <?php if($result['cooperation']=="none") {echo "checked";}?>>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="cocomm" rows="3" cols="15"><?php echo $result['coopcomments'];?></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Attitude</label></span>
						<span class="inputFields">
							<input name="attitude" type="radio" value="4" <?php if($result['attitude']=="4") {echo "checked";}?>><span>Excellent</span>
							<input name="attitude" type="radio" value="3" <?php if($result['attitude']=="3") {echo "checked";}?>><span>Good</span>
							<input name="attitude" type="radio" value="2" <?php if($result['attitude']=="2") {echo "checked";}?>><span>Fair</span>
							<input name="attitude" type="radio" value="1" <?php if($result['attitude']=="1") {echo "checked";}?>><span>Poor</span>
							<input type="radio" name="attitude" value="none" class="radiobutton" <?php if($result['attitude']=="none") {echo "checked";}?>>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="atticomm"rows="3" cols="15"><?php echo $result['attitudecomments'];?></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Initiative</label></span>
						<span class="inputFields">
							<input name="initiative" type="radio" value="4" <?php if($result['initiative']=="4") {echo "checked";}?> ><span>Excellent</span>
							<input name="initiative" type="radio" value="3" <?php if($result['initiative']=="3") {echo "checked";}?>><span>Good</span>
							<input name="initiative" type="radio" value="2" <?php if($result['initiative']=="2") {echo "checked";}?>><span>Fair</span>
							<input name="initiative" type="radio" value="1" <?php if($result['initiative']=="1") {echo "checked";}?>><span>Poor</span>
							<input type="radio" name="initiative" value="none" class="radiobutton" <?php if($result['initiative']=="none") {echo "checked";}?>>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="initcomm" rows="3" cols="15"><?php echo $result['initiativecomments'];?></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Work Relations</label></span>
						<span class="inputFields">
							<input name="relations" type="radio" value="4" <?php if($result['workrelations']=="4") {echo "checked";}?>><span>Excellent</span>
							<input name="relations" type="radio" value="3" <?php if($result['workrelations']=="3") {echo "checked";}?>><span>Good</span>
							<input name="relations" type="radio" value="2" <?php if($result['workrelations']=="2") {echo "checked";}?>><span>Fair</span>
							<input name="relations" type="radio" value="1" <?php if($result['workrelations']=="1") {echo "checked";}?>><span>Poor</span>
							<input type="radio" name="relations" value="none" class="radiobutton" <?php if($result['workrelations']=="none") {echo "checked";}?>>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="relcomm" rows="3" cols="15"><?php echo $result['relacomments'];?></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Creativity</label></span>
						<span class="inputFields">
							<input name="creativity" type="radio" value="4" <?php if($result['creativity']=="4") {echo "checked";}?>><span>Excellent</span>
							<input name="creativity" type="radio" value="3" <?php if($result['creativity']=="3") {echo "checked";}?>><span>Good</span>
							<input name="creativity" type="radio" value="2" <?php if($result['creativity']=="2") {echo "checked";}?>><span>Fair</span>
							<input name="creativity" type="radio" value="1" <?php if($result['creativity']=="1") {echo "checked";}?>><span>Poor</span>
							<input type="radio" name="creativity" value="none" class="radiobutton" <?php if($result['creativity']=="none") {echo "checked";}?>>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="crecomm" rows="3" cols="15"><?php echo $result['creativecomments'];?></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Punctuality</label></span>
						<span class="inputFields">
							<input name="punctuality" type="radio" value="4" <?php if($result['punctuality']=="4") {echo "checked";}?>><span>Excellent</span>
							<input name="punctuality" type="radio" value="3" <?php if($result['punctuality']=="3") {echo "checked";}?>><span>Good</span>
							<input name="punctuality" type="radio" value="2" <?php if($result['punctuality']=="2") {echo "checked";}?>><span>Fair</span>
							<input name="punctuality" type="radio" value="1" <?php if($result['punctuality']=="1") {echo "checked";}?>><span>Poor</span>
							<input type="radio" name="punctuality" value="none" class="radiobutton" <?php if($result['punctuality']=="none") {echo "checked";}?>>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="punccomm" rows="3" cols="15"><?php echo $result['puncomments'];?></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Attendance</label></span>
						<span class="inputFields">
							<input name="attendance" type="radio" value="4" <?php if($result['attendance']=="4") {echo "checked";}?>><span>Excellent</span>
							<input name="attendance" type="radio" value="3" <?php if($result['attendance']=="3") {echo "checked";}?>><span>Good</span>
							<input name="attendance" type="radio" value="2" <?php if($result['attendance']=="2") {echo "checked";}?>><span>Fair</span>
							<input name="attendance" type="radio" value="1" <?php if($result['attendance']=="1") {echo "checked";}?>><span>Poor</span>
							<input type="radio" name="attendance" value="none" class="radiobutton" <?php if($result['attendance']=="none") {echo "checked";}?>>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="attencomm" rows="3" cols="15"><?php echo $result['attencomments'];?></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Dependability</label></span>
						<span class="inputFields">
							<input name="Dependability" type="radio" value="4" <?php if($result['dependability']=="4") {echo "checked";}?>><span>Excellent</span>
							<input name="Dependability" type="radio" value="3" <?php if($result['dependability']=="3") {echo "checked";}?>><span>Good</span>
							<input name="Dependability" type="radio" value="2" <?php if($result['dependability']=="2") {echo "checked";}?>><span>Fair</span>
							<input name="Dependability" type="radio" value="1" <?php if($result['dependability']=="1") {echo "checked";}?>><span>Poor</span>
							<input type="radio" name="Dependability" value="none" class="radiobutton" <?php if($result['dependability']=="none") {echo "checked";}?>>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="Depcomm" rows="3" cols="15"><?php echo $result['depencomments'];?></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Communication Skills</label></span>
						<span class="inputFields">
							<input  name="Communication"  type="radio" value="4" <?php if($result['communication']=="4") {echo "checked";}?>><span>Excellent</span>
							<input  name="Communication"  type="radio" value="3" <?php if($result['communication']=="3") {echo "checked";}?>><span>Good</span>
							<input  name="Communication"  type="radio" value="2" <?php if($result['communication']=="2") {echo "checked";}?>><span>Fair</span>
							<input  name="Communication"  type="radio" value="1" <?php if($result['communication']=="1") {echo "checked";}?>><span>Poor</span>
							<input type="radio" name="Communication" value="none" class="radiobutton" <?php if($result['communication']=="none") {echo "checked";}?>>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="Commcomm" rows="3" cols="15"><?php echo $result['commcomments'];?></textarea>
						</span>
					</div>
					<div class="perEvaluationRow">
						<span class="fields"><label>Overall Rating</label></span>
						<span class="inputFields">
							<input name="Rating" type="radio" value="4" <?php if($result['overallrating']=="4") {echo "checked";}?>><span>Excellent</span>
							<input name="Rating" type="radio" value="3" <?php if($result['overallrating']=="3") {echo "checked";}?>><span>Good</span>
							<input name="Rating" type="radio" value="2" <?php if($result['overallrating']=="2") {echo "checked";}?>><span>Fair</span>
							<input name="Rating" type="radio" value="1" <?php if($result['overallrating']=="1") {echo "checked";}?>><span>Poor</span>
							<input type="radio" name="Rating" value="none" class="radiobutton" <?php if($result['overallrating']=="none") {echo "checked";}?>>
						</span>
						<span class="comments">
							<label>Comments</label>
							<textarea name="Ratingcomm"  rows="3" cols="15"><?php echo $result['ratingcomments'];?></textarea>
						</span>
					</div>
					<div class="okbutton">
						<input type="submit" value="Update" class="clickbutton" name="okbutton">
					</div>
				</div>
			
<?php				
	}
	if(isset($_POST['printdetails']))
	{
		extract($_POST);
		include 'connection.php';
		$printquery="select e.employee_name,r.employeeid,r.jobper,r.jobcomments,r.productivity,r.procomments,r.workquality,r.workcomments,r.techskills,r.techcomments,r.workconsis,
		r.consiscomments,r.enthusiasm,r.enthcomments,r.cooperation,r.coopcomments,r.attitude,r.attitudecomments,r.initiative,r.initiativecomments,r.workrelations,
		r.relacomments,r.creativity,r.creativecomments,r.punctuality,r.puncomments,r.attendance,r.attencomments,
		r.dependability,r.depencomments,r.communication,r.commcomments,r.overallrating,r.ratingcomments from employee_details as e  INNER JOIN reviewdetails as r
		on e.employee_id=r.employeeid where r.employeeid='$printdetails'";
		$printresult=mysqli_query($conn,$printquery);
		$printrow=mysqli_fetch_assoc($printresult);
		$field=array("none","poor","fair","good","excellent");
		?>
		<div align="center" style="height:auto;position:relative;margin-top:-250px">
			<table border=1 class='table table-hover' style="background-color:white;margin-top:20px">
				<tr>
					<td colspan="3" align="center"><?php  echo "<b>".$printrow['employee_name']."</b>";?></td>
				</tr>
				<tr>
					<td>Area of field</td>
					<td>Performance</td>
					<td>Comments</td>
				</tr>
				<tr>
					<td>Job knowledge</td>
					<td><?php echo $field[$printrow['jobper']];?></td>
					<td><?php echo $printrow['jobcomments'];?></td>
				</tr>
				<tr>
					<td>Productivity</td>
					<td><?php echo $field[$printrow['productivity']];?></td>
					<td><?php echo $printrow['procomments'];?></td>
				</tr>
				<tr>
					<td>Work Quality</td>
					<td><?php echo $field[$printrow['workquality']];?></td>
					<td><?php echo $printrow['workcomments'];?></td>
				</tr>
				<tr>
					<td>Technical Skills</td>
					<td><?php echo $field[$printrow['techskills']];?></td>
					<td><?php echo $printrow['techcomments'];?></td>
				</tr>
				<tr>
					<td>Work Consistency</td>
					<td><?php echo $field[$printrow['workconsis']];?></td>
					<td><?php echo $printrow['consiscomments'];?></td>
				</tr>
				<tr>
					<td>Enthusiasm</td>
					<td><?php echo $field[$printrow['enthusiasm']];?></td>
					<td><?php echo $printrow['enthcomments'];?></td>
				</tr>
				<tr>
					<td>Cooperation</td>
					<td><?php echo $field[$printrow['cooperation']];?></td>
					<td><?php echo $printrow['coopcomments'];?></td>
				</tr>
				<tr>
					<td>Attitude</td>
					<td><?php echo $field[$printrow['attitude']];?></td>
					<td><?php echo $printrow['attitudecomments'];?></td>
				</tr>
				<tr>
					<td>Initiative</td>
					<td><?php echo $field[$printrow['initiative']];?></td>
					<td><?php echo $printrow['initiativecomments'];?></td>
				</tr>
				<tr>
					<td>Work Relations</td>
					<td><?php echo $field[$printrow['workrelations']];?></td>
					<td><?php echo $printrow['relacomments'];?></td>
				</tr>
				<tr>
					<td>Creativity</td>
					<td><?php echo $field[$printrow['creativity']];?></td>
					<td><?php echo $printrow['creativecomments'];?></td>
				</tr>
				<tr>
					<td>Punctuality</td>
					<td><?php echo $field[$printrow['punctuality']];?></td>
					<td><?php echo $printrow['puncomments'];?></td>
				</tr>
				<tr>
					<td>Attendance</td>
					<td><?php echo $field[$printrow['attendance']];?></td>
					<td><?php echo $printrow['attencomments'];?></td>
				</tr>
				<tr>
					<td>dependability</td>
					<td><?php echo $field[$printrow['dependability']];?></td>
					<td><?php echo $printrow['depencomments'];?></td>
				</tr>
				<tr>
					<td>communication</td>
					<td><?php echo $field[$printrow['communication']];?></td>
					<td><?php echo $printrow['commcomments'];?></td>
				</tr>
				<tr>
					<td>overallrating</td>
					<td><?php echo $field[$printrow['overallrating']];?></td>
					<td><?php echo $printrow['ratingcomments'];?></td>
				</tr>
			</table>
			<button onclick="window.print();" class="clickbutton">Print</button>
		</div>
		<?php
	}
	if(isset($_POST['okbutton']))
	{
		extract($_POST);
		$id=$_SESSION['editid'];
		include 'connection.php';
		$average=(($job+$product+$work+$technical+$consistency+$enthusiasm+$cooperation+$attitude+
		$initiative+$relations+$creativity+$punctuality+$attendance+$Dependability+$Communication+
		$Rating)/16);
		$updatequery="UPDATE reviewdetails SET jobper='$job',jobcomments='$jobcomm',productivity='$product',procomments='$procomm',workquality='$work',
		workcomments='$workcomm',techskills='$technical',techcomments='$techcomm',workconsis='$consistency',consiscomments='$consiscomm',
		enthusiasm='$enthusiasm',enthcomments='$encomm',cooperation='$cooperation',coopcomments='$cocomm',attitude='$attitude',attitudecomments='$atticomm',
		initiative='$initiative',initiativecomments='$initcomm',workrelations='$relations',relacomments='$relcomm',creativity='$creativity',creativecomments='$crecomm',
		punctuality='$punctuality',puncomments='$punccomm',attendance='$attendance',attencomments='$attencomm',
		dependability='$Dependability',depencomments='$Depcomm',communication='$Communication',commcomments='$Commcomm',overallrating='$Rating',
		ratingcomments='$Ratingcomm',average='$average' WHERE  employeeid='$id'";
		mysqli_query($conn,$updatequery);
	}
}
else
{
	echo ".........TIME OUT...........";
}
?>
</form>
        <footer>
			<span class="footerLeft">Terms of Use</span>
			<span class="footerRight">&copy;jdsports fashion plc</span>
        </footer>
	</body>
</html>



