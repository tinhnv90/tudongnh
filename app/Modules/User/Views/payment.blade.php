@extends('Layout')
@section('title','Thanh Toán')
@section('description','Trang thanh toán đơn hàng')
@section('keywords','thanh toán đơn hàng')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$style.'profile.css'}}">
@stop
@section('content')
@include('User::login-left')
<div id="content" class="w100min bor-box">
	<div class="title-page bor-b">
		<h3><p>THANH TOÁN ĐƠN HÀNG</p></h3>
	</div>
</div>
@stop