<!-- Start of Sidebar -->
<div class="col-md-3 col-xs-12">
	<div class="row">
		<div class="col-md-12 pb-2">
			<div class="card">
				<div class="card-header bg-info text-white">
					<h5>Menu</h3>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item"><a href="<?php echo $baseUrl; ?>">Home</a></li>
					
					<?php
						if (logged_in() === FALSE)
						{
					?>
						<li class="list-group-item"><a href="<?php echo $baseUrl.'login.php'; ?>">Log in</a></li>
					<?php
						} else {
					?>
						<li class="list-group-item dropdown dropdown-toggle">News <span class="caret"></span>
							<div class="dropdown-content">
								<a href="<?php echo $baseUrl.'pages/news/form.php'; ?>">Create news</a>
								<a href="<?php echo $baseUrl.'pages/news/index.php'; ?>">View your news</a>
							</div>
						</li>
						<li class="list-group-item"><a href="<?php echo $baseUrl.'logout.php'; ?>">Log out</a></li>
					<?php
						}
					?>
				</ul>
			</div>
		</div>
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bg-info text-white">
					<h5>Category</h3>
				</div>
				<ul class="list-group list-group-flush">
				<?php
					$result = getAllCategories();
					
					if ($result != false)
					{
						while($row = $result->fetch_assoc())
						{
							$categoriesId = $row["id"];
							$categoriesName = $row["name"];

				?>
					<li class="list-group-item">
						<a href="./index.php?category=<?php echo $categoriesId; ?>">
							<?php echo $categoriesName; ?>
						</a>
					</li>
				<?php
						}
					}
				?>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- End of Sidebar -->