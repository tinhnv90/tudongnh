@extends('admins.frameadmin')
@section('title','Nội dung trang chủ')
@section('addlink','dashboard')
@section('titlepage','Nội dung trang chủ')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$styleAdmin.'home.css'}}">
<script src="https://kit.fontawesome.com/6776076893.js"></script>
<script src="{{$scriptAdmin.'home.js'}}"></script>
@stop
@section('container')
<div id="warpper" class="w100min-bor">
	<div class="text-war w100min" data-input="input-war">
		<div class="title-page">
			<h3>Warpper</h3>
		</div>
		@for($i=1;$i<5;$i++)
		<div class="col50">
			<input type="text" name="war{{$i}}_top" 
				value="@if($listwarpper!=null){{$listwarpper[$i-1]['descript']}} @endif">
			<input type="text" name="war{{$i}}_bottom" 
				value="@if($listwarpper!=null){{$listwarpper[$i-1]['value']}} @endif">
		</div>
		@endfor
		<div class="w100min save-warpper">
			<button name="save_warpper">Lưu</button>
		</div>
	</div>
</div>
<div id="pav-slideshow" class="w100min-bor">
	<div class="title-page">
		<h3>pav-slideshow</h3>
	</div>
	<div class="w100min">
		<div class="left">
			<div class="w100min-bor">
				<select name="specialPost">
					<option value="0"><span>nones</span></option>
					@foreach($listpost as $post)
					@if(isset($specialPost) && 
						$post['idPost']==$specialPost[0]['value']) 
						<option selected value="{{$post['idPost']}}">
							{{$post['titlePost']}}
						</option>
					@else
						<option value="{{$post['idPost']}}">
							{{$post['titlePost']}}
						</option>
					@endif
					@endforeach
				</select>
				<span class="post1 w100min">
					<a href="{{asset('admin/post/add')}}" target="">
						<i class="fas fa-plus-square"></i>
					</a>
					@if(isset($specialPost))
						<a href="{{asset('admin/post/edit')}}-{{$specialPost[0]['value']}}/{{csrf_token()}}">
							<i class="fas fa-pen-square"></i>
						</a>
					@else
						<a href="{{asset('admin/post/add')}}" target="">
							<i class="fas fa-pen-square"></i>
						</a>
					@endif
				</span>
			</div>
			<div class="w100min-bor mar10">
				<select name="post2">
					<option value="0"><span>nones</span></option>
					@foreach($listpost as $post)
					@if(isset($specialPost) && 
						$post['idPost']==$specialPost[1]['value']) 
						<option selected value="{{$post['idPost']}}">
							{{$post['titlePost']}}
						</option>
					@else
						<option value="{{$post['idPost']}}">
							{{$post['titlePost']}}
						</option>
					@endif
					@endforeach
				</select>
				<span class="post2">
					<a href="{{asset('/admin/bai-viet-noi-bat-ve-tu-dong-inox-nha-hang')}}">
						<i class="fas fa-plus-square"></i>
					</a>
					@if(isset($specialPost))
						<a href="{{asset('admin/post/edit')}}-{{$specialPost[1]['value']}}/{{csrf_token()}}">
							<i class="fas fa-pen-square"></i>
						</a>
					@else
						<a href="{{asset('admin/post/add')}}" target="">
							<i class="fas fa-pen-square"></i>
						</a>
					@endif
				</span>
			</div>
			<div class="w100min-bor">
				<select name="post3">
				<option value="0"><span>nones</span></option>
					@foreach($listpost as $post)
					@if(isset($specialPost) && 
						$post['idPost']==$specialPost[2]['value']) 
						<option selected value="{{$post['idPost']}}">
							{{$post['titlePost']}}
						</option>
					@else
						<option value="{{$post['idPost']}}">
							{{$post['titlePost']}}
						</option>
					@endif
					@endforeach
				</select>
				<span class="post3">
					<a href="{{asset('/admin/bai-viet-noi-bat-ve-tu-dong-inox-nha-hang')}}">
						<i class="fas fa-plus-square"></i>
					</a>
					@if(isset($specialPost))
						<a href="{{asset('admin/post/edit')}}-{{$specialPost[2]['value']}}/{{csrf_token()}}">
							<i class="fas fa-pen-square"></i>
						</a>
					@else
						<a href="{{asset('admin/post/add')}}" target="">
							<i class="fas fa-pen-square"></i>
						</a>
					@endif
				</span>
			</div>
		</div>
		<div class="right">
			<img src="{{$dir.'/images/slide/banner-may-bom-bun-2.jpg'}}">
			<a href="{{asset('/admin/banner')}}">
				<i class="fas fa-pen-square"></i>
			</a>
		</div>
	</div>
</div>
<div id="product-mostview" class="w100min-bor">
	<div class="title-page">
		<h3>SẢN PHẨM XEM NHIỀU</h3>
	</div>
	<div class="listproduct">
		<div class="w100min">
			<label>SẢN PHẨM HIỂU THỊ</label>
			<select name="listproduct">
				<option value="product-all">Tất Cả</option>
				@foreach($listCategory as $category)
				<option value="{{$category['idcategory']}}" 
					@if($category['idcategory']==$idcategory) selected @endif>
					<span>{{$category['titleCt']}}</span>
				</option>
				@if(count($category['children'])>0)
					@foreach($category['children'] as $children)
					<option value="{{$children['idcategory']}}" 
						@if($children['idcategory']==$idcategory) selected @endif>
						<span>{{$category['titleCt'].' >> '.$children['titleCt']}}</span>
					</option>
					@endforeach
				@endif
				@endforeach
			</select>
		</div>
		<div class="w100min">
			<label>LOẠI SẢN PHẨM HIỂN THỊ</label>
			<select name="typelistproduct">
				<option value="mostview" 
					@if($typelistproduct=='mostview')selected @endif>
					<span>Sản Phẩm Xem Nhiều</span>
				</option>
				<option value="latest" 
					@if($typelistproduct=='latest')selected @endif>
					<span>Sản Phẩm Mới Nhất</span>
				</option>
				<option value="special" 
					@if($typelistproduct=='special')selected @endif>
					<span>Sản Phẩm Đặc Biệt</span>
				</option>
			</select>
		</div>
	</div>
</div>
<div id="content-main-home" class="w100min-bor">
	<div class="title-page">
		<h3>content main</h3>
	</div>
	<div class="left w100min-bor">
		@for($i=1;$i<5;$i++)
		<div class="w100min-bor">
			<input type="text" name="leftMain{{$i}}T" 
				value="@if($leftMain!=null){{$leftMain[$i-1]['descript']}}@endif">
			<input type="text" name="leftMain{{$i}}B" 
				value="@if($leftMain!=null){{$leftMain[$i-1]['value']}}@endif">
		</div>
		@endfor
		<div class="w100min-bor">
			<input type="text" name="leftMain5T" 
				value="@if($leftMain!=null){{$leftMain[4]['descript']}}@endif">
			<img class="first" src="{{$icons.'card-vietcombank.jpg'}}">
			<img src="{{$icons.'cart-techcombank.png'}}">
		</div>
		<div class="w100min">
			<button name="save_leftMain">Lưu</button>
		</div>
	</div>
	<div class="right w100min-bor">
		<div id="banner" class="w100min-bor">
			<div class="title-page">
				<h3>banner</h3>
			</div>
			<div class="banner-main w100min">
				<span class="post2">
					<a href="{{asset('/admin/banner')}}">
						<i class="fas fa-pen-square"></i>
					</a>
				</span>
			</div>
		</div>
		<div id="listproduct-main" class="w100min-bor">
			<div class="title-page">
				<h3>Sản phẩm chính trang web</h3>
			</div>
			<div class="list-main w100min">
				<label>Danh Mục :</label>
				<select name="productMain">
					<option value="product-all">Tất Cả</option>
					@foreach($listCategory as $category)
					<option value="{{$category['idcategory']}}" 
						@if($category['idcategory']==$idcategorymain) selected @endif>
						<span>{{$category['titleCt']}}</span>
					</option>
					@if(count($category['children'])>0)
						@foreach($category['children'] as $children)
						<option value="{{$children['idcategory']}}" 
							@if($children['idcategory']==$idcategorymain) selected @endif>
							<span>{{$category['titleCt'].' >> '.$children['titleCt']}}</span>
						</option>
						@endforeach
					@endif
					@endforeach
				</select>
			</div>
		</div>
	</div>
</div>
<div id="post" class="w100min-bor">
	<div class="title-page">
		<h3>TIN TỨC NỔI BẬT</h3>
	</div>
	<div class="post-main w100min">
		<label>Lọc Bài Đăng Theo Kiểu :</label>
		<select name="postType">
			<option value="mostvie" @if($postType=='mostvie')selected @endif>
			Tin Tức Xem Nhiều</option>
			<option value="latest" @if($postType=='latest')selected @endif>Tin Tức Mới Đăng</option>
			<option value="special" @if($postType=='special')selected @endif>Tin Tức Nổi Bật</option>
		</select>
	</div>
</div>
@stop