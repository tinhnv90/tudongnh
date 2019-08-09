@extends('Layout')
@section('title','Thanh Toán')
@section('description','Trang thanh toán đơn hàng')
@section('keywords','thanh toán đơn hàng')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$style.'profile.css'}}">
<link rel="stylesheet" type="text/css" href="{{$style.'payment.css'}}">
@stop
@section('javascript')
<script>
	$(document).ready(function(){
		$('.bankplus>div>img').click(function(){
			var url=window.location.origin+'/tudongnh/'+$(this).attr('title');
			$.ajaxSetup({headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}});
			$.ajax({
	            type : 'POST',
	            url  : url,
	            success :  function(data){
	            }
	        });
		});
	});
</script>
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
		<div class="title-page">
			<h3><span>HÌNH THỨC THANH TOÁN</span></h3>
		</div>
		<div class="w100min bankplus bor-b">
			<div class="shipcod col33">
				<span class="frameimg">
					Thanh Toán Tiền Khi Nhận Hàng
				</span>
				<span class="w100min">
					<input type="radio" name="bankplus" 
						value="shipcod" checked> Ship COD
				</span>
			</div>
			<div class="viettinbank col33">
				<img src="{{asset('/public/images/icons/card-vietcombank.jpg')}}" 
					alt="Ngân Hàng Viettinbank" title="viettinbank">
				<span class="w100min">
					<input type="radio" name="bankplus" 
						value="viettinbank"> Viettinbank
				</span>
			</div>
			<div class="techcombank col33">
				<img src="{{asset('/public/images/icons/cart-techcombank.png')}}" 
					alt="Ngân hàng Techcombank" title="techcombank">
				<span class="w100min">
					<input type="radio" name="bankplus" 
						value="techcombank"> Techcombank
				</span>
			</div>
		</div>
		<div class="w100min">
			<div class="payment_active">
				<div class="w100min">
					<label>Số Thẻ :</label>
					<input type="text" name="cardNumber" placeholder="Gồm 16 hoặc 19 số không dấu không dấu '-'">
				</div>
				<div class="w100min">
					<label>Ngày Phát Hành :</label>
					<input type="text" name="month" placeholder="Tháng">
					<span class="slash">/</span>
					<input type="text" name="year" placeholder="Năm">
				</div>
				<div class="w100min">
					<label>Tên In Trên Thẻ :</label>
					<input type="text" name="nameCard">
				</div>
			</div>
		</div>
		<div class="w100min btnpayment">
			<button type="submit" name="btnpayment">Thanh Toán</button>
		</div>
	</form>
	<div class="w100min">
		<p class="note">Đơn đặt hàng sẽ bị hủy trong vòng 24h nếu bạn chưa thực hiện thanh toán</p>
	</div>
	</div>
	@else
		<p class="note">Bạn chưa có đơn đặt hàng nào cần thanh toán trong ngày {{date('d/m/Y')}}</p>
	@endif
</div>
@include('User::left-category')
@stop