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
						<h3>Your news</h3>
						<table class="table table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Title</th>
									<th>Content</th>
									<th>Category</th>
									<th>Created At</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$id = $_SESSION["id"];
									$result = getAllNewsByUser($id);
									$no = 0;
									if ($result != false)
									{
										while($row = $result->fetch_assoc())
										{
											$no++;
											$newsId = $row["id"];
											$newsTitle = $row["title"];
											$newsContent = $row["content"];
											$newsCreated = $row["created_at"];
											$newsCategory = $row["category_name"];

								?>

									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $newsTitle; ?></td>
										<td><?php echo strlen($newsContent) > 20 ? substr($newsContent,0,20)." ..." : $newsContent; ?></td>
										<td><?php echo $newsCategory; ?></td>
										<td><?php echo date("d M Y", strtotime($newsCreated)); ?></td>
									</tr>
								<?php
										}
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- End of Content -->
		</div>
	</div>
</body>
</html>