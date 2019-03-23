<?php 

require './core/config.php';
require './core/auth/auth.php';

if(logged_in() === TRUE) {
	header('location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<?php require_once './includes/assets.php'; ?>
</head>
<body>
<div class="register-container">
	<form class="text-center border border-light p-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<?php
			// form is submitted
			if($_POST) {

				$fname = $_POST['fname'];
				$lname = $_POST['lname'];
				$username = $_POST['username'];
				$password = $_POST['password'];
				$cpassword = $_POST['cpassword'];
				$alertSuccess = "<div class='alert alert-success'>";
				$alertFailed = "<div class='alert alert-danger'>";
				$success = false;

				if($fname == "") {
					$alertFailed .= " * First Name is Required <br />";
				}

				if($lname == "") {
					$alertFailed .= " * Last Name is Required <br />";
				}

				if($username == "") {
					$alertFailed .= " * Username is Required <br />";
				}

				if($password == "") {
					$alertFailed .= " * Password is Required <br />";
				}

				if($cpassword == "") {
					$alertFailed .= " * Conform Password is Required <br />";
				}

				if($fname && $lname && $username && $password && $cpassword) {

					if($password == $cpassword) {
						if(userExists($username) === TRUE) {
							$alertFailed .= $_POST['username'] . " already exists !!";
						} else {
							if(registerUser() === TRUE) {
								$alertSuccess .= "Successfully Registered <a href='login.php'>Login</a>";
								$success = true;
							} else {
								$alertFailed .= "Error";
							}
						}
					} else {
						$alertFailed .= " * Password does not match with Confirm Password <br />";
					}
				}
				if ($success == true)
				{
					$alertSuccess .= "</div>";
					echo $alertSuccess;
				} else {
					$alertFailed .= "</div>";
					echo $alertFailed;
				}

			}
		?>
		<p class="h4 mb-4">Sign up</p>
	
		<div class="form-row mb-4">
			<div class="col">
				<input type="text" class="form-control" placeholder="First name" name="fname" autocomplete="off" value="<?php if($_POST) {
				echo $_POST['fname'];
				} ?>">
			</div>
			<div class="col">
				<input type="text" class="form-control" name="lname" placeholder="Last Name" autocomplete="off" value="<?php if($_POST) {
				echo $_POST['lname'];
				} ?>" />
			</div>
		</div>
	
		<input type="text" class="form-control mb-4" name="username" placeholder="Username" autocomplete="off" value="<?php if($_POST) {
				echo $_POST['username'];
				} ?>" />
	
		<div class="form-row mb-4">
			<input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" />
		</div>
		<div class="form-row mb-4">
			<input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" autocomplete="off" />
		</div>

		<button class="btn btn-info my-4 btn-block" type="submit">Sign Up</button>
	
		<hr>
		Already Registered ? Click <a href="login.php">login</a> 
	</form>
</div>
</body>
</html>