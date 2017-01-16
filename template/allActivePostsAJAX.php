
<div class="news">

	<?php /*var_dump($result);*/ foreach ($result as $post) { ?>
	<div class="post">

		<div class="news_data">
			<time datetime=" <?php echo date("d.m.Y" , $post->publicationDate ); ?> ">
				<?php echo date("d.m.Y" ,$post->publicationDate ); ?> 
			</time>
			<span class="category"><?php echo getCategoryName ( $post->category ); ?></span>
		</div>

		<h2><a href="?active=singlePost&id=<?php echo $post->id; ?> "> <?php echo $post->title; ?> </a></h2>

		<p> <?php echo $post->summary; ?> </p>

	</div>
	<?php } ?>
</div>

<!--  Пагинатор -->
<div class="pagination">
	<ul>
		<?php for($i = 1; $i <= ceil(Post::getNumPages(' WHERE status=1')/HOMEPAGE_NUM_POSTS); $i++){
			echo "<li><a href='#' class='button' data-page='$i'>$i</a></li>";
		} ?>
	</ul>
</div>

<script src="../libs/jquery/jquery-1.11.1.min.js"></script>
<script src="../js/common.js"></script>