<?php 
/**
* 
*/
class Post
{

	/**
  * @var int ID статей из базы данных
  */
	public $id = null;

	/**
  * @var int Дата первой публикации статьи
  */
	public $publicationDate = null;

	/**
  * @var string Полное название статьи
  */
	public $title = null;

	/**
  * @var string Краткое описание статьи
  */
	public $summary = null;

	/**
  * @var string HTML содержание статьи
  */
	public $content = null;

	/**
  * @var string название категории
  */
	public $category = null;

	/**
  * @var string статус публикации
  */
	public $status = null;

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

		if ( isset( $data['category'] ) ) $this->category = $data['category'];
		 
		if ( isset( $data['status'] ) ) $this->status = $data['status'];

	}

	/**
  * Возвращаем объект статьи соответствующий заданному ID статьи
  *
  * @param int ID статьи
  * @return Article|false Объект статьи или false, если запись не найдена или возникли проблемы
  */

	public static function getPostById( $id ) {
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$sql = "SELECT * FROM posts WHERE id=:id";
		$st = $conn->prepare( $sql );
		$st->bindValue( ":id", $id, PDO::PARAM_INT );
		$st->execute();
		$row = $st->fetch();
		$conn = null;
		if ( $row ) return new Post( $row );
	}


	/**
  * Возвращает все (или диапазон) объектов статей в базе данных
  *
  * @param int Optional Количество строк (по умолчанию все)
  * @param string Optional Столбец по которому производится сортировка  статей (по умолчанию "publicationDate DESC")
  * @return Array|false общее количество статей
  */
	public static function getAllPosts( $posts=100, $start=0, $order="WHERE status=1 ORDER BY publicationDate DESC") {
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$sql = "SELECT * FROM posts " . $order . " LIMIT :start, :posts";

		$st = $conn->prepare( $sql );
		$st->bindValue( ":posts", $posts, PDO::PARAM_INT );
		$st->bindValue( ":start", $start, PDO::PARAM_INT );
		$st->execute();
		$list = array();

		while ( $row = $st->fetch() ) {
			$post = new Post( $row );
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
		$sql = "INSERT INTO posts ( title, summary, content, category, status ) VALUES ( :title, :summary, :content, :category, :status )";
		$st = $conn->prepare ( $sql );
		$st->bindValue( ":title", $this->title, PDO::PARAM_STR );
		$st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
		$st->bindValue( ":content", $this->content, PDO::PARAM_STR );
		$st->bindValue( ":category", $this->category, PDO::PARAM_INT );
		$st->bindValue( ":status", $this->status, PDO::PARAM_INT );
		$st->execute();
		// $this->id = $conn->lastInsertId();
		$conn = null;
	}

	/**
  * Удаляем текущий объект статьи из базы данных
  */

  public static function delete( $id ) {

    // Есть ли у объекта статьи ID?
    // if ( is_null( $this->id ) ) trigger_error ( "Article::delete(): Attempt to delete an Article object that does not have its ID property set.", E_USER_ERROR );

    // Удаляем статью
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM posts WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

  /**
  * Обновляем текущий объект статьи в базе данных
  */

  public function update() {

    // Есть ли у объекта статьи ID?
    if ( is_null( $this->id ) ) trigger_error ( "Post::update(): Attempt to update an Article object that does not have its ID property set.", E_USER_ERROR );

    // Обновляем статью
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE posts SET title=:title, summary=:summary, content=:content, category=:category, status=:status WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
    $st->bindValue( ":category", $this->category, PDO::PARAM_INT );
		$st->bindValue( ":status", $this->status, PDO::PARAM_INT );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
}
?>