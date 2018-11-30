<?php
session_start();
if (isset($_GET['email'])) {
	$_SESSION['email']=$_GET['email'];
}
include_once 'database.php';
$db=new database();
?>
<!DOCTYPE html>
<html>
<head>
	<title>reserved</title>
	<style type="text/css">
	a{
			color: white;
			text-decoration: none;
			padding-right: 50px
		}
	.head{
			height: 30px;
			width: 100%;
			background: black;
			font-size: 20px;
			text-align: right;
		}
		h1{
			text-align: center;
		}
		table{
			margin-left: 400px;
		}
		body{
			background-image: url("train.jpg");
			background-size: cover;
			color: red;
			text-align: center;
		}
		
	</style>
</head>
<body>
	<div class="head">
	<a href="index.php">log out</a>
</div>
	<h1><?php echo $_SESSION['email'];?></h1>
	<?php
	$email=$_SESSION['email'];
	$rows=$db->getRows("select * from booking where email='$email'");
	if (count($rows)!=0) {
		?>
		<form method="get">
		<table border="2">
			<caption>booking</caption>
			<tr>
			<th>num train</th>
			<th>station start</th>
			<th>start date</th>
			<th>station stop</th>
			<th>remove</th>
		</tr>
		<?php
		foreach ($rows as $row) {
			$id=$row['id'];
			$rowR=$db->getRows("select * from trains where id='$id'");
			?>
			<tr>
			<td><?php echo $rowR[0]['id'];?></td>
			<td><?php echo $rowR[0]['start'];?></td>
			<td><?php echo $rowR[0]['start_date'];?></td>
			<td><?php echo $rowR[0]['end'];?></td>
			<td><input type="submit" name="remreserved" value=<?php echo $rowR[0]['id'];?> >rem_Booking</input></td>
		</tr>
		<?php

		}
	}
	?>
</table>
</form>
<?php
if (isset($_GET['remreserved'])) {
	$id=$_GET['remreserved'];
	$email=$_SESSION['email'];
	$db->getRows("delete from booking where id='$id' and email='$email'");
	header("location:booking.php?email=$email");
}
?>
<br>
<br>
	<form method="post">
		Enter start <input type="text" name="start">
		<br>
		<br>
		Enter End <input type="text" name="end">
		<br>
		<br>
		<input type="submit" name="submit" value="search">
	</form>
	<br>
	<br>
	<?php
if (isset($_POST['submit'])) {
	$start=$_POST['start'];
	$end=$_POST['end'];
	$rows=$db->getRows("select * from trains where start='$start' and 
		end='$end';",array());
		?>
		<form method="get">
	<table border="2">
			<tr>
			<th>num train</th>
			<th>station_start</th>
			<th>start_date</th>
			<th>station_stop</th>
			<th>booking</th>
		</tr>
		<?php
		foreach ($rows as $row) {
		?>
		<tr>
			<td><?php echo $row['id'];?></td>
			<td><?php echo $row['start'];?></td>
			<td><?php echo $row['start_date'];?></td>
			<td><?php echo $row['end'];?></td>
			<td><input type="submit" name="reserve" value=<?php echo $row['id'];?>>booking</td>
		</tr>
		<?php
	}}
		?>
	</table>
	</form>
</body>
</html>
<?php
if (isset($_GET['reserve'])) {
	$id=$_GET['reserve'];
	$email=$_SESSION['email'];
	if (isReserved($email,$id)) {
		$db->Execute("insert into booking values('$id','$email');");
	header("location:booking.php?email=$email");
	}else
		echo "<script>
		alert('is reserved');
		</script>";
	
}
 function isReserved($email,$id)
{
	global $db;
$c=$db->getRows("select * from booking where id='$id' and email='$email';",array());
if (count($c)==0) {
		return True;
	}
	return False;	
}
?>