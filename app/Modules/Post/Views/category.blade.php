@extends('Layout')
@section('title'){{$listpost['get_seo']['metaTag']}}@stop
@section('description'){{$listpost['get_seo']['description']}}@stop
@section('keywords'){{$listpost['get_seo']['keyword']}}@stop
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$style.'category.css'}}">
<link rel="stylesheet" type="text/css" href="{{$style.'left.css'}}">
@stop
@section('meta-face')
<meta property="og:image"       
	content="{{$dir.$listpost['get_images']['srcImg']}}" />
<meta property="og:image:alt" content="{{$listpost['get_images']['altImg']}}"/>
<meta property="og:image:width" content="500px"/>
<meta property="og:image:height" content="554px"/>
@stop
@section('javascript')
<script>
	$(document).ready(function(){
		$('select[name="sortBy"]').change(function(){
    		$('#filter>form').submit();
	    });
	    $('select[name="limit"]').change(function(){
    		$('#filter>form').submit();
	    });
	});
</script>
@stop
@section('content')
<div id="content" class="w100min">
	<div id="content-right">
		<div class="title-page bor-b">
			<h3>
				<span>
					<a href="{{$urlcate.$listpost['pathCt']}}" 
						title="{{$listpost['titleCt']}}">{{$listpost['titleCt']}}</a>
				</span>
			</h3>
		</div>
		@if(isset($countproduct))
		<div id="filter" class="w100min bor-b">
			<form method="get" action="{{url()->current()}}" class="wh100">
				<div class="sort-product col50">
					<label>Sắp Xếp :</label>
					<select name="sortBy" @if(isset($disabled))disabled @endif>
						<option @if(isset($namePro_ASC)){{$namePro_ASC}}@endif value="namePro_ASC">Tên (A - Z)</option>
						<option @if(isset($namePro_DESC)){{$namePro_DESC}}@endif value="namePro_DESC">Tên (Z - A)</option>
						<option @if(isset($numview_ASC)){{$numview_ASC}}@endif value="numview_ASC">Cũ Nhất</option>
						<option @if(isset($numview_DESC)){{$numview_DESC}}@endif value="numview_DESC">Mới Nhất</option>
					</select>
				</div>
				<div class="display-number col50">
					<label>Hiển Thị : </label>
					<select name="limit" @if(isset($disabled))disabled @endif>
						<option @if(isset($_16)){{$_16}}@endif value="16">16</option>
						<option @if(isset($_32)){{$_32}}@endif value="32">32</option>
						<option @if(isset($_64)){{$_64}}@endif value="64">64</option>
						<option @if(isset($_96)){{$_96}}@endif value="96">96</option>
					</select>
				</div>
			</form>
		</div>
		@endif
		<div class="scoll">
			<ul>
			@foreach($listpost['listpost'] as $posts)
				<li class="col-pro5">
					<div class="images w100min">
						<a class="wh100" href="{{$urlpost.$posts['pathPost']}}" 
							title="{{$posts['titlePost']}}">
							<img src="{{$dir.$posts['get_images']['srcImg']}}" 
								alt="{{$posts['get_images']['altImg']}}">
						</a>
					</div>
					<div class="content w100min">
						<h3 class="name w100min">
							<a class="wh100" href="{{$urlpost.$posts['pathPost']}}" 
								title="{{$posts['titlePost']}}">{{$posts['titlePost']}}</a>
						</h3>
						<div class="short-description w100min">
							<p>{{$posts['shortDescription']}}</p>
						</div>
						<div class="readmore w100min">
							<a href="{{$urlpost.$posts['pathPost']}}" 
								title="{{$posts['titlePost']}}">
								<i class="fas fa-angle-double-right"></i>
								<span>Xem Thêm</span>
							</a>
						</div>
					</div>
				</li>
			@endforeach
			</ul>
		</div>
		@if(isset($countproduct) && $countproduct>16)
			@include('common.page')
		@endif	
	</div>
	<div id="left" class="bor-box">
		@include('left.category')
		@include('left.box-face')
		@include('left.special-product')
	</div>
</div>
@stop