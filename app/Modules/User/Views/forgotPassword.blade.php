@extends('Layout')
@section('title','Quên Mật Khẩu')
@section('description','Trang lấy lại mật khẩu')
@section('keywords','lấy lại mật khẩu')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$style.'profile.css'}}">
@stop
@section('content')
<div id="content" class="w100min bor-box">
	<div class="title-page bor-b">
		<h3><p>LẤY LẠI MẬT KHẨU</p></h3>
	</div>
</div>
@include('User::left-category')
@stop