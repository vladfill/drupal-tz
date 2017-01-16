<?php 
// данные для входа в БД
define( "DB_DSN", "mysql:host=localhost;dbname=news" );
define( "DB_USERNAME", "root" );
define( "DB_PASSWORD", "" );
// папка с классами
define( "CLASS_PATH", "classes" );
// папка с include
define( "TEMPLATE_PATH", "template" );
// количевство статей на странице
define( "HOMEPAGE_NUM_POSTS", 10 );

require( CLASS_PATH . "/Post.php" );
?>