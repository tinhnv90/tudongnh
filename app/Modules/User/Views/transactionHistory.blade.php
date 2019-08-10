@extends('Layout')
@section('title','Lịch Sử Mua Hàng')
@section('description','Trang lịch sử mua hàng')
@section('keywords','Lịch sử mua hàng')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$style.'profile.css'}}">
<link rel="stylesheet" type="text/css" href="{{$style.'transactionhistory.css'}}">
@stop
@section('content')
<div id="content" class="w100min bor-box">
	<div class="title-page bor-b">
		<h3><p>LỊCH SỬ MUA HÀNG</p></h3>
	</div>
	<div id="history" class="w100min">
		@if(isset($listinvoice))
		@foreach($listinvoice as $invoice)
			<div class="w100min">
				<h3 class="invoice-code w100min">MÃ HÓA ĐƠN : {{$invoice['code']}}
					<span class="invoice-date">
						<i class="fas fa-angle-double-right"></i>
						{{date("m-d-Y", strtotime($invoice['created_at']))}}
					</span>
					@if($invoice['paid']==0)
						<a class="paid" href="{{asset('/thanh-toan')}}" title="Thanh toán hóa đơn">
							<span>Thanh Toán</span>
							<i class="fas fa-angle-double-right"></i>
						</a>
					@endif
				</h3>
				@if(count($invoice['get_detail'])>0)
				<ul class="w100min product">
					<li>
						<p class="name bor-box">Tên Sản Phẩm</p>
						<p class="code bor-box">Mã Sản Phẩm</p>
						<p class="number bor-box">Số Lượng</p>
					</li>
					@foreach($invoice['get_detail'] as $detail)
					<?php $product=$detail['get_product'] ?>
					<li>
						<p class="name bor-box">{{$product['namePro']}}</p>
						<p class="code bor-box">{{$product['codepro']}}</p>
						<p class="number bor-box">{{$detail['number']}}</p>
					</li>
					@endforeach
				</ul>
				@endif
			</div>
		@endforeach
		@endif
	</div>
</div>
@include('User::left-category')
@stop