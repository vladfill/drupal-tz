<?php require TEMPLATE_PATH . "/include/header.php"; ?>

			<div class="col-md-10">
				<form action="index.php?active=<?php echo $formAction; ?>" method="post">
					<div class="opt">
						<label for="category">Категория: </label>

						<select name="category">
							<option value="1">Спорт</option>
							<option value="2">Политика</option>
							<option value="3">Культура</option>
							<option value="4">Религия</option>
						</select>
						<?php echo $category; ?>
					</div>

					<div class="opt" id="opt_r">
						<label for="status">Статус: </label>
						<select name="status">
							<option value="1">Опубликовано</option>
							<option value="0">Не опубликовано</option>
						</select>
						<?php echo $status; ?>
					</div>
					<input type="text" name="title" placeholder="Заголовок" value="<?php echo $post->title; ?>">
					<textarea name="summary" cols="30" rows="4" placeholder="Описание статьи"><?php echo $post->summary; ?></textarea>
					<textarea name="content" cols="30" rows="10" placeholder="Тело статьи"><?php echo $post->content; ?></textarea>
					
					<input class="button" type="submit" value="Добавить" name="addNew">
					<input class="button" type="submit" value="Отмена" name="cansel">

					<?php if ( isset( $_GET['id'] ) ) {
						echo '<a href="index.php?active=deletePost&id=' . $post->id . '" class="button">Удалить</a>';
						echo '<input type="hidden" value="' . $post->id . '" name="id">';
					}
					
					?>
					
				</form>
			</div>
			<div class="col-md-12">
				
			</div>
		</div>

	</article>

<?php require TEMPLATE_PATH . "/include/footer.php"; ?>