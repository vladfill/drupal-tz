$(document).ready(function() {

	// Футер минимум снизу
	var displayHeight = window.innerHeight;
	$('article').css('min-height', displayHeight-160);

	// Присваивание класса current навигации
	var adrStr = window.location.search;
	switch(adrStr){
		case '?active=news': $('nav ul li[data-nav ^= "news"]').addClass('current');
			break;

		case '?active=contacts': $('nav ul li[data-nav ^= "contacts"]').addClass('current');
			break;

		case '?active=allPosts': $('header p a[data-nav ^= "allPosts"]').addClass('active');
			break;

		case '?active=newPost': $('header p a[data-nav ^= "newPost"]').addClass('active');
			break;

		default: $('nav ul li[data-nav ^= "default"]').addClass('current');
	}



	// Присвоение 1 странице класса active
	// $('.pagination a[data-page ^= "1"]').addClass('active');

	$(".pagination a").click( function (e){
		e.preventDefault();

		var page = $(this).attr("data-page"); //возвращает номер страницы
console.log(page);
		$(".col-md-10").load("index.php", {"page":page, "newPage": "newPage"}, function(){

			// При клике на номер страницы присваивается класс active
			// а с осталиных номеров убираеться 
			$('.pagination a').removeClass('active');
			$('.pagination a[data-page ^= ' + page + ']').addClass('active');

		});
	});

});