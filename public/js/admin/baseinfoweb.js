$(document).ready(function(){
	$('.tag h4').mouseover(function(){
		$('.tag h4').removeClass('choose-tag');
		$(this).addClass('choose-tag');
	});
	$('.tag h4').click(function(){
		$('#infoweb div[class^="tag-"]').css('display','none');
		if($(this).hasClass('tag1'))
			$('.tag-infoweb').css('display','block');
		else if($(this).hasClass('tag2'))
			$('.tag-contact').css('display','block');
		else if($(this).hasClass('tag3'))
			$('.tag-images').css('display','block');
		else if($(this).hasClass('tag4'))
			$('.tag-analytics').css('display','block');
		else if($(this).hasClass('tag5'))
			$('.tag-mastertool').css('display','block');
		else if($(this).hasClass('tag6'))
			$('.tag-appface').css('display','block');
	});
});