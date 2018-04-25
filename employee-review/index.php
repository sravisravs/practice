<!doctype html>
	<head>
		<link rel="stylesheet" href="css/empreview.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="js/loginValidation.js">
		</script>
	</head>
	<body style="background-color:#839192">
		<div class="headerStyle">
			<header>
				<img src="images/logo.jpg" height="80px" width="90px">
			</header>
		</div>
		<center>
			<form class="container" method="post" action="" style="width:60%;height:400px;margin-top:80px">
			<img src="images/username.jpg" class="loginIcon">
			<div class="loginField">
				<span class="textfield">Username</span>
				<span class="inputfield"><input type="text" id="uname" name="name"></span>
				<span class="indexspan" id="unamespan"></span>
			</div>
			<div class="loginField">
				<span class="textfield">Password</span>
				<span class="inputfield"><input type="password" id="upwd" name="pwd"></span>
				<span class="indexspan" id="upwdspan"></span>
			</div>
			<div class="submitButton loginField">
				<input type="submit" id="submitbutton" value="Submit" name="submit">
			</div>
			</form>
		</center>
		<footer>
			<span class="footerLeft">Terms of Use</span>
			<span class="footerRight">&copy;jdsports fashion plc</span>
		</footer>
	</body>
</html>
<?php
	if(isset($_POST['submit']))
	{
		extract($_POST);
		include 'php/connection.php';
		$query="select employee_id,username from logindetails where username='$name' and password='$pwd'";
		$result=mysqli_query($conn,$query);
		$rowcount=mysqli_num_rows($result);
		if($rowcount==1)
		{
			SESSION_START();
			$_SESSION['id']="true";
			$row=mysqli_fetch_assoc($result);
			$userid=$row['employee_id'];
			$_SESSION['username']=$row['username'];
			$positionquery="select position,department from employee_details where employee_id='$userid'";
			$positionresult=mysqli_query($conn,$positionquery);
			$pos=mysqli_fetch_assoc($positionresult);
			$_SESSION['position']=$pos['position'];
			$_SESSION['department']=$pos['department'];
			header('Location:php/dashboard.php');
		}
		else
		{?>
            <script>
			alert("please enter valid user name or password");
			</script>
<?php
		}
	}
?>