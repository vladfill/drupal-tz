<?php 
require ( "config.php" );

$active = $_GET['active'];

switch ($active) {
	case 'singlePost':
		getSinglePost();
		break;

	case 'contacts':
		getContacts();
		break;

	case 'newPost':
		getNewPost();
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

function getSinglePost () {
	require_once ( TEMPLATE_PATH . "/singlePost.php" );
}

function getContacts () {
	$pageTitle = 'Контакты';
	require_once ( TEMPLATE_PATH . "/contacts.php" );
}

function getNewPost () {
	$pageTitle = 'Добавить статью';
	require_once ( TEMPLATE_PATH . "/newPost.php" );
}

function getAllPosts () {
	$pageTitle = 'Все статьи';
	require_once ( TEMPLATE_PATH . "/allPosts.php" );
}

function getNews () {
	$pageTitle = 'Новости';
	require_once ( TEMPLATE_PATH . "/allActivePosts.php" );
}

function getAllActivePosts () {
	$pageTitle = 'Главная';
	require_once ( TEMPLATE_PATH . "/allActivePosts.php" );
}
?>