<?php require TEMPLATE_PATH . "/include/header.php"; ?>

			<div class="col-md-10">
				<form action="">
					<input type="text" name="title" placeholder="Заголовок">
					<textarea name="summary" cols="30" rows="4" placeholder="Описание статьи"></textarea>
					<textarea name="content" cols="30" rows="10" placeholder="Тело статьи"></textarea>
					
					<div class="opt">
						<label for="category">Категория: </label>

						<select name="category">
							<option value="1">Спорт</option>
							<option value="2">Политика</option>
							<option value="3">Культура</option>
							<option value="4">Религия</option>
						</select>
					</div>

					<div class="opt" id="opt_r">
						<label for="status">Статус: </label>
						<select name="status">
							<option value="1">Опубликовано</option>
							<option value="0">Не опубликовано</option>
						</select>
					</div>
					<input class="button" type="submit" value="Добавить">
				</form>
			</div>
			<div class="col-md-12">
				
			</div>
		</div>

	</article>

<?php require TEMPLATE_PATH . "/include/footer.php"; ?>