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
		$s = "delete from subcategory  where subcatid='" . $_POST["s1"] . "'";
		mysqli_query($cn, $s);
		mysqli_close($cn);
		echo "<script type='text/javascript'>toastr.success('Subcategory deleted! ')</script>";
	}
	?>

	<div style="padding-top:100px; box-shadow:1px 1px 20px black; min-height:100vh" class="container">
		<div style="border-right:1px solid #999; min-height:450px;" <?php include('left.php'); ?> </div>
			<form method="post" enctype="multipart/form-data">
				<table border="0" width="400px" height="250px" align="center" class="tableshadow" style="border-color: darkgray;">
					<tr>
						<td colspan="2" class="toptd" style="background-color: dimgray; ">Delete Subcategory</td>
					</tr>
					<tr>
						<td class="lefttxt" style="color: dimgray; ">Select Category</td>
						<td><select name="t2" required />
							<option value="">Select</option>

							<?php
							$cn = makeconnection();
							$s = "select * from category";
							$result = mysqli_query($cn, $s);
							$r = mysqli_num_rows($result);

							while ($data = mysqli_fetch_array($result)) {
								if (isset($_POST["show"]) && $data[0] == $_POST["t2"]) {
									echo "<option value=$data[0] selected>$data[1]</option>";
								} else {
									echo "<option value=$data[0]>$data[1]</option>";
								}
							}
							mysqli_close($cn);
							?>
							</select>
							<input type="submit" value="Show" name="show" formnovalidate />

					<tr>
						<td class="lefttxt" style="color: dimgray; ">Select Subcategory</td>
						<td><select name="s1" required />
							<option value="">Select</option>

							<?php
							if (isset($_POST["show"])) {

								$cn = makeconnection();
								$s = "select * from subcategory where catid='" . $_POST["t2"] . "'";
								$result = mysqli_query($cn, $s);
								$r = mysqli_num_rows($result);

								while ($data = mysqli_fetch_array($result)) {


									echo "<option value=$data[0]>$data[1]</option>";
								}
								mysqli_close($cn);
							}
							?>

							</select>
						</td>
					</tr>

					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" value="Delete" name="sbmt" class="btn btn-primary btn-sm" /></td>
					</tr>

				</table>
			</form>

		</div>

	</div>

</body>

</html>