<!DOCTYPE html>
<!--[if lt IE 7]><html lang="ru" class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html lang="ru" class="lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html lang="ru" class="lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ru">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title> <?php echo $pageTitle; ?> </title>
	<meta name="description" content="" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="favicon.ico"  type="image/x-icon"/>
	<link rel="stylesheet" href="libs/bootstrap/bootstrap-grid-3.3.1.min.css" />
	<link rel="stylesheet" href="libs/font-awesome-4.2.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="libs/fancybox/jquery.fancybox.css" />
	<link rel="stylesheet" href="libs/owl-carousel/owl.carousel.css" />
	<link rel="stylesheet" href="libs/countdown/jquery.countdown.css" />
	<link rel="stylesheet" href="css/fonts.css" />
	<link rel="stylesheet" href="css/main.css" />
	<link rel="stylesheet" href="css/media.css" />
</head>
<body>

	<header>
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<a href="#"><img src="img/logo.png" alt="alt"></a>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-6"><p>
				<a href="?active=allPosts"class="button"><span>Все статьи</span></a>
				<a href="?active=newPost" class="button"><span>Добавить стаью</span></a></p></div>
			</div>
		</div>
	</header>



	<article>

		<div class="container">

			<h1> <?php echo $pageTitle; ?> </h1>

			<div class="col-md-2">
				<!-- Навигация -->
				<nav>
					<ul>
						<li class="current"><a href="index.php">Главная</a></li>
						<li><a href="?active=news">Новости</a></li>
						<li><a href="?active=contacts">Контакты</a></li>
					</ul>
				</nav>
			</div>