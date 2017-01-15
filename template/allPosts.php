<?php require TEMPLATE_PATH . "/include/header.php"; ?>

			<div class="col-md-10">
				<div class="news">

<?php foreach ($result as $post) { ?>
					<div class="post">

						<div class="news_data">
							<time datetime=" <?php echo date("d.m.Y" , $post->publicationDate ); ?> ">
								 <?php echo date("d.m.Y" ,$post->publicationDate ); ?> 
							</time>
							<span class="category"><?php echo getCategoryName ( $post->category ); ?></span>
							<span class="status"><?php echo getStatusName ( $post->status ) ?></span>
						</div>

						<h2><a href="?active=changePost&id=<?php echo $post->id; ?> "> <?php echo $post->title; ?> </a></h2>

						<p> <?php echo $post->summary; ?> </p>

					</div>
<?php } ?>

					<!--  Пагинатор -->
					<div class="pagination">
						<ul>
							<li><a href="#" class="button active">1</a></li>
							<li><a href="#" class="button">2</a></li>
							<li><a href="#" class="button">3</a></li>
							<li><a href="#" class="button">4</a></li>
							<li><a href="#" class="button">5</a></li>
						</ul>
					</div>

				</div>
			</div>

<?php require TEMPLATE_PATH . "/include/footer.php"; ?>