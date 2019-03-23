<?php
	require '../../core/base.php';
	require $baseUrl.'core/config.php';
	require $baseUrl.'core/auth/auth.php';
	require $baseUrl.'core/news.php';
	require $baseUrl.'core/categories.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Portal Berita</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require_once $baseUrl.'includes/assets.php'; ?>
</head>
<body>
	<div class="container pt-3 pb-3">
		<div class="row">
			<?php require_once $baseUrl.'includes/header.php'; ?>
			<?php require_once $baseUrl.'includes/sidebar.php'; ?>
			<!-- Start of Content -->
			<div class="col-md-9 col-xs-12">
				<div class="row">
					<div class="col-md-12 pb-3">
						<h3>Create news</h3>
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
						<?php
							// form is submitted
							if($_POST) {

								$title = $_POST['title'];
								$content = $_POST['content'];
								$category_id = $_POST['category_id'];
								$alertSuccess = "<div class='alert alert-success'>";
								$alertFailed = "<div class='alert alert-danger'>";
								$success = false;

								if($title == "") {
									$alertFailed .= " * Title is Required <br />";
								}

								if($content == "") {
									$alertFailed .= " * Content is Required <br />";
								}

								if($category_id == "") {
									$alertFailed .= " * Category is Required <br />";
								}

								if($title && $content && $category_id) {

									if(titleExist($title) === TRUE) {
										$alertFailed .= $_POST['title'] . " already exists !!";
									} else {
										if(createNews() === TRUE) {
											$success = true;
											header('location: '.$baseUrl.'index.php');
											exit();
										} else {
											$alertFailed .= "Error";
										}
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
							<div class="form-group">
								<label for="category">Category</label>
								<select class="form-control" name="category_id" id="">
									<?php
										$result = getAllCategories();
										
										if ($result != false)
										{
											while($row = $result->fetch_assoc())
											{
												$categoriesId = $row["id"];
												$categoriesName = $row["name"];

									?>
										<option value="<?php echo $categoriesId; ?>"><?php echo $categoriesName; ?></option>
									<?php
											}
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="title">Title</label>
								<input type="text" class="form-control" name="title">
							</div>
							<div class="form-group">
								<label for="title">Content</label>
								<textarea name="content" class="form-control" cols="30" rows="10"></textarea>
							</div>
							<div class="form-group">
								<button class="btn btn-submit" type="submit">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- End of Content -->
		</div>
	</div>
</body>
</html>