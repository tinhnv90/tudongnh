@extends('admins.frameadmin')
@section('title','Sản Phẩm')
@section('addlink','product')
@section('titlepage','Danh Sách Sản Phẩm')
@section('container')
<form method="get" action="{{asset('/admin/product')}}" id="container-product">
	<div class="w100min">
		<div class="search-namepro">
			<label>Tìm Kiếm : </label>
			<input type="text" name="search_namepro" placeholder="Tên Sản Phẩm" 
				value="{{$nameproduct}}">
		</div>
		<div class="search-codepro">
			<input type="text" name="search_codepro" placeholder="Mã Sản Phẩm" 
				value="{{$codeproduct}}">
			<button type="submit">Tìm Kiếm</button>
		</div>
	</div>
	<ul>
		<li>
			<span class="">
				<input type="checkbox" name="subcategory" value="id" id="checkbox-all">
			</span>
			<span class="w80">Hình Ảnh</span>
			<p class="w357">Tên Danh Mục</p>
			<p class="w100p">Mã SP</p>
			<p class="w100p">Giá</p>
			<p class="w80">Số Lượng</p>
			<p class="w50">status</p>
			<p class="w80">Thao Tác</p>
		</li>
		@foreach($listproducts as $key=>$products)
		@if($key>=($page-1)*$productNumberDisplayed && $key<$page*$productNumberDisplayed)
		<li>
			<span class="h50">
				<input type="checkbox" name="subcategory" 
					class="checkbox-record" value="{{$products['idproduct']}}">
				<em>{{++$key}}</em>
			</span>
			<span class="w80 pad0 zoom">
				<img alt="$products['namePro']" 
					src="{{asset('public').$products['getproduct_images']['srcImg']}}">
			</span>
			<p class="w357">
			@if(strlen($products['namePro']) <85)
				{{$products['namePro']}}
			@else 
				{{substr($products['namePro'],0,-(strlen($products['namePro'])-85)).' ...'}}
			@endif
			</p>
			<p class="w100p">{{$products['codepro']}}</p>
			<p class="w100p">{{number_format($products['getproduct_detail']['price'])}}</p>
			<p class="w80">{{$products['getproduct_detail']['number']}}</p>
			<p class="w50">
				@if($products['statusPro']==0)Tắt @else Bật @endif
			</p>
			<p class="w80">
				<a href="/admin/product/edit-{{$products['idproduct']}}/{{csrf_token()}}">
					<img src="{{asset('/public/images/icons/edit-512.png')}}" 
					title="chỉnh sửa sản phẩm">
				</a>
			</p>
		</li>
		@if($key==$productNumberDisplayed)
			<?php break; ?>
		@endif
		@endif
		@endforeach
	</ul>
</form>
@include('Common.page')
@stop