@extends('Layout')
@section('title','Thông tin khách hàng')
@section('description','Trang quản lý thông tin khách hàng')
@section('keywords','hồ sơ khách hàng')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$style.'profile.css'}}">
@stop
@section('content')
@include('User::login-left')
<div id="content" class="w100min bor-box">
	<div class="title-page bor-b">
		<h3><p>THÔNG TIN TÀI KHOẢN</p></h3>
	</div>
</div>
@stop