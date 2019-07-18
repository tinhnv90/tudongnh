$(document).ready(function(){
	function postAjax(url,json_parementer){
		var jsonData=Object;
		$.ajaxSetup({headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}});
		$.ajax({
            type : 'POST',
            url  : url,
            data : json_parementer,
            success :  function(data){
                jsonData=data;
            }
        });
		return jsonData;
	}

	//sự kiện click menu trên mobile
	var _domain=window.location.origin+'/tudongnh';
	$('#nav-bar-mobile>.open-nav-mobile>i').click(function(){
		if($(this).hasClass('fa-bars')){
			$(this).addClass('fa-times');
			$(this).removeClass('fa-bars');
			$('#category-mobile').css('display','block');
		}else{
			$(this).addClass('fa-bars');
			$(this).removeClass('fa-times');
			$('#category-mobile').css('display','none');
		}
	});

	//sự kiện chọn sản phẩm vào giỏ hàng
	$('.add-cart').click(function(){
		var idproduct=$(this).parent().attr('data-idproduct');
		var numitem=parseInt($('#topbar-bottom-right .cart-item').attr('data-cart'));
		if($(this).hasClass('bkg-addcart')){
			$(this).removeClass('bkg-addcart');
			$(this).text('Mua Hàng');
			$('.cart-item').text(--numitem);
		}else{
			$(this).addClass('bkg-addcart');
			$(this).text('Hủy');
			$('.cart-item').text(++numitem);
		}
		$('.cart-item').attr('data-cart',numitem);

		//ajax post: add product in ther cart
		var urlrequest=_domain+'/add-cart';
		var json_parementer={idproduct : idproduct, numitem:numitem};
        var dataResult=postAjax(urlrequest,json_parementer);
	});

	//lựa chọn sản phẩm ưa thích
	$('.add-wishlist').click(function(){
		var idproduct=$(this).parent().attr('data-idproduct');
		var numitem=parseInt($('.totalWishList').text());
		if($(this).hasClass('color-active')){
			$(this).removeClass('color-active');
			$('.totalWishList').text(--numitem);
		}else{
			$(this).addClass('color-active');
			$('.totalWishList').text(++numitem);
		}
		$('.totalWishList-mb').text(numitem);

		//ajax post: add product in ther cart
		var urlrequest=_domain+'/add-wishlist';
		var json_parementer={idproduct : idproduct};
        var dataResult=postAjax(urlrequest,json_parementer);
	});
	//lựa chọn sản phẩm so sánh
	$('.add-compare').click(function(){
		var idproduct=$(this).parent().attr('data-idproduct');
		var numitem=parseInt($('.totalCompare').text());
		if($(this).hasClass('color-active')){
			$(this).removeClass('color-active');
			$('.totalCompare').text(--numitem);
			$(this).contents().filter('i').removeClass('fa-subscript');
			$(this).contents().filter('i').addClass('fa-retweet');
		}else{
			$(this).addClass('color-active');
			$('.totalCompare').text(++numitem);
			$(this).contents().filter('i').removeClass('fa-retweet');
			$(this).contents().filter('i').addClass('fa-subscript');
		}
		$('.totalCompare-mb').text(numitem);

		//ajax post: add product in ther cart
		var urlrequest=_domain+'/add-compare';
		var json_parementer={idproduct : idproduct};
        var dataResult=postAjax(urlrequest,json_parementer);
	});
});