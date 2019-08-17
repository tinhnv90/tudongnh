@extends('Layout')
@section('title','Thông tin khách hàng')
@section('description','Trang quản lý thông tin khách hàng')
@section('keywords','hồ sơ khách hàng')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$style.'profile.css'}}">
<link rel="stylesheet" type="text/css" href="{{$style.'myaccount.css'}}">
@stop
@section('content')
<div id="content" class="w100min bor-box">
	<div class="title-page bor-b">
		<h3><p>THÔNG TIN CƠ BẢN</p></h3>
	</div>
	<div class="w100min content-account">
		<p class="recommend bor-b">Bạn có thể cập nhật những thông tin của tài khoản ở biểu mẫu dưới đây</p>
		<form method="POST" action="{{asset('/tai-khoan')}}">
			{{csrf_field()}}
			<div class="w100min">
				<label>Tên Hiển Thị :</label>
				<input type="text" name="name" value="{{$users->name}}">
			</div>
			<div class="w100min">
				<label>Email :</label>
				<input type="text" name="name" value="{{$users->email}}" disabled>
			</div>
			<div class="w100min">
				<label>Giới Tính :</label>
				<input type="radio" name="sex" value="male" 
					@if($users->sex=="male")checked @endif> Nam
				<input type="radio" name="sex" value="famale" 
					@if($users->sex=="famale")checked @endif> Nữ
			</div>
			<div class="w100min">
				<label>Năm Sinh :</label>
				<input type="text" name="year" value="{{$users->year}}">
			</div>
			<div class="w100min">
				<label>Số Điện Thoại<span class="color-tomato">*</span> :</label>
				<input type="text" name="phone" value="{{$users->phone}}">
				@if($errors->has('phone'))
					<p class="notification">{{$errors->first('phone')}}</p>
				@endif
			</div>
			<div class="w100min">
				<label>Địa Chỉ :</label>
				<input type="text" name="adress" value="{{$users->adress}}">
			</div>
			<div class="submti">
				<button type="submit" name="update_myaccount">Cập Nhật</button>
			</div>
		</form>
		<p class="recommend bor-b">Thay Đổi Mật Khẩu</p>
		<form method="POST" action="{{asset('/tai-khoan')}}">
			{{csrf_field()}}
			<div class="w100min">
				<label>Mật Khẩu Cũ<span class="color-tomato">*</span> :</label>
				<input type="password" name="password_old">
				@if($errors->has('password_old'))
					<p class="notification">{{$errors->first('password_old')}}</p>
				@endif
				@if(isset($noteExistsPass))
					<p class="notification">{{$noteExistsPass}}</p>
				@endif
			</div>
			<div class="w100min">
				<label>Mật Khẩu Mới<span class="color-tomato">*</span> :</label>
				<input type="password" name="password">
				@if($errors->has('password'))
					<p class="notification">{{$errors->first('password')}}</p>
				@endif
			</div>
			<div class="w100min">
				<label>Nhắc Lại Mật Khẩu<span class="color-tomato">*</span> :</label>
				<input type="password" name="password_confirmation">
				@if($errors->has('password_confirmation'))
					<p class="notification">
						{{$errors->first('password_confirmation')}}
					</p>
				@endif
			</div>
			<div class="submti">
				<button type="submit" name="update_password">Cập Nhật</button>
			</div>
		</form>
	</div>
</div>
@include('User::left-category')
@stop