@extends('Layout')
@section('title','Đăng Nhập')
@section('description','Trang Đăng Ký Và Đang Nhập')
@section('keywords','Đăng Ký, Đăng Nhập, Login, Register ')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$style.'user.css'}}">
@stop
@section('content')
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
			</div>
			<div class="w100min">
				<label>Mật Khẩu :</label>
				<input type="Password" name="pasword" placeholder="Password">
			</div>
			<div class="w100min provision">
				<p><a href="{{asset('/mat-khau')}}" title="điều khoản">Quên Tài Khoản</a></p>
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
			</div>
			<div class="w100min">
				<label>Mật Khẩu<span class="red">*</span> :</label>
				<input type="Password" name="pasword" placeholder="Password">
			</div>
			<div class="w100min bor-b">
				<label>Nhắc Lại Mật Khẩu<span class="red">*</span> :</label>
				<input type="Password" name="repassword" placeholder="Password">
			</div>
			<div class="w100min">
				<label>Tên Hiển Thị :</label>
				<input type="text" name="name">
			</div>
			<div class="w100min">
				<label>Số Điện Thoại :</label>
				<input type="text" name="phone">
			</div>
			<div class="w100min">
				<label>Địa Chỉ :</label>
				<input type="text" name="adress">
			</div>

			<div class="w100min provision">
				<p>Đồng Ý <a href="{{asset('/dieu-khoan')}}" title="điều khoản">Điều Khoản</a> Dịch Vụ</p>
				<input type="checkbox" name="dieukhoan">
			</div>
			<div class="w100min btn">
				<button type="submit" name="btnregister">Đăng Nhập</button>
			</div>
			<p class="note-register">Không được để trống mục có dấu <span class="red">*</span></p>
		</form>
	</div>
</div>
@stop