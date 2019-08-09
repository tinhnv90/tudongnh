$(document).ready(function(){
	$('.remove-cart').click(function(){
		$.ajaxSetup({headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}});
		$.ajax({
            type : 'POST',
            url  : window.location.origin+'/tudongnh/remove-cart',
            data : {idproduct:$(this).attr('data-idproduct')},
            success :  function(data){
                $('li[data-idproduct="'+data.result+'"]').remove();
            }
        });
	});
	$('.payment-login').click(function(){
		window.location.href=window.location.origin+'/tudongnh/dang-nhap';
	});
	$('.active-payment ').click(function(){
		if($('.payment>.content').hasClass('hidden'))
			$('.payment>.content').removeClass('hidden');
		else
			$('.payment>.content').addClass('hidden');
	});
});