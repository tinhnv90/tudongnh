@extends('admins.frameadmin')
@section('title','Danh Mục')
@section('addlink','menu')
@section('titlepage','Danh Sách Danh Mục')
@section('container')
<form method="get" action="{{asset('/admin/menu')}}" id="container-form-menu">
	<div class="w100min search-namecategory">
		<label>Tìm Kiếm : </label>
		<input type="text" name="search_namecategory" 
			placeholder="Tên Danh Mục" 
			value="{{$namecategory}}">
		<button type="submit">Tìm Kiếm</button>
	</div>
	<ul>
		<li class="first-list-menu">
			<span><input type="checkbox" name="subcategory" value="id" id="checkbox-all"></span>
			<p class="w469-8">Tên Danh Mục</p>
			<p class="listproduct-inhome">Dang Sách Sản Phẩm TRang Home</p>
			<p class="col-order-menu">Thứ Tự</p>
			<p>Thao Tác</p>
		</li>
		<?php $i=0; ?>
		@foreach($listcategory as $categorys)
			<?php $idcategory=$categorys['idcategory'];?>
			@if($i>=$offset && $i<($take+$offset) && $idcategory==$categorys['idcategory'])
			<li class="align-unset">
				<span><input type="checkbox" name="subcategory" 
					class="checkbox-record" value="{{$categorys['idcategory']}}">
					<em class="index-record">{{++$i}}</em>
				</span>
				<p class="w469-8">{{$categorys['titleCt']}}</p>
				<p class="listproduct-inhome">
					<select name="showproducthome" 
						data-idcategory="{{$categorys['idcategory']}}">
						<option @if($categorys['showproducthome']==1)selected @endif value="1">Hiện</option>
						<option @if($categorys['showproducthome']==0)selected @endif  value="0">Ẩn</option>
					</select>
				</p>
				<p class="align-center col-order-menu">{{$categorys['orderCt']}}</p>
				<p><a href="/admin/menu/edit-{{$categorys['idcategory']}}/{{csrf_token()}}"><img src="{{asset('/public/images/icons/edit-512.png')}}"></a></p>
			</li>
			@else
				<?php $i++; ?>
			@endif
			@foreach($categorys['children'] as $subcategory)
				@if($i>=$offset && $i<($take+$offset))
				<li class="align-unset">
					<span><input type="checkbox" name="subcategory" class="checkbox-record" value="{{$subcategory['idcategory']}}"><em class="index-record">{{++$i}}</em></span>
					<p class="w469-8">{{$categorys['titleCt'].' > '.$subcategory['titleCt']}}</p>
					<p class="listproduct-inhome">
						<select name="showproducthome" 
							data-idcategory="{{$subcategory['idcategory']}}">
							<option @if($subcategory['showproducthome']==1)selected @endif value="1">Hiện</option>
							<option @if($subcategory['showproducthome']==0)selected @endif value="0">Ẩn</option>
						</select>
					</p>
					<p class="align-center col-order-menu">{{$subcategory['orderCt']}}</p>
					<p><a href="/admin/menu/edit-{{$subcategory['idcategory']}}/{{csrf_token()}}"><img src="{{asset('/public/images/icons/edit-512.png')}}"></a></p>
				</li>
				@else
					<?php $i++;?>
				@endif
			@endforeach
		@endforeach
	</ul>
</form>
@include('local.vinakitnet.content.components.page')
@stop