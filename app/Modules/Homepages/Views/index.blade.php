@extends('Layout')
@section('title')Tủ Đông Inox Nhà Hàng @stop
@section('description')Tủ Đông Inox Nhà Hàng @stop
@section('keywords')Tủ Đông Inox Nhà Hàng @stop
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$style.'home.css'}}">
<link rel="stylesheet" type="text/css" href="{{$style.'left.css'}}">
@stop
@section('javascript')
<script src="{{$script.'home.js'}}"></script>
@stop
@section('content')
<div id="content" class="w100min">
	<div id="pav-slideshow" class="w100min">
		<div class="left">
			@include('Homepages::left.specialArticle')
		</div>
		<div class="container">
			@include('Homepages::container.slideshow')
		</div>
	</div>
	@include('Homepages::container.product-mostview')
	<div id="content-body" class="w100min">
		<div class="left">
			<div class="service row190">
				<div class="left-top">
					<i class="fas fa-globe-americas"></i>
				</div>
				<div class="left-content">
					<h3 class="bor-b">GIAO HÀNG TOÀN QUỐC</h3>
					<h4>Liên hệ với chúng tôi để biết chi phí vận chuyển</h4>
				</div>
			</div>
			<div class="service row190">
				<div class="left-top">
					<i class="fas fa-truck"></i>
				</div>
				<div class="left-content">
					<h3 class="bor-b">MIỄN PHÍ VẬN CHUYỂN</h3>
					<h4>Miễn phí giao hàng trong nội thành Hà Nội</h4>
				</div>
			</div>
			<div class="service row190">
				<div class="left-top">
					<i class="fas fa-truck"></i>
				</div>
				<div class="left-content">
					<h3 class="bor-b">CHÍNH SÁCH NHẬN HÀNG</h3>
					<h4>Kiểm Tra Hàng, Nhận Hàng Trước Khi Thanh Toán</h4>
				</div>
			</div>
			<div class="service row190">
				<div class="left-top">
					<i class="fas fa-phone-alt"></i>
				</div>
				<div class="left-content">
					<h3 class="bor-b">HOTLINE 24/7</h3>
					<h4>A.Cường: 0943 148 666<br>A.Dương: 0969 578 901</h4>
				</div>
			</div>
			<div class="service row190">
				<div class="left-top">
					<i class="fas fa-lock"></i>
				</div>
				<div class="left-content">
					<h3 class="bor-b">GIAO DỊCH AN TOÀN</h3>
					<img class="first" src="{{$icons.'card-vietcombank.jpg'}}" alt="Thẻ ngân hàng vietcombank">
					<img src="{{$icons.'cart-techcombank.png'}}" alt="Thẻ ngân hàng techcombank">
				</div>
			</div>
		</div>
		<div class="container">
			@include('Homepages::container.war-banner')
			<?php $listproducts=$listProductOfCategory['listproduct'];$numberColumn=4; ?>
			@include('Products::category')
		</div>
	</div>
	<div id="post-mostview" class="w100min">
		@include('Homepages::container.post-mostview')
	</div>
</div>
@stop