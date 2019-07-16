@extends('admins.frameadmin')
@section('title','Slide - Banner')
@section('addlink','product')
@section('titlepage','Banner Seting')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$styleAdmin.'banner.css'}}">
@stop
@section('frameImages')
  @include('admins.choosefileimages')
@stop
@section('container')
<ul id="nav-tag">
	<li>
		<p class="click-nav-tag-admin-menu" name='banner-seting'>Banner</p>
	</li>
	<li>
		<p name='slide-seting'>Slide</p>
	</li>
	<li>
		<p name='banner-service-seting'>Banner service</p>
	</li>
	<li>
		<p name='custom-banner'>Banner Custom</p>
	</li>
</ul>
<form action="{{asset('/admin/banner/edit')}}" method="post" 
		class="w100min" id="frmbanner">
		{{csrf_field()}}
<div class="w100min banner-seting nav-tag-seting">
	<ul id="tag-banner" class="w100min">
		<?php $key=0; ?>
		@foreach($listbanner as $banner)
		@if($banner['type']=='banner')
		<li>
			<div>
				<img name="idimg{{$key++}}" 
					src="{{asset('public'.$banner['srcImg'])}}" 
					alt="{{$banner['altImg']}}"
					class="openFileImages">
				<p class="w100min">{{$banner['nameBn']}}</p>
			</div>
		</li>
		@endif
		@endforeach
	</ul>
<?php
	$listslide=[];
	$listservice=[];
	$listcustom=[];
  $key=0;
?>
	@foreach($listbanner as $banner)
	@if($banner['type']=='slide')
		<?php $listslide[]=$banner; ?>
	@elseif($banner['type']=='service')
		<?php $listservice[]=$banner; ?>
	@elseif($banner['type']=='custom')
		<?php $listcustom[]=$banner; ?>
	@else
	<div class="tag-banner{{$key}} w100min">
		<ul class="title-banner">
			<li>Tên Banner :</li>
			<li>Link liên kết :</li>
			<li>Trạng Thái :</li>
		</ul>
		<ul class="input-banner">
			<input type="text" name="idbanner{{$key}}" 
				value="{{$banner['idbanner']}}" hidden>
			<input type="text" name="idimg{{$key}}" 
				value="{{$banner['idImg']}}" hidden>
			<li>
				<input type="text" name="namebanner{{$key}}" 
					value="{{$banner['nameBn']}}">
			</li>
			<li>
				<input type="text" name="pathBn{{$key}}" 
					value="{{$banner['pathBn']}}">
			</li>
			<li>
				<select name="statusBn{{$key++}}">
					<option @if($banner['status']==1) selected @endif value="1">Bật</option>
					<option @if($banner['status']==0) selected @endif value="0">Tắt</option>
				</select>
			</li>
		</ul>
	</div>
	@endif
	@endforeach
</div>
<div class="w100min slide-seting nav-tag-seting">
	<div id="show-slide" class="w100min">
		@if(count($listslide))
		<ul>
			@foreach($listslide as $slide)
			@if($slide['type']=='slide' && $slide['status']==1)
			<li>
				<img src="{{asset('/public'.$slide['srcImg'])}}">
			</li>
			@endif
			@endforeach
		</ul>
		@endif
	</div>
	<div class="seting-slide w100min">
		<div class="style-animation">
			<label>Kiểu Slide : </label>
			<select name="animation">
				@foreach($list_Style_Animation as $animation)
				<option @if($style_animation_selected==$animation['value']) selected @endif value="{{$animation['value']}}">{{$animation['value']}}</option>
				@endforeach
			</select>
		</div>
		<ul class="lislide w100min frame-record">
			<li name='0'>
				<div class="num-row"><p>STT</p></div>
				<div class="col-title"><p>Tiểu Đề</p></div>
				<div class="col-href"><p>Link Chỉ Tới</p></div>
				<div class="col-images"><p>Ảnh</p></div>
				<div class="col-status"><p>Trạng Thái</p></div>
			</li>
			@foreach($listslide as $key=>$slide)
			@if($slide['type']=='slide' && $slide['status']==1)
			<li name="{{(++$key)}}">
				<div class="num-row">
					<p>{{$key}}</p>
					<input type="text" name="idslide{{$key}}" value="{{$slide['idbanner']}}" hidden>
				</div>
				<div class="col-title">
					<input type="text" name="nameslide{{$key}}" 
						value="{{$slide['nameBn']}}">
				</div>
				<div class="col-href">
					<input type="text" name="pathslide{{$key}}" 
						value="{{$slide['pathBn']}}">
				</div>
				<div class="col-images">
					<img src="{{asset('/public'.$slide['srcImg'])}}" 
						alt="{{$slide['altImg']}}" 
						class="openFileImages slideseting"
						name="slide{{$key}}">
					<input type="text" name="slide{{$key}}" 
						value="{{$slide['idImg']}}" hidden>
				</div>
				<div class="col-status">
					<select name="status_slide{{$key}}">
						<option @if($slide['status']==1)selected @endif 
							value="1">Bật</option>
						<option @if($slide['status']==0)selected @endif 
							value="0">Tắt</option>
					</select>
				</div>
			</li>
			@endif
			@endforeach
		</ul>
		<div class="add-record">
			<img src="{{asset('/public/images/icons/icon-insert.png')}}" class="addli" name="slide">
		</div>
	</div>
</div>

<div class="w100min banner-service-seting nav-tag-seting">
	<div id="banner-service" class="w100min">
		@foreach($listservice as $key=>$service)
			<div class="col-banersv{{count($listservice)}}">
				@if($service['pathBn']=='')
				<img src="{{asset('/public'.$service['srcImg'])}}">
				@else
				<a href="{{$service['pathBn']}}" 
					title="{{$service['nameBn']}}">
					<img src="{{asset('/public'.$service['srcImg'])}}">
				</a>
				@endif
			</div>
		@endforeach
	</div>
	<div id="input-service" class="w100min">
		<ul class="w100min liservice frame-record">
			<li name='0'>
				<div class="num-row"><p>STT</p></div>
				<div class="col-title"><p>Tiểu Đề</p></div>
				<div class="col-href"><p>Link Chỉ Tới</p></div>
				<div class="col-images"><p>Ảnh</p></div>
				<div class="col-status"><p>Trạng Thái</p></div>
			</li>
			@foreach($listservice as $key=>$service)
			<li name="{{(++$key)}}">
				<div class="num-row">
					<p>{{$key}}</p>
					<input type="text" name="idservice{{$key}}" value="{{$service['idbanner']}}" hidden>
				</div>
				<div class="col-title">
					<input type="text" name="nameservice{{$key}}" 
						value="{{$service['nameBn']}}">
				</div>
				<div class="col-href">
					<input type="text" name="pathservice{{$key}}" 
						value="{{$service['pathBn']}}">
				</div>
				<div class="col-images">
					<img src="{{asset('/public'.$service['srcImg'])}}" 
						alt="{{$service['altImg']}}" 
						class="openFileImages serviceseting"
						name="service{{$key}}">
					<input type="text" name="service{{$key}}" 
						value="{{$service['idImg']}}" hidden>
				</div>
				<div class="col-status">
					<select name="status_service{{$key}}">
						<option @if($service['status']==1)selected @endif 
							value="1">Bật</option>
						<option @if($service['status']==0)selected @endif 
							value="0">Tắt</option>
					</select>
				</div>
			</li>
			@endforeach
		</ul>
		<div class="add-record">
			<img src="{{asset('/public/images/icons/icon-insert.png')}}" 
				class="addli" name="service">
		</div>
	</div>
</div>
<div class="w100min custom-banner nav-tag-seting">
	<div id="custom-banner" class="w100min">
		@foreach($listcustom as $key=>$custom)
			<div class="col-custom{{++$key}} w100min">
				@if($custom['pathBn']=='')
				<img src="{{asset('/public'.$custom['srcImg'])}}">
				@else
				<a href="{{$custom['pathBn']}}" 
					title="{{$custom['nameBn']}}">
					<img src="{{asset('/public'.$custom['srcImg'])}}">
				</a>
				@endif
			</div>
		@endforeach
	</div>
	<div id="input-custom" class="w100min">
		<ul class="w100min licustom frame-record">
			<li name='0'>
				<div class="num-row"><p>STT</p></div>
				<div class="col-title"><p>Tiểu Đề</p></div>
				<div class="col-href"><p>Link Chỉ Tới</p></div>
				<div class="col-images"><p>Ảnh</p></div>
				<div class="col-status"><p>Trạng Thái</p></div>
			</li>
			@foreach($listcustom as $key=>$custom)
			<li name="{{(++$key)}}">
				<div class="num-row">
					<p>{{$key}}</p>
					<input type="text" name="idcustom{{$key}}" value="{{$custom['idbanner']}}" hidden>
				</div>
				<div class="col-title">
					<input type="text" name="namecustom{{$key}}" 
						value="{{$service['nameBn']}}">
				</div>
				<div class="col-href">
					<input type="text" name="pathcustom{{$key}}" 
						value="{{$service['pathBn']}}">
				</div>
				<div class="col-images">
					<img src="{{asset('/public'.$custom['srcImg'])}}" 
						alt="{{$custom['altImg']}}" 
						class="openFileImages custombanner"
						name="custom{{$key}}">
					<input type="text" name="custom{{$key}}" 
						value="{{$custom['idImg']}}" hidden>
				</div>
				<div class="col-status">
					<select name="status_custom{{$key}}">
						<option @if($custom['status']==1)selected @endif 
							value="1">Bật</option>
						<option @if($custom['status']==0)selected @endif 
							value="0">Tắt</option>
					</select>
				</div>
			</li>
			@endforeach
		</ul>
		<div class="add-record">
			<img src="{{asset('/public/images/icons/icon-insert.png')}}" 
				class="addli" name="custom">
		</div>
	</div>
</div>
<div class="btnsubmit w100min">
	<button type="submit" name="savebanner">Lưu</button>
</div>
</form>
@stop