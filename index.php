<!DOCTYPE html>
<html>
<head>
	<title>the main page</title>
	<style type="text/css">
		.head{
			height: 30px;
			width: 100%;
			background: black;
			font-size: 20px;
			text-align: right;
		}
		form{
			margin-top: 200px;
			margin-left: 480px;
			width: 300px;
			height: 100px;
			border: 10px solid white;
			padding: 10px;
		}
		a{
			color: white;
			text-decoration: none;
			padding-right: 50px
		}
		body{
			background-image: url("train.jpg");
			background-size: cover;
			color: red;
		}
	</style>
</head>
<body>

<div class="head">
	<a href="sing up.php">sing up</a>
</div>
<form method="post">
	 Email&nbsp;:<input type="email" name="email">
	<br>
	<br>
	 Pass&nbsp;&nbsp;&nbsp;:<input type="password" name="pass">
	<br>
	<br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="logIn" name="submit">
</form>
</body>
</html>
<?php
include 'database.php';
$db=new database();
if(isset($_POST['submit']))
{
	$email=$_POST["email"];
	$pass=$_POST["pass"];
	if(isEmailExit($email))
	{
		if(logIN($email,$pass))
		{
			header("location:booking.php?email=$email");
		}else
	echo "<script>
	alert('error pass');
	</script>";
		
	}else
	echo "<script>
	alert('email not exists');
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

	function logIN($email,$pass){
		global $db; 
		$c=$db->getRows("select * from users where email='$email' and pass='$pass'",array());
		if (count($c)==0)
			return False;
		else
			return True;
	}
?>
