$(document).ready(function(){
	$('.remove-cart').click(function(){
		$.ajaxSetup({headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}});
		$.ajax({
            type : 'POST',
            url  : window.location.origin+'/remove-cart',
            data : {idproduct:$(this).attr('data-idproduct')},
            success :  function(data){
                $('li[data-idproduct="'+data.result+'"]').remove();
                var numitem=parseInt($('#topbar-bottom-right .cart-item').attr('data-cart'));
                $('.cart-item').attr('data-cart',--numitem);
                $('.cart-item').text(numitem);
            }
        });
	});
	$('.payment-login').click(function(){
		window.location.href=window.location.origin+'/dang-nhap';
	});
	$('.active-payment ').click(function(){
		if($('.payment>.content').hasClass('hidden'))
			$('.payment>.content').removeClass('hidden');
		else
			$('.payment>.content').addClass('hidden');
	});
});