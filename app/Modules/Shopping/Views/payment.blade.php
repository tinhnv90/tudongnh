@extends('Layout')
@section('title','Thanh Toán')
@section('description','Trang thanh toán đơn hàng')
@section('keywords','thanh toán đơn hàng')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$style.'profile.css'}}">
<link rel="stylesheet" type="text/css" href="{{$style.'payment.css'}}">
@stop
@section('javascript')
<script src="{{$script.'payment.js'}}"></script>
@stop
@section('content')
<div id="content" class="bor-box">
	<div class="title-page bor-b">
		<h3><p>THANH TOÁN ĐƠN HÀNG</p></h3>
	</div>
	@if(isset($tblinvoice))
	<div class="w100min">
	<form method="POST" action="{{asset('/thanh-toan')}}" class="w100min">
		{{csrf_field()}}
		<div class="title-page">
			<h3><span>CHI TIẾT ĐƠN HÀNG</span></h3>
		</div>
		<div class="w100min invoice">
			<div class="w100min">
				<p>Tên Khách Hàng :</p>
				<h4>{{Auth::user()->name}}</h4>
			</div>
			<div class="w100min">
				<p>Tên Người Nhận :</p>
				<h4>{{$tblinvoice['recipientName']}}</h4>
			</div>
			<div class="w100min">
				<p>Số Điện Thoại :</p>
				<h4>{{$tblinvoice['recipientPhone']}}</h4>
			</div>
			<div class="w100min">
				<p>Địa Chỉ Giao Hàng :</p>
				<h4>{{$tblinvoice['recipientAdress']}}</h4>
			</div>
			<div class="w100min">
				<p>Giá Trị Đơn Hàng :</p>
				<h4>{{$tblinvoice['totalmoney']}} vnđ</h4>
			</div>
			<div class="w100min">
				<p>VAT(10%) :</p>
				<h4>{{$tblinvoice['totalmoney']*0.1}} vnđ</h4>
			</div>
			<div class="w100min">
				<p>Tổng Thành tiền :</p>
				<?php $summoney=$tblinvoice['totalmoney']*0.1+
						$tblinvoice['totalmoney']; ?>
				<h4>{{$summoney}} vnđ</h4>
				<input type="text" name="totalmoney" value="{{$summoney}}" hidden>
			</div>
		</div>

		<!--________________HÌNH THỨC THANH TOÁN___________________-->
		<div class="title-page">
			<h3><span>HÌNH THỨC THANH TOÁN</span></h3>
		</div>
		<div class="w100min payment_type bor-b">
			<div class="shipcod col33">
				<span class="frameimg">
					Thanh Toán Tiền Khi Nhận Hàng
				</span>
				<span class="w100min">
					<input type="radio" name="payment_type" 
						value="shipcod" checked> Ship COD
				</span>
			</div>
			<div class="viettinbank col33">
				<img src="{{asset('/public/images/icons/card-vietcombank.jpg')}}" 
					alt="Ngân Hàng Viettinbank" title="viettinbank">
				<span class="w100min">
					<input type="radio" name="payment_type" 
						value="viettinbank"> Viettinbank
				</span>
			</div>
			<div class="techcombank col33">
				<img src="{{asset('/public/images/icons/cart-techcombank.png')}}" 
					alt="Ngân hàng Techcombank" title="techcombank">
				<span class="w100min">
					<input type="radio" name="payment_type" 
						value="techcombank"> Techcombank
				</span>
			</div>
		</div>
		<div class="w100min payment-form">
			<div class="payment-shipcod w100min">
				<h2>Hình Thức Thanh Toán Ship COD - Nhận Hàng xong mới thanh toán</h2>
				<p>Bạn cần đặt cọc tối thiểu 30% tổng giá trị đơn hàng.</p>
				<p>số còn lại sẽ được thanh toán cho bên đơn vị vận chuyển hộ</p>
			</div>
		</div>
		

		

		<!--_______________BUTTON THANH TOÁN___________________-->
		<div class="title-page">
			<h3><span>THANH TOÁN</span></h3>
		</div>
		<div class="w100min btnpayment">
			<p class="note">* GIÁ TRÊN CHƯA BAO GỒM TRI PHÍ VẬN CHUYỂN NẾU CÓ.</p>

			<button type="submit" name="btnpayment" 
			@if($tblinvoice['totalmoney']==0 || !Session::has('productInTheCart')) disabled @endif>Thanh Toán</button>
			<!--<button type="submit" name="btnpayment">Thanh Toán</button>-->
		</div>
	</form>
	<div class="w100min noted">
		@if(!Session::has('productInTheCart'))
			<p class="note">* Đơn hàng của bạn chưa có sản phẩm nào!</p>
		@elseif($tblinvoice['totalmoney']==0)
			<p class="note">* Trong giỏ hàng của bạn có sản phẩm chưa được liêm yết giá. bạn cần liên hệ với cửa hàng để cập nhật giá sản phẩm</p>
		@endif
		<p class="note">* Đơn đặt hàng sẽ bị hủy trong vòng 24h nếu bạn chưa thực hiện thanh toán.</p>
	</div>
	</div>
	@else
		<p class="note">* Bạn chưa có đơn đặt hàng nào cần thanh toán trong ngày {{date('d/m/Y')}}</p>
	@endif
</div>
@include('User::left-category')
@stop