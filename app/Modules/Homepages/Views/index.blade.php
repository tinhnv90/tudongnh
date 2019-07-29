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
					@if(isset($listmainleft))
					<h3 class="bor-b">{{$listmainleft[0]['descript']}}</h3>
					<h4>{{$listmainleft[0]['value']}}</h4>
					@else
					<h3 class="bor-b">GIAO HÀNG TOÀN QUỐC</h3>
					<h4>Liên hệ với chúng tôi để biết chi phí vận chuyển</h4>
					@endif
				</div>
			</div>
			<div class="service row190">
				<div class="left-top">
					<i class="fas fa-truck"></i>
				</div>
				<div class="left-content">
					@if(isset($listmainleft))
					<h3 class="bor-b">{{$listmainleft[1]['descript']}}</h3>
					<h4>{{$listmainleft[1]['value']}}</h4>
					@else
					<h3 class="bor-b">GIAO HÀNG TOÀN QUỐC</h3>
					<h4>Liên hệ với chúng tôi để biết chi phí vận chuyển</h4>
					@endif
				</div>
			</div>
			<div class="service row190">
				<div class="left-top">
					<i class="fas fa-truck"></i>
				</div>
				<div class="left-content">
					@if(isset($listmainleft))
					<h3 class="bor-b">{{$listmainleft[2]['descript']}}</h3>
					<h4>{{$listmainleft[2]['value']}}</h4>
					@else
					<h3 class="bor-b">GIAO HÀNG TOÀN QUỐC</h3>
					<h4>Liên hệ với chúng tôi để biết chi phí vận chuyển</h4>
					@endif
				</div>
			</div>
			<div class="service row190">
				<div class="left-top">
					<i class="fas fa-phone-alt"></i>
				</div>
				<div class="left-content">
					@if(isset($listmainleft))
					<h3 class="bor-b">{{$listmainleft[3]['descript']}}</h3>
					<h4>{{$listmainleft[3]['value']}}</h4>
					@else
					<h3 class="bor-b">GIAO HÀNG TOÀN QUỐC</h3>
					<h4>Liên hệ với chúng tôi để biết chi phí vận chuyển</h4>
					@endif
				</div>
			</div>
			<div class="service row190">
				<div class="left-top">
					<i class="fas fa-lock"></i>
				</div>
				<div class="left-content">
					@if(isset($listmainleft))
					<h3 class="bor-b">{{$listmainleft[4]['descript']}}</h3>
					@else
					<h3 class="bor-b">GIAO DỊCH AN TOÀN</h3>
					@endif
					<img class="first" src="{{$icons.'card-vietcombank.jpg'}}" alt="Thẻ ngân hàng vietcombank">
					<img src="{{$icons.'cart-techcombank.png'}}" alt="Thẻ ngân hàng techcombank">
				</div>
			</div>
		</div>
		<div class="container">
			@include('Homepages::container.war-banner')
			<?php $numberColumn=4; ?>
			@include('Product.Category')
		</div>
	</div>
	<div id="post-mostview" class="w100min">
		@include('Homepages::container.post-mostview')
	</div>
</div>
@stop