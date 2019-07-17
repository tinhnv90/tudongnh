$(document).ready(function(){
	$('#slideshow ul li:gt(0)').hide();
	setInterval(function(){
		$('#slideshow ul li:first-child')
		.fadeOut(3000)
        .next('li').fadeIn(3000)
        .end().appendTo('#slideshow ul');
    },4000);

    setInterval(function(){
		$("#product-mostview>.scoll ul li:first-child").
			animate({marginLeft:'-'+$(this).width()},2000,function(){
				$('#product-mostview>.scoll ul li').css({'display':'block','z-index':9});
	        $(this).css({'margin':'0px','display':'none','z-index':1})
                .appendTo('#product-mostview>.scoll ul');
	    });
    },2000);

    setInterval(function(){
        $("#post>.scoll ul li:first-child").
            animate({marginLeft:'-'+$(this).width()},2000,function(){
                $('#post>.scoll ul li').css({'display':'block','z-index':9});
            $(this).css({'margin':'0px','display':'none','z-index':1})
                .appendTo('#post>.scoll ul');
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