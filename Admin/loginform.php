<?php session_start(); ?>
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
	<!--js-->
	<script src="js/jquery.min.js"></script>

</head>

<body>
	<?php include('function.php'); ?>
	<?php
	$_SESSION['loginstatus'] = "";
	if (isset($_POST["sbmt"])) {
		$cn = makeconnection();
		$s = "select * from users where Username='" . $_POST["t1"] . "' and Pwd='" . $_POST["t2"] . "'";

		$q = mysqli_query($cn, $s);
		$r = mysqli_num_rows($q);
		$data = mysqli_fetch_array($q);
		mysqli_close($cn);
		if ($r > 0) {
			$_SESSION["Username"] = $_POST["t1"];
			$_SESSION["usertype"] = $data[2];
			$_SESSION['loginstatus'] = "yes";
			header("location:index.php");
		} else {
			echo "<script type='text/javascript'>toastr.success('Invalid username or password! ')</script>";
		}
	}
	?>
	<section class="text-center text-lg-start" style="overflow: hidden;">
		<style>
			* {
				font-family: 'Roboto', sans-serif;
			}

			.cascading-right {
				margin-right: -50px;
			}

			@media (max-width: 991.98px) {
				.cascading-right {
					margin-right: 0;
				}
			}

			@media (max-width: 991.98px) {
				.display-image {
					display: none;
				}
			}
		</style>

		<div class="container-fluid" style="height: 100vh;">
			<div class="row g-0" style="display: flex; align-items:center;">
				<div class="col-lg-4 mb-5 mb-lg-0">
					<div class="card" style="
            background: hsla(0, 0%, 100%, 0.55);
            backdrop-filter: blur(30px);
			width: 70%;
			margin: auto;
            ">
						<div class="card-body p-5 mt-5 shadow-5 text-center ">
							<h2 class="fw-bold mb-5">Log in</h2>
							<form method="post">
								<div class="form-outline mt-4 text-left">
									<label class="form-label " for="form3Example3">Username</label>
									<input type="text" name="t1" id="form3Example3" class="form-control" />

								</div>
								<div class="form-outline mb-4 text-left">
									<label class="form-label " for="form3Example4">Password</label>
									<input type="password" name="t2" id="form3Example4" class="form-control" />

								</div>
								<button type="submit" value="LOGIN" name="sbmt" class="btn btn-primary d-block btn-block" style="margin-top: 20px;">
									Log in
								</button>
								<div class="form-check d-flex justify-content-center mb-4" style="margin-top: 40px;">
									<a href="../index.php" onclick="javascript:window.open('../index.php#section-1','_self')">Back to Website</a>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="col-lg-8 mb-5 mb-lg-0 display-image">
					<img src="https://m.media-amazon.com/images/I/91GWWZn6QGL._AC_SL1500_.jpg" style="overflow: hidden; height:100vh;" class="w-100 rounded-4 shadow-4" alt="" />
				</div>
			</div>
		</div>
	</section>
</body>

</html>