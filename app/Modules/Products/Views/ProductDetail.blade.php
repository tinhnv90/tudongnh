@extends('Layout')
@section('title'){{$infoProduct['get_seo']['metaTag']}}@stop
@section('description'){{$infoProduct['get_seo']['description']}}@stop
@section('keywords'){{$infoProduct['get_seo']['keyword']}}@stop
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$style.'product-detail.css'}}">
@stop
@section('javascript')
<script src="{{$script.'jquery.zoom.js'}}"></script>
<script>
	$(document).ready(function(){
		$('#images>.zoom').zoom({magnify:2});
		$('#list-images img').click(function(){
			$('#images>.zoom img').attr('src',$(this).attr('src'));
		});
	});
</script>
@stop
@section('meta-face')
<meta property="og:image"       
	content="{{$dir.$infoProduct['get_images']['srcImg']}}" />
<meta property="og:image:alt" content="{{$infoProduct['get_images']['altImg']}}"/>
<meta property="og:image:width" content="500px"/>
<meta property="og:image:height" content="554px"/>
@stop
@section('content')
<div id="content" class="w100min">
	<div id="product-detail" class="w100min">
		<div class="left bor-box">
			<div id="images" class="wh100">
				<div class="wh100 zoom bor-b" magnify="2">
					<img src="{{$dir.$infoProduct['get_images']['srcImg']}}" 
						 alt="{{$infoProduct['get_images']['altImg']}}">
				</div>
			</div>
			<div id="list-images" class="w100min">
				<ul class="wh100">
					<li><img src="{{$dir.$infoProduct['get_images']['srcImg']}}"
						alt="{{$infoProduct['get_images']['altImg']}}"></li>
					@if(isset($listimages))
					@foreach($listimages as $moreimg)
						<li>
							<img src="{{$dir.$moreimg['srcImg']}}"
								alt="{{$moreimg['altImg']}}">
						</li>
					@endforeach
					@endif
				</ul>
			</div>
		</div>
		<div class="content">
			<div id="information" class="wh100">
				<div class="title-page">
					<h3>
						<span>{{$infoProduct['namePro'].' - '.$infoProduct['idproduct']}}</span>
					</h3>
				</div>
				<div class="product-rating bor-t bor-b">
					<div class="rating">
						<i class="fas fa-star star1"></i>
						<i class="fas fa-star star2"></i>
						<i class="fas fa-star star3"></i>
						<i class="fas fa-star star4"></i>
						<i class="fas fa-star-half-alt star5"></i>
					</div>
					<p>{{$infoProduct['numview']}} Đánh Giá<span>|</span>Viết Đánh Giá</p>
				</div>
				<div id="detai" class="w100min">
					<h3 class="w100min">
						<p>Mã Sản Phẩm : </p>
						<span>{{$infoProduct['codepro']}}</span>
					</h3>
					<h3 class="w100min">
						<p>Kích Thước : </p>
						<span>{{$infoProduct['get_detail']['size']}} cm</span>
					</h3>
					<h3 class="w100min">
						<p>Trọng Lượng : </p>
						<span>{{$infoProduct['get_detail']['weight']}} Kg</span>
					</h3>
					<h3 class="w100min">
						<p>Công Suất : </p>
						<span>{{$infoProduct['get_detail']['poweCapacity']}} Kw/h</span>
					</h3>
					<h3 class="w100min">
						<p>Sản Phẩm Đã Bán : </p>
						<span>{{$infoProduct['get_detail']['sold']}} Sản Phẩm</span>
					</h3>
				</div>
				<div id="product-price" class="w100min bor-b">
					<h1>Giá Bán :<span>Liên Hệ</span></h1>
				</div>
				<div id="shopping-cart" class="w100min" 
					data-id="{{$infoProduct['idproduct']}}">
					<div class="col35 number">
						<p>Số Lượng :</p>
						<input type="text" class="productNumber" value="1">
					</div>
					<div class="col50 cart" 
						data-idproduct="{{$infoProduct['idproduct']}}">
						@if(Session::has('productInTheCart') && Session::has('productInTheCart.'.$infoProduct['idproduct']))
							<h4 class="add-cart bor-box bkg-addcart" 
								data-price="{{$infoProduct['get_detail']['price']}}">Hủy</h4>
						@else
							<h4 class="add-cart bor-box" 
								data-price="{{$infoProduct['get_detail']['price']}}">Mua Hàng</h4>
						@endif

						@if(Session::has('productInTheCompare') && Session::has('productInTheCompare.'.$infoProduct['idproduct']))
							<span class="add-compare color-active">
								<i class="fas fa-subscript"></i>
							</span>
						@else
							<span class="add-compare">
								<i class="fas fa-retweet"></i>
							</span>
						@endif

						@if(Session::has('productInTheWishlist') && Session::has('productInTheWishlist.'.$infoProduct['idproduct']))
						<span class="add-wishlist color-active">
						@else
						<span class="add-wishlist">
						@endif
							<i class="fas fa-heart"></i>
						</span>
					</div>
				</div>
				<div id="social-network" class="w100min">
					<div class="fb-like" data-href="{{url()->current()}}" data-width="" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
				</div>
				<ul id="tags" class="w100min">
					<li class="first">
						<h3>Tags : </h3>
					</li>
					@if(isset($listTags))
					@foreach($listTags as $key=>$tags)
					<li>
						@if($key>0)<span>|</span>@endif
						<a href="{{asset('/search/'.$tags)}}" 
							title="{{$tags}}">{{$listTags_text[$key]}}</a>
					</li>
					@endforeach
					@endif
				</ul>
			</div>
		</div>
	</div>
	<div id="product-content" class="w100min">
		<div class="title-page">
			<h3>
				<span>MÔ TẢ SẢN PHẨM</span>
			</h3>
		</div>
		<div class="container">
			<?php echo $infoProduct['contentPro']; ?>
		</div>
		<div class="related-product w100min">
			<div class="title-page">
				<h3>
					<span>SẢN PHẨM LIÊN QUAN</span>
				</h3>
			</div>
			<?php $numberColumn=6;$listproducts=$listRelatedProduct ?>
			@include('Products::ListProducts')
		</div>
	</div>
	<div id="comment" class="w100min">
		<div class="title-page">
			<h3>
				<span>BÌNH LUẬN</span>
			</h3>
		</div>
		<div class="content w100min">
			<div class="war-comment">
				<div class="fb-comments" 
					data-href="{{url()->current()}}" 
					data-width="100%" 
					data-numposts="5">
				</div>
			</div>
		</div>
	</div>
</div>
@stop