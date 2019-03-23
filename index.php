<?php
	require './core/config.php';
	require './core/auth/auth.php';
	require './core/news.php';
	require './core/categories.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Portal Berita</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require_once './includes/assets.php'; ?>
</head>
<body>
	<div class="container pt-3 pb-3">
		<div class="row">
			<?php require_once './includes/header.php'; ?>
			<?php require_once './includes/sidebar.php'; ?>
			<!-- Start of Content -->
			<div class="col-md-9 col-xs-12">
				<div class="row">
					<?php
						$category = false;
						if (isset($_GET["category"]))
						{
							$category = $_GET["category"];
						}
						$result = getAllNews($category);
						if ($result != false)
						{
							while($row = $result->fetch_assoc())
							{
								$newsId = $row["id"];
								$newsTitle = $row["title"];
								$newsContent = $row["content"];
								$newsCreator = $row["firstname"];
								$newsCreated = $row["created_at"];
								$newsCategory = $row["category_name"];
								$newsCategoryId = $row["category_id"];

					?>
						<div class="col-md-12 pb-3">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">
									<a href="./berita/<?php echo $newsId; ?>"><?php echo $newsTitle; ?></a>
									</h4>
									<h6 class="card-subtitle mb-2 text-muted">
										<i class="fa fa-calendar-alt"></i> <?php echo date("d M Y", strtotime($newsCreated)) ?> 
										by <a href="#"><?php echo ucfirst($newsCreator); ?></a> 
										in <a href="./index.php?category=<?php echo $newsCategoryId; ?>"><?php echo $newsCategory; ?></a>
									</h6>
									<p class="card-text"><?php echo strlen($newsContent) > 150 ? substr($newsContent,0,150)." ..." : $newsContent; ?></p>
									<!-- Category: <a href="#" class="card-link">Another link</a> -->
								</div>
							</div>
						</div>
					<?php
							}
						} else {
					?>
						<div class="col-md-12 pb-3 text-center text-muted">
							<h4>There is no post under this category</h4>
						</div>
					<?php
						}
					?>
				</div>
			</div>
			<!-- End of Content -->
		</div>
	</div>
</body>
</html>