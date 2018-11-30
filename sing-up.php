<!DOCTYPE html>
<html>
<head>
	<title>singUp</title>
	<style type="text/css">
		form{
			border: 10px solid white;
			padding: 10px;
			margin-left: 500px;
			margin-top: 100px;
			font-size: 20px;
			width: 300px;
		}
		body{
			background-image: url("train.jpg");
			background-size: cover;
			color: red;
		}
		
	</style>
</head>
<body>

<form method="post">
	FName:<input type="text" name="fname">
	<br><br>
	LName:<input type="text" name="lname">
	<br><br>
	Email:<input type="text" name="email">
	<br><br>
	Pass:<input type="password" name="pass">
	<br><br>
	<input type="submit" name="sing" value="sing Up">

</form>
</body>
</html>
<?php
include_once 'database.php';
$db=new database();
if (isset($_POST['sing'])) {
	if (!isEmailExit($_POST['email'])) {
		$email=$_POST['email'];
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$pass=$_POST['pass'];
		$db->Execute("insert into users values('$email','$fname','$lname','$pass');",array());
		header("location:booking.php?email=$email");
	}else
	echo "<script>
	alert('email is exists');
	</script>";
	
}
function isEmailExit($email){
	global $db; 
		$c=$db->getRows("select * from users where email='$email'",array());
		if (count($c)==0)
			return False;
		else
			return True;
	}
?>