@extends('admins.frameadmin')
@section('title','Sản Phẩm')
@section('addlink','product')
@section('titlepage','Danh Sách Sản Phẩm')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$styleAdmin.'style-productadd.css'}}">
<script src="//cdn.ckeditor.com/4.12.0/full/ckeditor.js"></script>
@stop
@section('frameImages')
	@include('admins.choosefileimages')
@stop
@section('container')
<ul id="nav-tag">
	<li>
		<p class="click-nav-tag-admin-menu" name='Chung'>Chung
			@if($errors->has('txtnamepro') || $errors->has('txttitletagpro'))
				<span class="error-tag1">*</span>
			@endif
		</p>
	</li>
	<li>
		<p name='Dữ Liệu'>Dữ Liệu
			@if($errors->has('txtcodepro') || $errors->has('txtpricepro') || $errors->has('txtweightpro') || $errors->has('txtpowerpro') || $errors->has('txtnumberpro'))
				<span class="error-tag2">*</span>
			@endif
		</p>
	</li>
	<li>
		<p name='Contentproduct'>Nội Dung</p>
	</li>
</ul>

<form method="POST" action="{{asset('/admin/product/edit-'.$idproduct.'/'.$_tonken)}}" id="container-form-prduct-add">
	<div id="tag1">
		<ul>
			<li class="wh100"><label>Tên Sản Phẩm <span>*</span>: </label></li>
			<li class="wh100"><label>Tiêu Đề(Title Tag) <span>*</span>: </label>
			</li>
			<li class="wh100"><label>Mô Tả Từ Khóa(Description) : </label></li>
			<li class="wh100"><label>Từ Khóa(Keyword) : </label></li>
			<li class="wh100"><label>Tags Sản Phẩm : </label></li>
		</ul>
		<ul class="ul2">
			<li>{{csrf_field()}}
				
				<input type="text" name="txtnamepro" value="{{$infoProducts['namePro']}}">
				@if($errors->has('txtnamepro'))
					<p style="color: red">{{$errors->first('txtnamepro')}}</p>
				@endif
			</li>
			<li><input type="text" name="txttitletagpro" value="{{$infoSeo['metaTag']}}">
				@if($errors->has('txttitletagpro'))
					<p style="color: red">{{$errors->first('txttitletagpro')}}</p>
				@endif
			</li>
			<li><input type="text" name="txtdescriptionpro" value="{{$infoSeo['description']}}"></li>
			<li><input type="text" name="txtkeywordpro" value="{{$infoSeo['keyword']}}"></li>
			<li><input type="text" name="txttagspro" value="{{$infoSeo['tags']}}"></li>
		</ul>
	</div>
	<div id="tag2">
		<ul>
			<li><label>SEO Url :</label></li>
			<li><label>Mã Sản Phẩm <span class="spcodepro">*</span>:</label></li>
			<li><label>Danh Mục :</label></li>
			<li><label>Nhà Sản Xuất :</label></li>
			<li><label>Ảnh  :</label></li>
			<li><label>Giá :</label></li>
			<li><label>Kích Thước :</label></li>
			<li><label>Cân Nặng :</label></li>
			<li><label>Công suất :</label></li>
			<li><label>Số Lượng :</label></li>
			<li><label>Trạng Thái :</label></li>
		</ul>
		<ul class="ul2">
			<li>
				<input type="text" name="pathPro" disabled="disabled" value="{{$infoProducts['pathPro']}}">
				<input type="text" name="pathPro" hidden="hidden" value="{{$infoProducts['pathPro']}}">
			</li>
			<li><input type="text" name="txtcodepro" value="{{$infoProducts['codepro']}}">
				@if($errors->has('txtcodepro'))
					<p style="color: red">{{$errors->first('txtcodepro')}}</p>
				@endif
			</li>
			<li>
				<select name="txtidcategory" class="select-option">
					@foreach($listCategory as $category)
						<option <?php if($infoProducts['idcategory']==$category['idcategory']) echo 'selected="selected"'; ?> value="{{$category['idcategory']}}">{{$category['idcategory'].' - '.$category['titleCt']}}</option>
					@endforeach
				</select>
				<label id="category-new"><a href="{{asset('/admin/menu/add')}}">Thêm Danh Mục Mới</a></label>
			</li>
			<li>
				<select name="txtproducerpro" class="select-option">
					@foreach($listProducer as $producer)
						<option <?php if($infoProducts['idProducer']==$producer['idProducer']) echo 'selected="selected"'; ?> value="{{$producer['idProducer']}}">{{$producer['idProducer'].' - '.$producer['nameProducer']}}</option>	
					@endforeach					
				</select>
				<label id="producer-new"><a href="{{asset('/admin/producer/add')}}">Thêm NSX Mới</a></label>
			</li>
			<li>
				<input type="text" name="txtidseo" hidden="hidden" value="{{$infoSeo['idSeo']}}">
				<input type="text" name="txtidimg" hidden="hidden" value="{{$infoProducts['idImg']}}">
				<img class="imgsizre-product openFileImages" 
					src="{{asset('/public').$images['srcImg']}}" 
					name="txtidimg">
			</li>
			<li><input type="text" name="txtpricepro" placeholder="Đơn vị vnđx1000" value="{{$infoProductDetail['price']}}">
				@if($errors->has('txtpricepro'))
					<p style="color: red">{{$errors->first('txtpricepro')}}</p>
				@endif
			</li>
			<li><input type="text" name="txtsizepro" placeholder="vd: 10x10x10 (dài x rộng x cao)" value="{{$infoProductDetail['size']}}"></li>
			<li><input type="text" name="txtweightpro" placeholder="đơn vị Kilogam" value="{{$infoProductDetail['weight']}}">
				@if($errors->has('txtweightpro'))
					<p style="color: red">{{$errors->first('txtweightpro')}}</p>
				@endif
			</li>
			<li><input type="text" name="txtpowerpro" placeholder="0" value="{{$infoProductDetail['poweCapacity']}}">
				@if($errors->has('txtpowerpro'))
					<p style="color: red">{{$errors->first('txtpowerpro')}}</p>
				@endif</li>
			<li>
				<input type="text" name="txtnumberpro" placeholder="0" value="{{$infoProductDetail['number']}}">
				<label class="unitpro">Đơn Vị Tính :</label>
				<input type="text" name="txtunitpro" placeholder="đơn vị" value="{{$infoProductDetail['unit']}}">
				@if($errors->has('txtnumberpro'))
					<p style="color: red">{{$errors->first('txtnumberpro')}}</p>
				@endif</li>
			<li>
				<select name="txtstatuspro">
					<option {{$status_true}} value="1">Bật</option>
					<option {{$status_false}} value="0">Tắt</option>
				</select>
			</li>
		</ul>
	</div>
	<div id="tag3">
		<div>
			<label class="mart20">Nội Dung : </label>
		</div>
		<div class="w100min-bor">
			<textarea name="post_content" id="post_content" rows="500" cols="550">
				{{$infoProducts['contentPro']}}
			</textarea>
			<script type="text/javascript">
				CKEDITOR.replace('post_content');
			</script>
		</div>
	</div>
	<button type="submit" name="btnMenuEdit">Lưu</button>
</form>
@stop