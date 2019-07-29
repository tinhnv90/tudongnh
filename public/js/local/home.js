$(document).ready(function(){
	$('#slideshow ul li:gt(0)').hide();
	setInterval(function(){
		$('#slideshow ul li:first-child')
		.fadeOut(3000)
        .next('li').fadeIn(3000)
        .end().appendTo('#slideshow ul');
    },4000);

    setInterval(function(){
		$("#product-mostview>.scoll ul>.first").
			animate({marginLeft:'-'+$(this).width()},2000,function(){
	        $(this).removeClass('first').css({'margin':'unset'})
                .appendTo('#product-mostview>.scoll ul');
            $("#product-mostview>.scoll ul li:first-child").addClass('first');
	    });
    },2000);

    setInterval(function(){
        $("#posts>.scoll ul li:first-child").
            animate({marginLeft:'-'+$(this).width()},2000,function(){
            $("#posts>.scoll ul li:last-child").css('display','block');
            $(this).css({'margin':'unset','display':'none'}).
            appendTo('#posts>.scoll ul');
        });
    },2000);


    var device_width=$('#container').width();
    if(device_width<767){
    	$('.scoll>ul').each(function(){
    		var _width=231*$(this).contents().filter('li').length
    		$(this).css("width",_width - 15);
    	});
    }else{
        $('.scoll>ul').removeAttr('style');
    }
    $(window).resize(function(){
        var device_width=$('#container').width();
        if(device_width<767){
            $('.scoll>ul').each(function(){
                var _width=231*$(this).contents().filter('li').length
                $(this).css("width",_width -15);
            });
        }else{
            $('.scoll>ul').removeAttr('style');
        }
    });
});