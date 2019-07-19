@extends('Layout')
@section('title'){{$postdetail['get_seo']['metaTag']}}@stop
@section('description'){{$postdetail['get_seo']['description']}}@stop
@section('keywords'){{$postdetail['get_seo']['keyword']}}@stop
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$style.'post-detail.css'}}">
@stop
@section('meta-face')
<meta property="og:image"       
	content="{{$dir.$postdetail['get_images']['srcImg']}}" />
<meta property="og:image:alt" content="{{$postdetail['get_images']['altImg']}}"/>
<meta property="og:image:width" content="500px"/>
<meta property="og:image:height" content="554px"/>
@stop
@section('content')
<div id="content">
	<div class="title-page">
		<h3>
			<span>{{$postdetail['titlePost']}}</span>
			<p>
				<span class="author">{{$postdetail['get_user']['name']}}</span>|
				<span class="date-time">{{$postdetail['created_at']}}</span>
			</p>
		</h3>
	</div>
	<div class="content">
		<div class="shortDescription w100min">
			<?php echo $postdetail['shortDescription']; ?>
		</div>
		<div class="container w100min">
			<?php echo $postdetail['contentPost']; ?>
		</div>
		<div class="w100min quote">
			<h3>Trích Dẫn: <span>{{$postdetail['quote']}}</span></h3>
		</div>
	</div>
	<div id="recommend" class="w100min">
		<div class="title-page">
			<h3>
				<span>SẢN PHẨM LIÊN QUAN</span>
			</h3>
		</div>
		@include('Products::ListProducts')
	</div>
	<div id="comment" class="w100min">
		<div class="title-page">
			<h3>
				<span>BÌNH LUẬN</span>
			</h3>
		</div>
		<div class="content w100min">
			<div class="war-comment">
				<div class="fb-comments" 
					data-href="{{url()->current()}}" 
					data-width="100%" 
					data-numposts="5">
				</div>
			</div>
		</div>
	</div>
</div>
@stop