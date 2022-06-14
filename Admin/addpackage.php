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
				<table border="0" width="400px" height="450px" align="center" class="tableshadow" style="border-color: darkgray;">
					<tr>
						<td colspan="2" class="toptd" style="background-color: dimgray; ">Add Package</td>
					</tr>
					<tr>
						<td class="lefttxt" style="color: dimgray; ">Package Name</td>
						<td><input type="text" name="t1" required pattern="[a-zA-z _]{3,50}" title"Please Enter Only Characters between 3 to 50 for Package Name" /></td>
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
									echo "<option value=$data[0] selected='selected'>$data[1]</option>";
								} else {
									echo "<option value=$data[0]>$data[1]</option>";
								}
							}
							?>
							</select>
							<input type="submit" value="Show" name="show" formnovalidate />
					<tr>
						<td class="lefttxt" style="color: dimgray; ">Select Subcategory</td>
						<td><select name="t3" required />
							<option value="">Select</option>

							<?php
							$cn = makeconnection();
							$s = "select * from subcategory";
							$result = mysqli_query($cn, $s);
							$r = mysqli_num_rows($result);

							while ($data = mysqli_fetch_array($result)) {
								if (isset($_POST["show"])) {
									if ($data[2] == $_POST["t2"]) {
										echo "<option value=$data[0] >$data[1]</option>";
									} else {
										//	echo "<option value=$data[0]>$data[1]</option>";
									}
								}
							}
							?>
							</select>
					<tr>
						<td class="lefttxt" style="color: dimgray; ">Package Price</td>
						<td><input type="text" name="t8" /></td>
					</tr>
					<tr>
						<td class="lefttxt" style="color: dimgray; ">Upload Pic1</td>
						<td><input type="file" name="t4" /></td>
					</tr>
					<tr>
						<td class="lefttxt" style="color: dimgray; ">Upload Pic2</td>
						<td><input type="file" name="t5" /></td>
					</tr>
					<tr>
						<td class="lefttxt" style="color: dimgray; ">Upload Pic3</td>
						<td><input type="file" name="t6" /></td>
					</tr>
					<tr>
						<td class="lefttxt" style="color: dimgray; ">Details</td>
						<td><textarea name="t7"></textarea></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" value="SAVE" name="sbmt" class="btn btn-primary btn-sm" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<?php include('bottom.php'); ?>

	<?php
	if (isset($_POST["sbmt"])) {
		$cn = makeconnection();
		$f1 = 0;
		$f2 = 0;
		$f3 = 0;

		$target_dir = "packimages/";
		//t4
		$target_file = $target_dir . basename($_FILES["t4"]["name"]);
		$uploadok = 1;
		if (basename($_FILES["t4"]["name"]) !== '') {
			$imagefiletype = pathinfo($target_file, PATHINFO_EXTENSION);
			//check if image file is a actual image or fake image
			$check = getimagesize($_FILES["t4"]["tmp_name"]);
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
			if ($_FILES["t4"]["size"] > 500000) {
				echo "<script type='text/javascript'>toastr.success('Your file is too large! ')</script>";
				$uploadok = 0;
			}

			//aloow certain file formats
			if ($imagefiletype != "jpg" && $imagefiletype != "png" && $imagefiletype != "jpeg" && $imagefileype != "gif") {
				echo "<script type='text/javascript'>toastr.success('Sorry, only jpg, jpeg, png & gif files are allowed! ')</script>";
				$uploadok = 0;
			} else {
				if (move_uploaded_file($_FILES["t4"]["tmp_name"], $target_file)) {
					$f1 = 1;
				} else {
					echo "<script type='text/javascript'>toastr.success('Sorry, there was an error uploading your file! ')</script>";
				}
			}
		}

		//t5
		$target_file = $target_dir . basename($_FILES["t5"]["name"]);
		if (basename($_FILES["t5"]["name"]) !== '') {
			$uploadok = 1;
			$imagefiletype = pathinfo($target_file, PATHINFO_EXTENSION);
			//check if image file is a actual image or fake image
			$check = getimagesize($_FILES["t5"]["tmp_name"]);
			if ($check === false) {
				echo "<script type='text/javascript'>toastr.success('File is not an image! ')</script>";
				$uploadok = 0;
			}

			//check if file already exists
			if (file_exists($target_file)) {
				echo "<script type='text/javascript'>toastr.success('Sorry,file already exists! ')</script>";
				$uploadok = 0;
			}

			//check file size
			if ($_FILES["t5"]["size"] > 500000) {
				echo "<script type='text/javascript'>toastr.success('Sorry, your file is too large! ')</script>";
				$uploadok = 0;
			}


			//allow certain file formats
			if ($imagefiletype != "jpg" && $imagefiletype != "png" && $imagefiletype != "jpeg" && $imagefileype != "gif") {
				echo "<script type='text/javascript'>toastr.success('Sorry, only jpg, jpeg, png & gif files are allowed! ')</script>";
				$uploadok = 0;
			} else {
				if (move_uploaded_file($_FILES["t5"]["tmp_name"], $target_file)) {
					$f2 = 1;
				} else {
					echo "<script type='text/javascript'>toastr.success('Sorry there was an error uploading your file! ')</script>";
				}
			}
		}
		
		$target_file = $target_dir . basename($_FILES["t6"]["name"]);
		$uploadok = 1;
		if (basename($_FILES["t6"]["name"]) !== '') {
			$imagefiletype = pathinfo($target_file, PATHINFO_EXTENSION);
			//check if image file is a actual image or fake image
			$check = getimagesize($_FILES["t6"]["tmp_name"]);
			if ($check === false) {
				echo "<script type='text/javascript'>toastr.success('File is not an image! ')</script>";
				$uploadok = 0;
			}

			//check if file already exists
			if (file_exists($target_file)) {
				echo "<script type='text/javascript'>toastr.success('Sorry, file already exists! ')</script>";
				$uploadok = 0;
			}

			//check file size
			if ($_FILES["t6"]["size"] > 500000) {
				echo "<script type='text/javascript'>toastr.success('Sorry, your file is too large! ')</script>";
				$uploadok = 0;
			}


			//aloow certain file formats
			if ($imagefiletype != "jpg" && $imagefiletype != "png" && $imagefiletype != "jpeg" && $imagefileype != "gif") {
				echo "<script type='text/javascript'>toastr.success('Sorry, only jpg, jpeg, Png & gif files are allowed! ')</script>";
				$uploadok = 0;
			} else {
				if (move_uploaded_file($_FILES["t6"]["tmp_name"], $target_file)) {
					$f3 = 1;
				} else {
					echo "<script type='text/javascript'>toastr.success('Sorry there was an error uploading your file! ')</script>";
				}
			}
		}

		$file4 = 'somePath';
		$file5 = 'somePath';
		$file6 = 'somePath';

		// if no photos, for making it easier to test
		if (basename($_FILES["t4"]["name"]) !== '') {
			$file4 = basename($_FILES["t4"]["name"]);
		}
		if (basename($_FILES["t5"]["name"]) !== '') {
			$file5 = basename($_FILES["t5"]["name"]);
		}
		if (basename($_FILES["t6"]["name"]) !== '') {
			$file6 = basename($_FILES["t6"]["name"]);
		}
		$s = "insert into package(packname,category,subcategory,packprice,pic1,pic2,pic3,detail) values('" . $_POST["t1"] . "','" . $_POST["t2"] . "','" . $_POST["t3"] . "','" . $_POST["t8"] . "','" . $file4 . "','" . $file5 . "','" . $file6 . "','" . $_POST["t7"] . "')";
		mysqli_query($cn, $s);
		mysqli_close($cn);
		echo "<script type='text/javascript'>toastr.success('Package added! ')</script>";
	}
	?>

</body>

</html>