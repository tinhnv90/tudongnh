@extends('Layout')
@section('title','Đăng Nhập')
@section('description','Trang Đăng Ký Và Đang Nhập')
@section('keywords','Đăng Ký, Đăng Nhập, Login, Register ')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$style.'user.css'}}">
@stop
@section('javascript')
<script>
	$(document).ready(function(){
		$("input[name='provision']").click(function(){
			if($(this).prop('checked')){
				$("button[name='btnregister']").removeAttr('disabled').attr('title','Đăng Ký');
			}
			else{
				$("button[name='btnregister']").attr('disabled','disabled').attr('title','Bạn cần đọc và đồng ý các điều khoản');
			}
		});
	});
</script>
@stop
@section('content')
<?php $request=Request::all(); ?>
<div id="login" class="bor-box">
	<div class="title-page bor-b">
		<h3><p>Đăng Nhập</p></h3>
	</div>
	<div class="frame-login w100min">
		<form method="POST" action="{{asset('/dang-nhap')}}" class="w100min">
			{{csrf_field()}}
			<div class="w100min">
				<label>Tài Khoản :</label>
				<input type="text" name="email" placeholder="Email">
				@if($errors->has('email') && isset($request['btnlogin']))
					<span class="notification">{{$errors->first('email')}}</span>
				@endif
			</div>
			<div class="w100min">
				<label>Mật Khẩu :</label>
				<input type="password" name="password" placeholder="password">
				@if($errors->has('password') && isset($request['btnlogin']))
					<span class="notification">{{$errors->first('password')}}</span>
				@endif
			</div>
			<div class="w100min provision">
				<p>
					<a href="{{asset('/quen-mat-khau')}}" title="điều khoản">Quên Tài Khoản</a>
				</p>
				@if(session('fails'))
					<p class="login-fails">{{session('fails')}}</p>
				@endif
			</div>
			<div class="w100min btn">
				<button type="submit" name="btnlogin">Đăng Nhập</button>
			</div>
		</form>
	</div>
</div>
<div id="register" class="bor-box">
	<div class="title-page bor-b">
		<h3><p>Đăng Ký</p></h3>
	</div>
	<div class="frame-register w100min">
		<form method="POST" action="{{asset('/dang-ky')}}" class="w100min">
			{{csrf_field()}}
			<div class="w100min">
				<label>Tài Khoản<span class="red">*</span> :</label>
				<input type="text" name="email" placeholder="Email">
				@if($errors->has('email') && isset($request['btnregister']))
					<span class="notification">{{$errors->first('email')}}</span>
				@endif
			</div>
			<div class="w100min">
				<label>Mật Khẩu<span class="red">*</span> :</label>
				<input type="Password" name="password" placeholder="Password">
				@if($errors->has('password') && isset($request['btnregister']))
					<span class="notification">{{$errors->first('password')}}</span>
				@endif
			</div>
			<div class="w100min bor-b">
				<label>Nhắc Lại Mật Khẩu<span class="red">*</span> :</label>
				<input type="Password" name="password_confirmation" placeholder="RePassword">
				@if($errors->has('password_confirmation') && isset($request['btnregister']))
					<span class="notification">{{$errors->first('password_confirmation')}}</span>
				@endif
			</div>
			<div class="w100min">
				<label>Tên Hiển Thị :</label>
				<input type="text" name="name">
			</div>
			<div class="w100min">
				<label>Năm Sinh :</label>
				<input type="text" name="year" placeholder="{{date('Y')}}">
				@if($errors->has('year') && isset($request['btnregister']))
					<span class="notification">{{$errors->first('year')}}</span>
				@endif
			</div>
			<div class="w100min">
				<label>Số Điện Thoại<span class="red">*</span> :</label>
				<input type="text" name="phone" placeholder="vd: 0123456789">
				@if($errors->has('phone') && isset($request['btnregister']))
					<span class="notification">{{$errors->first('phone')}}</span>
				@endif
			</div>
			<div class="w100min">
				<label>Địa Chỉ :</label>
				<input type="text" name="adress">
			</div>

			<div class="w100min provision">
				<p>Đồng Ý <a href="{{asset('/dieu-khoan')}}" title="điều khoản">Điều Khoản</a> Dịch Vụ</p>
				<input type="checkbox" name="provision">
			</div>
			<div class="w100min btn">
				<button type="submit" name="btnregister" disabled title="Bạn cần đọc và đồng ý các điều khoản">Đăng Nhập</button>
			</div>
			<p class="note-register">Không được để trống mục có dấu <span class="red">*</span></p>
		</form>
	</div>
</div>
@stop