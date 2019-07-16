@extends('admins.frameadmin')
@section('title','Danh Mục')
@section('addlink','menu')
@section('titlepage','Chỉnh Sửa Danh Mục')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$styleAdmin.'style-menuadd.css'}}">
<script src="//cdn.ckeditor.com/4.12.0/full/ckeditor.js"></script>
@stop
@section('frameImages')
	@include('admins.choosefileimages')
@stop
@section('container')
<ul id="nav-tag">
	<li><p class="click-nav-tag-admin-menu" name='Chung'>Chung
			@if($errors->has('txtMetaTag_category') || $errors->has('txtName_category') || $errors->has('txtDescription_category') || $errors->has('txtkeyWord_category'))
				<span class="error-tag1">*</span>
			@endif
		</p>
	</li>
	<li><p name='Dữ Liệu'>Dữ Liệu
			@if($errors->has('txtOrderCt') || $errors->has('pathCt'))
				<span class="error-tag2">*</span>
			@endif
		</p>
	</li>
	<li>
		<p name='Content page'>Mô Tả Danh Mục</p>
	</li>
</ul>
<form method="POST" action="{{asset('/admin/menu/edit-'.$idcategory.'/'.$_tonken)}}" id="container-form-menu-add">
	<div id="tag1">
		<ul>
			<li class="wh100"><label>Tên Danh Mục <span>*</span>: </label></li>
			<li class="wh100"><label>Danh Mục Cha : </label></li>
			<li class="wh100"><label>Tiêu Đề Meta Tag : </label></li>
			<li class="wh100"><label>Mô Tả Từ Khóa(Description) <span>*</span>: </label></li>
			<li class="wh100"><label>Từ Khóa(Keyword) : </label></li>
			<li class="wh100"><label>Tags : </label></li>
		</ul>

		<ul>
			<li class="wh100">{{csrf_field()}}
				<input type="text" name="txtName_category" placeholder='Tên Danh Mục' value="{{$infoCategory['titleCt']}}">
				@if($errors->has('txtName_category'))
					<p style="color: red">{{$errors->first('txtName_category')}}</p>
				@endif
			</li>
			
			<li class="wh100">
				<select name='idcategory'>
				  <option value="0">0</option>
				@foreach($List_father_categorys[0] as $categorys)
					<option <?php if($categorys['idcategory']==$infoCategory['leveCt']) echo "selected='selected'"; ?> value="{{$categorys['idcategory']}}">{{$categorys['idcategory'].' - '.$categorys['titleCt']}}</option>
					@if(isset($List_father_categorys[$categorys['idcategory']]))					@foreach($List_father_categorys[$categorys['idcategory']] as $category)
								<option <?php if($category['idcategory']==$infoCategory['leveCt']) echo "selected='selected'"; ?> value="{{$category['idcategory']}}">{{$categorys['idcategory'].' - '.$categorys['titleCt'].' > '.$category['idcategory'].' - '.$category['titleCt']}}</option>
							@endforeach
					@endif
				@endforeach
				</select>
			</li>
			<li class="wh100">
				<input type="text" name="txtMetaTag_category" placeholder='Meta Tag' value="{{$infoSeoCategory['metaTag']}}">
				@if($errors->has('txtMetaTag_category'))
					<p style="color: red">{{$errors->first('txtMetaTag_category')}}</p>
				@endif
			</li>
			<li class="wh100">
				<input type="text" name="txtDescription_category" placeholder='Description' value="{{$infoSeoCategory['description']}}">
				@if($errors->has('txtDescription_category'))
					<p style="color: red">{{$errors->first('txtDescription_category')}}</p>
				@endif
			</li>
			<li class="wh100">
				<input type="text" name="txtkeyWord_category" placeholder='Keyword' value="{{$infoSeoCategory['keyword']}}">
				@if($errors->has('txtkeyWord_category'))
					<p style="color: red">{{$errors->first('txtkeyWord_category')}}</p>
				@endif
			</li>
			<li class="wh100">
				<input type="text" name="txtTags_category" placeholder='Tags key'  value="{{$infoSeoCategory['tags']}}">
			</li>
		</ul>
	</div>
	<div id="tag2">
		<ul>
			<li><label>SEO Url :</label></li>
			<li><label>Loại Danh Mục :</label></li>
			<li><label>Thứ Tự <span>*</span>:</label></li>
			<li><label>Trạng Thái :</label></li>
			<li class="img-cate"><label>Images : </label></li>
			<li><label>Hiện tag sản phẩm trang chủ : </label></li>
		</ul>
		<ul>
			<li><input type="text" name="pathCt1" placeholder='SEO url' disabled value="{{$infoCategory['pathCt']}}">
			<input type="text" name="pathCt" placeholder='SEO url' value="{{$infoCategory['pathCt']}}">
				@if($errors->has('pathCt'))
					<p style="color: red">{{$errors->first('pathCt')}}</p>
				@endif 
			</li>
			<li>
				<select name="sltypeCt">
					<option {{$typect_product}} value="product">Sản Phẩm</option>
					<option {{$typect_post}} value="post">Bài Đăng</option>
					<option {{$typect_web}} value="web">Web</option>
				</select>
			</li>
			<li>
				<input type="text" name="txtOrderCt" placeholder='Thứ Tự Trên Menu Ngang' value="{{$infoCategory['orderCt']}}">
				@if($errors->has('txtOrderCt'))
					<p style="color: red">{{$errors->first('txtOrderCt')}}</p>
				@endif
			</li>
			<li>
				<select name="statusCt">
					<option {{$selected_true}} value="1">Bật</option>
					<option {{$selected_false}} value="0">Tắt</option>
				</select>
			</li>
			<li class="img-cate">
				<input type="text" name="idimg" hidden="hidden" value="242">
				<img class="imgsizre-product openFileImages" 
					src="{{asset('/public/images/icons/error-images.png')}}" 
					name="idimg">
			</li>
			<li>
				<select name="showproducthome">
					<option @if($infoCategory['showproducthome']==1)selected @endif value="1">Bật</option>
					<option  @if($infoCategory['showproducthome']==0)selected @endif value="0">Tắt</option>
				</select>
			</li>
		</ul>
	</div>
	<div id="tag3">
		<div>
			<label class="marl15">Mô Tả Nội dung</label>
		</div>
		<div class="w100min">
			<textarea name="contentCategory" id="contentCategory" rows="500">
				{{$contentCate}}
			</textarea>
			<script type="text/javascript">
				CKEDITOR.replace('contentCategory');
			</script>
		</div>
	</div>
	<button type="submit" name="btnMenuedit">Lưu</button>
</form>
@stop