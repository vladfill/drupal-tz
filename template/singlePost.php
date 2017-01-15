<?php require TEMPLATE_PATH . "/include/header.php"; ?>

			<div class="col-md-10">
				<div class="news">

					<div class="single_post">

						<div class="news_data">
							<time datetime=" <?php echo date("d.m.Y" , $post->publicationDate ); ?> "> <?php echo date("d.m.Y" , $post->publicationDate ); ?> </time>
							<span class="category"> <?php echo getCategoryName ( $post->category ); ?> </span>
						</div>

						<h2> <?php echo $post->title; ?> </h2>

						<p> <?php echo $post->summary; ?> </p>

						<p id="single_post">
							 <?php echo $post->content; ?> 
						</p>

					</div>

				</div>
			</div>

<?php require TEMPLATE_PATH . "/include/footer.php"; ?>