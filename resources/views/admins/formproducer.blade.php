@extends('admins.frameadmin')
@section('title','Nhà Sản Xuất')
@section('addlink','producer')
@section('titlepage','Thêm Bài Nhà Sản Xuất Mới')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{asset('/public/css/admin/producer.css')}}">
@stop
@section('frameImages')
	@include('admins.choosefileimages')
@stop
@section('container')
<form method="POST" action="{{asset('/admin/producer/'.$actionform)}}" 
	id="container-producer">
		<ul class="container-left">
			<li><label>Tên Nhà Sản Xuất :</label></li>
			<li><label>path URL : </label></li>
			<li class="row80"><label>Giới Thiệu :</li>
			<li class="row80"><label>Logo : </label></li>
			<li><label>Email : </label></li>
			<li><label>Số Điện Thoại : </label></li>
			<li class="row80"><label>Địa Chỉ : </label></li>
		</ul>
		<ul class="container-right">
			<li>{{csrf_field()}}
				<input type="text" name="nameproducer" 
				value="@if(isset($infoProducer)){{$infoProducer['nameProducer']}} @endif">
				@if($errors->has('nameproducer'))
					<p class="notifi">{{$errors->first('nameproducer')}}</p>
				@endif
			</li>
			<li>
				<input type="text" name="pathProducer" disabled 
				value="@if(isset($infoProducer)){{$infoProducer['pathProducer']}} @endif">
				<input type="text" name="pathProducer" hidden 
				value="@if(isset($infoProducer)){{$infoProducer['pathProducer']}} @endif">
				@if($errors->has('pathProducer'))
					<p class="notifi">{{$errors->first('pathProducer')}}</p>
				@endif
			</li>
			<li>
				<textarea name="contentproducer" rows="1" cols="1">@if(isset($infoProducer)){{$infoProducer['contentProducer']}} @endif</textarea>
			</li>
			<li>
				<img 
					@if(!isset($infoProducer)) src="{{asset('/public/images/icons/error-images.png')}}" 
					@else src="{{asset('/public').$infoProducer['srcImg']}}" 
					@endif class="openFileImages" name="txtidimg">
				<input type="text" name="txtidimg" hidden 
				value="@if(isset($infoProducer)){{$infoProducer['idImg']}} @else{{'242'}} @endif">
			</li>
			<li><input type="text" name="emailproducer" 
				value="@if(isset($infoProducer)){{$infoProducer['emailProducer']}} @endif">
			</li>
			<li><input type="text" name="phoneproducer" 
				value="@if(isset($infoProducer)){{$infoProducer['phoneProducer']}} @endif">
			</li>
			<li>
				<textarea name="adressproducer" rows="1" cols="1">@if(isset($infoProducer)){{$infoProducer['adressProducer']}} @endif</textarea>
			</li>
		</ul>
		<div  class="btsubmit w100min">
			<button type="submit" name="btnsubmit">Lưu</button>
		</div>
</form>
@stop