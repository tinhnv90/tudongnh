@extends('admins.frameadmin')
@section('title','Nhà Sản Xuất')
@section('addlink','producer')
@section('titlepage','Danh Sách Nhà Sản Xuất')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{asset('/public/css/admin/producer.css')}}">
@stop
@section('container')
<form method="get" action="{{asset('/')}}" id="container-form-producer" class="w100min">
		<ul class="w100min">
			<li class="w100min">
				<div>
					<input type="checkbox" name="subcategory" value="id" id="checkbox-all">
				</div>
				<p>Logo</p>
				<p class="w50-235">Tên NSX</p>
				<p class="w50-35">Liên Hệ</p>
				<p>Theo Tác</p>
			</li>
			@foreach($listproducer as $producer)
			<li class="w100min row150">
				<div class="chk-producer">
					<input type="checkbox" name="subcategory" 
						value="{{$producer['idProducer']}}" class="checkbox-record">
				</div>
				<div class="logo-producer"><img src="{{asset('/public'.$producer['srcImg'])}}"></div>
				
				<div class="name-producer w50-235">
					<h4>{{$producer['nameProducer']}}</h4>
				</div>
				<div class="contact-producer w50-35">
					<p>- Email: {{$producer['emailProducer']}}</p>
					<p>- Phone: {{$producer['phoneProducer']}}</p>
					<p title="- Địa Chỉ: {{$producer['adressProducer']}}">
						- Địa Chỉ: {{$producer['adressProducer']}}</p>
				</div>
				<div class="action-producer">
					<a href="{{asset('/admin/producer/edit/'.$producer['pathProducer'])}}">
						<img src="{{asset('/public/images/icons/edit-512.png')}}"
							title="edit">
					</a>
				</div>
			</li>
			@endforeach
		</ul>
</form>
@stop