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
	<title>Login</title>
	<?php require_once './includes/assets.php'; ?>
</head>
<body>

	<div class="login-container">
		<!-- Default form login -->
		<form class="text-center border border-light p-5" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

			<?php
				// form submiited
				if($_POST) {
					$username = $_POST['username'];
					$password = $_POST['password'];

					$alertFailed = "<div class='alert alert-danger'>";
					$error = false;
					
					if($username == "") {
						$alertFailed .= " * Username Field is Required <br />";
					}

					if($password == "") {
						$alertFailed .= " * Password Field is Required <br />";
					}

					if($username && $password) {
						if(userExists($username) == TRUE) {
							$login = login($username, $password);
							if($login) {
								$userdata = userdata($username);

								$_SESSION['id'] = $userdata['id'];

								$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 
								
								echo '<script type="text/javascript">
									window.location = "'.$link.'"
								</script>';
								// header('location: ' . $link);
								// exit();
									
							} else {
								$alertFailed .= "Incorrect username/password combination";
							}
						} else{
							$alertFailed .= "username does not exists";
						}
					}
					$alertFailed .= "</div>";
					echo $alertFailed;

				}

			?>

			<p class="h4 mb-4">Sign in</p>
			<div>
				<input class="form-control" type="text" name="username" id="username" autocomplete="off" placeholder="Username" />
			</div>
			<br />

			<div>
				<input class="form-control" type="password" name="password" id="password" autocomplete="off" placeholder="Password" />
			</div>
			
			<div class="row">
				<!-- Sign in button -->
				<div class="col-md-6">
					<button class="btn btn-info btn-block my-4" type="submit">Sign in</button>
				</div>
				<div class="col-md-6">
					<button class="btn btn-info btn-block my-4" type="reset">Cancel</button>
				</div>
			</div>

			<!-- Register -->
			<p>Not a member?
				<a href="register.php">Register</a>
			</p>
			
		</form>
	</div>
</body>
</html>