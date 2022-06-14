<?php if (!isset($_SESSION)) {
	session_start();
} ?>
<!DOCTYPE html>
<html>

<head>
	<title></title>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>

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
		$s = "update users set pwd='" . $_POST["t2"] . "',Typeofuser='" . $_POST["s1"] . "' where Username='" . $_POST["t1"] . "'";
		mysqli_query($cn, $s);
		mysqli_close($cn);
		echo "<script type='text/javascript'>toastr.success('User updated')</script>";
	}
	?>

	<div style="padding-top:200px; box-shadow:1px 1px 20px black; min-height:100vh" class="container">
		<div style="border-right:1px solid #999; min-height:450px;">
			<?php include('left.php'); ?>
		</div>
		<div>
			<form method="post">
				<table border="0" width="400px" height="300px" align="center" style="border-color: darkgray;" class="tableshadow">
					<tr>
						<td colspan="2" class="toptd" style="background-color: dimgray; ">Update User</td>
					</tr>
					<tr>
						<td class="lefttxt" style="color: dimgray; ">Select User</td>
						<td><select name="t1" required />
							<option value="">Select</option>

							<?php
							$cn = makeconnection();
							$s = "select * from users";
							$result = mysqli_query($cn, $s);
							$r = mysqli_num_rows($result);

							while ($data = mysqli_fetch_array($result)) {
								if (isset($_POST["show"]) && $data[0] == $_POST["t1"]) {
									echo "<option value=$data[0] selected>$data[0]</option>";
								} else {
									echo "<option value=$data[0]>$data[0]</option>";
								}
							}
							mysqli_close($cn);
							?>
							</select>
							<input type="submit" value="Show" name="show" formnovalidate />
							<?php
							if (isset($_POST["show"])) {
								$cn = makeconnection();
								$s = "select * from users where Username='" . $_POST["t1"] . "'";
								$result = mysqli_query($cn, $s);
								$r = mysqli_num_rows($result);

								$data = mysqli_fetch_array($result);
								$Username = $data[0];
								$Pass = $data[1];
								$Usertype = $data[2];

								mysqli_close($cn);
							}
							?>

						</td>
					</tr>
					<tr>
						<td class="lefttxt" style="color: dimgray; ">Password</td>
						<td><input type="password" value="<?php if (isset($_POST["show"])) {
																echo $Pass;
															} ?>" name="t2" required pattern="[a-zA-z0-9]{1,10}" title"Please Enter Only Characters and numbers between 1 to 10 for Password" /></td>
					</tr>
					<tr>
						<td class="lefttxt" style="color: dimgray; ">Confirm Password</td>
						<td><input type="password" value="<?php if (isset($_POST["show"])) {
																echo $Pass;
															} ?>" name="t3" required pattern="[a-zA-z0-9]{1,10}" title"Please Enter Only Characters and numbers between 1 to 10 for Password" /></td>
					</tr>
					<tr>
						<td class="lefttxt" style="color: dimgray; ">Type of User</td>
						<td><select name="s1" required />
							<option value="">Select</option>
							<option value="Admin" <?php if (isset($_POST["show"]) && $Usertype == "Admin") {
														echo "selected";
													} ?>>Admin</option>
							<option value="General" <?php if (isset($_POST["show"]) && $Usertype == "General") {
														echo "selected";
													} ?>>General</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" value="Update" name="sbmt" class="btn btn-primary btn-sm" /></td>
					</tr>
				</table>
			</form>
		</div>

	</div>
</body>

</html>