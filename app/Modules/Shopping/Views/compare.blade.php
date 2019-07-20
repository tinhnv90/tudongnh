@extends('Layout')
@section('title','So sánh sản phẩm')
@section('description','So sánh sản phẩm')
@section('keywords','So sánh sản phẩm')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$style.'shopping.css'}}">
<link rel="stylesheet" type="text/css" href="{{$style.'left.css'}}">
@stop
@section('javascript')
<script>
	$(document).ready(function(){
		$('.remove-compare').click(function(){
			$.ajaxSetup({headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}});
			$.ajax({
	            type : 'POST',
	            url  : window.location.origin+'/tudongnh/remove-compare',
	            data : {idproduct:$(this).attr('data-idproduct')},
	            success :  function(data){
	                $('li[data-idproduct="'+data.result+'"]').remove();
	            }
	        });
		});
	});
</script>
@stop
@section('content')
<div id="content">
	<div id="conten-right">
		<div class="title-page">
			<h3>
				<span>SO SÁNH SẢN PHẨM</span>
			</h3>
		</div>
		@if(isset($listproduct))
		<div class="container w100min cart">
			<div class="w100min title-table">
				<div class="col-index">
					<p>STT</p>
				</div>
				<div class="col-images">
					<p>Ảnh</p>
				</div>
				<div class="col-product">
					<p>Sản Phẩm</p>
				</div>
				<div class="col-number">
					<p>Số Lượng</p>
				</div>
				<div class="col-price">
					<p>Giá</p>
				</div>
				<div class="col-action">
					<p>Thao Tác</p>
				</div>
			</div>
			<ul class="w100min">
				@foreach($listproduct as $product)
				<li class="w100min" data-idproduct="{{$product['idproduct']}}">
					<div class="col-index">
						<p>STT</p>
					</div>
					<div class="col-images">
						<img src="{{$dir.$product['get_images']['srcImg']}}" 
							alt="{{$product['get_images']['altImg']}}">
					</div>
					<div class="col-product">
						<h3>{{$product['namePro']}}</h3>
						<h4>Mã Sản Phẩm :<span>{{$product['codepro']}}</span></h4>
						<div class="detail-product w100min">
							<p>Công Suất :<span>{{$product['get_detail']['poweCapacity']}}</span></p>
							<p>Kích Thước :<span>{{$product['get_detail']['size']}}</span></p>
							<p>Cân Nặng :<span>{{$product['get_detail']['weight']}}</span></p>
						</div>
					</div>
					<div class="col-number">
						<p>{{$product['get_detail']['number']}}</p>
					</div>
					<div class="col-price">
						<p>@if($product['get_detail']['price']==0)Liên Hệ @else {{$product['get_detail']['price']}} @endif</p>
					</div>
					<div class="col-action">
						<p class="remove-compare" 
							data-idproduct="{{$product['idproduct']}}">x</p>
					</div>
				</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
	<div id="left" class="bor-box">
		@include('left.category')
		@include('left.category')
		@include('left.category')
	</div>
</div>
@stop