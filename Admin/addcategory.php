<?php if (!isset($_SESSION)) {
	session_start();
} ?>

<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
	<link href="style.css" rel="stylesheet" type="text/css" />
	<link href="../css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<script src="js/jquery.min.js"></script>

</head>

<body>
	<?php
	if ($_SESSION['loginstatus'] == "") {
		header("location:loginform.php");
	}

	?>
	<?php include('function.php'); ?>
	<?php
	if (isset($_POST["sbmt"])) {
		$cn = makeconnection();
		$s = "insert into category(Cat_name) values('" . $_POST["t1"] . "')";
		mysqli_query($cn, $s);
		mysqli_close($cn);
		echo "<script type='text/javascript'>toastr.success('Category Added! ')</script>";
	}
	?>
	<div style="padding-top:200px; box-shadow:1px 1px 20px black; min-height:100vh" class="container">
		<div style="border-right:1px solid #999; min-height:450px;">
			<?php include('left.php'); ?>
		</div>
		<div class="">
			<form method="post">
				<table border="0" width="400px" height="200px" align="center" style="border-color: darkgray;" class="tableshadow">
					<tr>
						<td colspan="2" class="toptd" style="background-color: dimgray; ">Add Category</td>
					</tr>
					<br>
					<tr>
						<br>
						<td class="lefttxt" style="color: black;">Category Name</td>
						<td><input type="text" name="t1" required pattern="[a-zA-z _]{3,20}" title="Please Enter Only Characters between 3 to 10 for Category Name" /></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" value="SAVE" name="sbmt" class="btn btn-primary btn-sm" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>

</html>