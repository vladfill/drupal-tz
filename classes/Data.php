<?php 
/**
* 
*/
class Post
{

	/**
  * @var int ID статей из базы данных
  */
	private $id = null;

	/**
  * @var int Дата первой публикации статьи
  */
	private $publicationDate = null;

	/**
  * @var string Полное название статьи
  */
	private $title = null;

	/**
  * @var string Краткое описание статьи
  */
	private $summary = null;

	/**
  * @var string HTML содержание статьи
  */
	private $content = null;

	/**
  * @var string название категории
  */
	private $category = null;

	/**
  * @var string статус публикации
  */
	private $status = null;

	/**
  * Устанавливаем свойства с помощью значений в заданном массиве
  *
  * @param assoc Значения свойств
  */
	function __construct( $data=array() ) {

		if( ! is_array($data) ) return;

		if ( isset( $data['id'] ) ) $this->id = (int)$data['id'];

		if ( isset( $data['publicationDate'] ) ) $this->publicationDate = $data['publicationDate'];

		if ( isset( $data['title'] ) ) $this->title = $data['title'];

		if ( isset( $data['summary'] ) ) $this->summary = $data['summary'];

		if ( isset( $data['content'] ) ) $this->content = $data['content'];

		if ( isset( $data['category'] ) )
		{
			switch ($data['category']) {
				case '1': 
				$this->category = 'Спорт';
				break;

				case '2': 
				$this->category = 'Политика';
				break;

				case '3': 
				$this->category = 'Культура';
				break;

				case '4': 
				$this->category = 'Религия';
				break;
			}
		} 
		if ( isset( $data['status'] ) )
		{
			switch ($data['status']) {
				case '0':
				$this->status = 'Не опубликовано';
				break;
				case '1':
				$this->status = 'Опубликовано';
				break;
			}
		}

	}

	/**
  * Возвращаем объект статьи соответствующий заданному ID статьи
  *
  * @param int ID статьи
  * @return Article|false Объект статьи или false, если запись не найдена или возникли проблемы
  */

	public static function getPostById( $id ) {
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$sql = "SELECT *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM articles WHERE id = :id";
		$st = $conn->prepare( $sql );
		$st->bindValue( ":id", $id, PDO::PARAM_INT );
		$st->execute();
		$row = $st->fetch();
		$conn = null;
		if ( $row ) return new Article( $row );
	}


	/**
  * Возвращает все (или диапазон) объектов статей в базе данных
  *
  * @param int Optional Количество строк (по умолчанию все)
  * @param string Optional Столбец по которому производится сортировка  статей (по умолчанию "publicationDate DESC")
  * @return Array|false Двух элементный массив: results => массив, список объектов статей; totalRows => общее количество статей
  */
	public static function getAllPosts( $posts=100, $start=0, $order="publicationDate DESC WHERE status=1" ) {
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$sql = "SELECT * FROM posts ORDER BY " . $order . " LIMIT :start, :numRows";

		$st = $conn->prepare( $sql );
		$st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
		$st->bindValue( ":start", $start, PDO::PARAM_INT );
		$st->execute();
		$list = array();

		while ( $row = $st->fetch() ) {
			$post = new Article( $row );
			$list[] = $post;
		}

		return $list;
	}


	/**
  * Вставляем текущий объект статьи в базу данных, устанавливаем его свойства.
  */
	public function insert() {

    // Есть у объекта статьи ID?
		if ( !is_null( $this->id ) ) trigger_error ( "Article::insert(): Attempt to insert an Article object that already has its ID property set (to $this->id).", E_USER_ERROR );

    // Вставляем статью
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$sql = "INSERT INTO articles ( title, summary, content, category, status ) VALUES ( :title, :summary, :content, :category, :status )";
		$st = $conn->prepare ( $sql );
		$st->bindValue( ":title", $this->title, PDO::PARAM_STR );
		$st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
		$st->bindValue( ":content", $this->content, PDO::PARAM_STR );
		$st->bindValue( ":category", $this->category, PDO::PARAM_STR );
		$st->bindValue( ":status", $this->status, PDO::PARAM_STR );
		$st->execute();
		$this->id = $conn->lastInsertId();
		$conn = null;
	}

	/**
  * Удаляем текущий объект статьи из базы данных
  */

  public function delete() {

    // Есть ли у объекта статьи ID?
    if ( is_null( $this->id ) ) trigger_error ( "Article::delete(): Attempt to delete an Article object that does not have its ID property set.", E_USER_ERROR );

    // Удаляем статью
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM articles WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

  /**
  * Обновляем текущий объект статьи в базе данных
  */

  public function update() {

    // Есть ли у объекта статьи ID?
    if ( is_null( $this->id ) ) trigger_error ( "Article::update(): Attempt to update an Article object that does not have its ID property set.", E_USER_ERROR );

    // Обновляем статью
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE articles SET title=:title, summary=:summary, content=:content WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
}
?>