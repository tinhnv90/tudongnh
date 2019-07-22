@extends('Layout')
@section('title'){{$listProductOfCategory['get_seo']['metaTag']}}@stop
@section('description'){{$listProductOfCategory['get_seo']['description']}}@stop
@section('keywords'){{$listProductOfCategory['get_seo']['keyword']}}@stop
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$style.'category.css'}}">
<link rel="stylesheet" type="text/css" href="{{$style.'left.css'}}">
@stop
@section('meta-face')
<meta property="og:image"       
	content="{{$dir.$listProductOfCategory['get_images']['srcImg']}}" />
<meta property="og:image:alt" content="{{$listProductOfCategory['get_images']['altImg']}}"/>
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
		@include('Product.Category')
	</div>
	<div id="left" class="bor-box">
		<?php $idcategory=$listProductOfCategory['idcategory'];
		$idparent=$listProductOfCategory['leveCt']; ?>
		@include('left.category')
		@include('left.box-face')
		@include('left.special-product')
	</div>
</div>
@stop