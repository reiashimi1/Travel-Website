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
	<div style="padding-top:100px; box-shadow:1px 1px 20px black; min-height:100vh" class="container">
		<div style="border-right:1px solid #999; min-height:450px;">
			<?php include('left.php'); ?>
		</div>
		<div>
			<form method="post" enctype="multipart/form-data">
				<table border="0" width="400px" height="300px" align="center" class="tableshadow" style="border-color: darkgray;">
					<tr>
						<td colspan="2" class="toptd" style="background-color: dimgray; ">Add Subcategory</td>
					</tr>
					<tr>
						<td class="lefttxt" style="color: dimgray; ">Subcategory Name</td>
						<td><input type="text" name="t1" required pattern="[a-zA-z _]{2,50}" title"Please Enter Only Characters between 2 to 50 for Subcategory name" /></td>
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
							//echo $r;

							while ($data = mysqli_fetch_array($result)) {
								echo "<option value=$data[0]>$data[1]</option>";
							}
							?>
							</select>
					<tr>
						<td class="lefttxt" style="color: dimgray; ">Upload Pic</td>
						<td><input type="file" name="t3" /></td>
					</tr>
					<tr>
						<td class="lefttxt" style="color: dimgray; ">Details</td>
						<td><textarea name="t4" /></textarea></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" value="SAVE" name="sbmt" class="btn btn-primary btn-sm" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<?php
	if (isset($_POST["sbmt"])) {
		$cn = makeconnection();

		$target_dir = "subcatimages/";
		$target_file = $target_dir . basename($_FILES["t3"]["name"]);
		$uploadok = 1;
		$imagefiletype = pathinfo($target_file, PATHINFO_EXTENSION);
		//check if image file is a actual image or fake image
		$check = getimagesize($_FILES["t3"]["tmp_name"]);
		if ($check === false) {
			echo "<script type='text/javascript'>toastr.success('File is not an image! ')</script>";
			$uploadok = 0;
		}

		//check if file already exists
		if (file_exists($target_file)) {
			echo "<script type='text/javascript'>toastr.success('File already exists! ')</script>";
			$uploadok = 0;
		}

		//check file size
		if ($_FILES["t3"]["size"] > 500000) {
			echo "<script type='text/javascript'>toastr.success('File is too large! ')</script>";
			$uploadok = 0;
		}

		//aloow certain file formats
		if ($imagefiletype != "jpg" && $imagefiletype != "png" && $imagefiletype != "jpeg" && $imagefileype != "gif") {
			echo "<script type='text/javascript'>toastr.success('Sorry, only jpg, jpeg, png & gif files are allowed! ')</script>";
			$uploadok = 0;
		} else {
			if (move_uploaded_file($_FILES["t3"]["tmp_name"], $target_file)) {

				$s = "insert into subcategory(Subcatname,Catid,pic,detail) values('" . $_POST["t1"] . "','" . $_POST["t2"] . "','" . basename($_FILES["t3"]["name"]) . "','" . $_POST["t4"] . "')";
				mysqli_query($cn, $s);
				echo "<script type='text/javascript'>toastr.success('Subcategory added!')</script>";
			} else {
				echo "<script type='text/javascript'>toastr.success('An unknown error occurred!')</script>";
			}
		}
	}
	?>

</body>

</html>