@extends('admins.frameadmin')
@section('title','Tin Tức')
@section('addlink','post')
@section('titlepage','Thêm Bài Đăng Mới')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$styleAdmin.'style-productadd.css'}}">
<link rel="stylesheet" type="text/css" href="{{$styleAdmin.'style-post.css'}}">
<script src="//cdn.ckeditor.com/4.12.0/full/ckeditor.js"></script>
@stop
@section('frameImages')
	@include('admins.choosefileimages')
@stop
@section('container')
<ul id="nav-tag">
	<li><p class="click-nav-tag-admin-menu" name='Chung'>Chung
			@if($errors->has('txtnamepost') || $errors->has('txtmetatitle'))
				<span class="error-tag1">*</span>
			@endif
		</p>
	</li>
	<li><p name='Dữ Liệu'>Dữ Liệu
			@if($errors->has('pathPost'))
				<span class="error-tag2">*</span>
			@endif
		</p>
	</li>
</ul>

<form method="POST" action="{{asset('/admin/post/add')}}" id="container-form-prduct-add">
	<div id="tag1">
		<ul>
			<li class="wh100"><label>Tiêu Đề Bài Viết <span>*</span>:</label></li>
			<li class="wh100"><label>Meta Title <span>*</span>: </label></li>
			<li class="wh100 shortdes"><label>Mô Tả Ngắn :</li>
			<li class="wh100"><label>Mô Tả Từ Khóa(Description) : </label></li>
			<li class="wh100"><label>Từ Khóa(Keyword) : </label></li>
			<li class="wh100"><label>Tags : </label></li>
		</ul>
		<ul class="ul2">
			<li>{{csrf_field()}}
				<input type="text" name="userid" hidden="hidden" value="1">
				<input type="text" name="txtnamepost">
				@if($errors->has('txtnamepost'))
					<p style="color: red">{{$errors->first('txtnamepost')}}</p>
				@endif
			</li>
			<li>
				<input type="text" name="txtmetatitle">
				@if($errors->has('txtmetatitle'))
					<p style="color: red">{{$errors->first('txtmetatitle')}}</p>
				@endif
			</li>
			<li class="shortdes"><textarea name="txtshortDespost"></textarea></li>
			<li><input type="text" name="txtdespost"></li>
			<li><input type="text" name="txtkeywordpost"></li>
			<li><input type="text" name="txttagspost"></li>
		</ul>
	</div>
	<div id="tag2">
		<ul>
			<li><label>SEO Url :</label></li>
			<li><label>Ảnh  :</label></li>
			<li><label>Danh Mục :</label></li>
			<li><label>Trạng Thái :</label></li>
			<li><label>Trích Dẫn :</label></li>
		</ul>
		<ul class="ul2">
			<li>
				<input type="text" name="pathPost" disabled="disabled">
				<input type="text" name="pathPost" hidden="hidden">
				@if($errors->has('pathPost'))
					<p style="color: red">{{$errors->first('pathPost')}}</p>
				@endif
			</li>
			<li>
				<input type="text" name="txtidimg" hidden="hidden" value="0">
				<img class="imgsizre-product openFileImages" 
					src="{{asset('/public/images/icons/error-images.png')}}" 
					name="txtidimg">
			</li>
			<li>
				<select name="slidcategory">
					@foreach($listcategory as $categorys)
						<option value="{{$categorys['idcategory']}}">{{$categorys['idcategory'].' - '.$categorys['titleCt']}}</option>
					@endforeach
				</select>
			</li>
			<li>
				<select name="txtstatuspost">
					<option value="1">Bật</option>
					<option value="0">Tắt</option>
				</select>
			</li>
			<li>
				<input type="text" name="txtquote" 
					value="vinaktchennet" placeholder="vinakitchen.net">
			</li>
		</ul>
	<label class="tag1">Nội Dung Bài Viết : </label>
	<textarea name="post_content" id="post_content" rows="500" cols="550"></textarea>
	<script type="text/javascript">
		CKEDITOR.replace('post_content');
	</script>
	</div>
	<button type="submit" name="btnpostAdd">Đăng Bài</button>
</form>
@stop