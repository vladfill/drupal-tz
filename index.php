<?php 
require ( "config.php" );

$active = $_GET['active'];

if ( isset( $_GET['id'] ) ) $id = (int)$_GET['id'];

if( isset( $_POST['newPage'] ) ) {
  $active = $_POST['newPage'];
  $page = (int)$_POST['page'];
  $start = $page * HOMEPAGE_NUM_POSTS - HOMEPAGE_NUM_POSTS;
}

switch ($active) {
	
	case 'newPage':
	getNewPage( HOMEPAGE_NUM_POSTS, $start );
	break;

	case 'deletePost':
	deletePost( $id );
	break;

	case 'singlePost':
	getSinglePost( $id );
	break;

	case 'contacts':
	getContacts();
	break;

	case 'changePost':
	changePost( $id );
	break;

	case 'newPost':
	setNewPost( $_POST );
	break;

	case 'allPosts':
	getAllPosts();
	break;
	
	case 'news':
	getNews();
	break;

	default:
	getAllActivePosts();
	break;
}

// добавление статей страницы AJAX
function getNewPage($posts, $start){
	$pageTitle = 'Страница ' . $page;
	$result = Post::getAllPosts( HOMEPAGE_NUM_POSTS, $start );
	require_once ( TEMPLATE_PATH . "/allActivePostsAJAX.php" );
}

// удаление статьи
function deletePost( $id ) {
	$post = Post::getPostById( $id );
	$post->delete();
	header( "Location: index.php?status=changesSaved" );
}

// выводит статью в полном виде
function getSinglePost ( $id ) {
	$post = Post::getPostById( $id );
	$pageTitle = $post->title;
	require_once ( TEMPLATE_PATH . "/singlePost.php" );
}

// выовдит контакты
function getContacts () {
	$pageTitle = 'Контакты';
	require_once ( TEMPLATE_PATH . "/contacts.php" );
}

// изменение статьи
function changePost ($id) {
	$pageTitle = 'Изменить данные';
	$formAction = 'changePost';

	if ( isset( $_POST['addNew'] ) ) {
		$post = new Post( $_POST );
		$post->update();
		header( "Location: index.php?status=postDeleted" );
	}

	elseif ( isset( $_POST['delete'] ) ) {
		// echo $id;
		// echo Post::delete( $id );
		// $post = new Post( $_POST['id'] );
		$post = Post::getPostById( $id );
		$post->delete();
		// header( "Location: index.php?status=postDeleted" );
	}

	elseif ( isset( $_POST['cansel'] ) ) {
		header( "Location: index.php" );
		require_once ( TEMPLATE_PATH . "/allPosts.php" );
	}

	else {
		$post = Post::getPostById( $id );
		$category = '(' . getCategoryName ( $post->category ) . ')';
		$status = '(' . getStatusName ( $post->status ) . ')';
		require_once ( TEMPLATE_PATH . "/newPost.php" );
	}
}

// добавить новую статью
function setNewPost ($formPost) {
	$pageTitle = 'Добавить статью';
	$formAction = 'newPost';

	if ( isset( $formPost['addNew'] ) ) {
		$post = new Post( $formPost );
		$post->insert();
		header( "Location: index.php?status=addPost" );
	}

	elseif ( isset( $formPost['delete'] ) ) {
		Post::delete( $id );
		header( "Location: admin.php?status=postDeleted" );
	}

	elseif ( isset( $formPost['cansel'] ) ) {
		header( "Location: index.php" );
	}

	else {
		require_once ( TEMPLATE_PATH . "/newPost.php" );
	}
	
}

// выводит все статьи для редактирования
function getAllPosts () {
	$pageTitle = 'Все статьи';
	$result = Post::getAllPosts(100, 0, 'ORDER BY publicationDate DESC');
	require_once ( TEMPLATE_PATH . "/allPosts.php" );
}

// выводит все опубликованые статьи
function getNews () {
	$pageTitle = 'Новости';
	$result = Post::getAllPosts(HOMEPAGE_NUM_POSTS);
	require_once ( TEMPLATE_PATH . "/allActivePosts.php" );
}

// выводит все опубликованые статьи
function getAllActivePosts () {
	$pageTitle = 'Главная';
	$result = Post::getAllPosts(HOMEPAGE_NUM_POSTS);
	require_once ( TEMPLATE_PATH . "/allActivePosts.php" );
}

// выводит название категории
function getCategoryName ( $category ) {
	switch ( $category ) {
		case '1': 
		return 'Спорт';
		break;

		case '2': 
		return 'Политика';
		break;

		case '3': 
		return 'Культура';
		break;

		case '4': 
		return 'Религия';
		break;
	}
}

// выводит название статуса
function getStatusName ( $status ) {
	switch ( $status ) {
		case '0':
		return 'Не опубликовано';
		break;
		case '1':
		return 'Опубликовано';
		break;
	}
}
?>