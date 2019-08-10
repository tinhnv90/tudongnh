@extends('Layout')
@section('title','Giỏ Hàng')
@section('description','Những sản phẩm bạn đã lựa chọn')
@section('keywords','Những sản phẩm bạn đã lựa chọn')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$style.'shopping.css'}}">
<link rel="stylesheet" type="text/css" href="{{$style.'left.css'}}">
@stop
@section('javascript')
<script src="{{$script.'cart.js'}}"></script>
@stop
@section('content')
<div id="content">
	<div id="conten-right">
		<div class="title-page">
			<h3>
				<span>GIỎ HÀNG</span>
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
				<?php $sumprice=0; $isprice=true;  ?>
				@foreach($listproduct as $key=>$product)
				<li class="w100min" data-idproduct="{{$product['idproduct']}}">
					<div class="col-index">
						<p>STT</p>
					</div>
					<div class="col-images">
						<img src="{{$dir.$product['get_images']['srcImg']}}" 
							alt="{{$product['get_images']['altImg']}}">
					</div>
					<div class="col-product">
						<h3>
							<a href="{{asset('/san-pham/'.$product['pathPro'])}}"
							title="{{$product['namePro']}}">{{$product['namePro']}}</a>
						</h3>
						<h4 class="bor-t">Mã Sản Phẩm :<span>{{$product['codepro']}}</span></h4>
						<div class="detail-product w100min">
							<p>Công Suất :<span>{{$product['get_detail']['poweCapacity']}}</span></p>
							<p>Kích Thước :<span>{{$product['get_detail']['size']}}</span></p>
							<p>Cân Nặng :<span>{{$product['get_detail']['weight']}}</span></p>
						</div>
					</div>
					<div class="col-number">
						<p>{{Session::get('productInTheCart.'.$product['idproduct'])[0]}}</p>
					</div>
					<div class="col-price">
						<p>@if($product['get_detail']['price']==0)Liên Hệ @else {{$product['get_detail']['price']}} @endif</p>
					</div>
					<div class="col-action">
						<p class="remove-cart" 
							data-idproduct="{{$product['idproduct']}}">x</p>
					</div>
				</li>
				<?php 
					$sumprice+=$product['get_detail']['price'];
					if ($product['get_detail']['price']==0)
						$isprice=false;	
				?>
				@endforeach
			</ul>
			<div class="w100min">
				<h3 class="sumprice">Tổng Thành Tiền : <span class="color-red">{{$sumprice}}</span> vnđ</h3>
			</div>
		</div>
		<div class="w100min payment">
			<div class="title-page">
				<h3>
					<span class="active-payment @if(!Auth::check())payment-login @endif">ĐẶT HÀNG <i class="fas fa-caret-down"></i>
					</span>
					<p>Cập Nhật Thông Tin Đặt Hàng</p>
				</h3>
			</div>
			@if(Auth::check())
			<?php $user=Auth::user(); ?>
			<div class="content w100min hidden">
				<form action="{{asset('/dat-hang')}}" method="POST" class="frmorder">
					{{csrf_field()}}
					<input type="text" name="iduser" value="{{$user->id}}" hidden>
					<input type="text" name="sumprice" value="{{$sumprice}}" hidden>
					<div class="w100min">
						<label>Mã Hóa Đơn :</label>
						<input type="text" name="codeinvoice" 
							value="@if(isset($tblinvoice)){{$tblinvoice['code']}} @endif" disabled>
						<input type="text" name="codeinvoice" 
							value="@if(isset($tblinvoice)){{$tblinvoice['code']}} @endif" hidden>
					</div>
					<div class="w100min">
						<label>Người Nhận <span class="color-red">*</span> :</label>
						<input type="text" name="username" 
							value="@if(isset($tblinvoice)){{$tblinvoice['recipientName']}}@else{{$user->name}}@endif">
						@if($errors->has('username'))
							<span class="color-tomato">{{$errors->first('username')}}</span>
						@endif
					</div>
					<div class="w100min">
						<label>Số Điện Thoại <span class="color-red">*</span> :</label>
						<input type="text" name="phone" 
							value="@if(isset($tblinvoice)){{$tblinvoice['recipientPhone']}}@else{{$user->phone}}@endif">
						@if($errors->has('phone'))
							<span class="color-tomato">{{$errors->first('phone')}}</span>
						@endif
					</div>
					<div class="w100min">
						<label>Địa Chỉ Nhận Hàng <span class="color-red">*</span> :</label>
						<input type="text" name="adress_order" 
							value="@if(isset($tblinvoice)){{$tblinvoice['recipientAdress']}}@else{{$user->adress}}@endif">
						@if($errors->has('adress_order'))
							<span class="color-tomato">{{$errors->first('adress_order')}}</span>
						@endif
					</div>
					<div class="w100min" style="text-align: center;">
						<button type="submit" name="btnorder">
						@if(isset($tblinvoice))
							Cập Nhập
						@else
							Đặt Hàng
						@endif
						</button>
					</div>
				</form>
			</div>
			@endif
		</div>
		@else
			<p class="color-tomato">Giỏ hàng của bạn hiện không có sản phẩm nào</p>
		@endif
	</div>
	<div id="left" class="bor-box">
		@include('left.category')
		@include('left.box-face')
		@include('left.special-product')
	</div>
</div>
@stop