@extends('Layout')
@section('title','Lịch Sử Mua Hàng')
@section('description','Trang lịch sử mua hàng')
@section('keywords','Lịch sử mua hàng')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$style.'profile.css'}}">
@stop
@section('content')
<div id="content" class="w100min bor-box">
	<div class="title-page bor-b">
		<h3><p>LỊCH SỬ MUA HÀNG</p></h3>
	</div>
</div>
@include('User::left-category')
@stop