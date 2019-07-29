<!DOCTYPE html>
<html>
<head>
	<title>Tủ Đông Nhà Hàng</title>	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="_token" content="{{csrf_token()}}" />
	<link rel="stylesheet" type="text/css" href="{{$styleAdmin.'style.css'}}">
	<link rel="stylesheet" type="text/css" href="{{$styleAdmin.'openfileimages.css'}}">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	@yield('stylesheet')
	<script src="{{$scriptAdmin.'scriptadmin.js'}}"></script>
</head>
<body>
	@yield('frameImages')
	<header>
		<div id="logo-admin">
			<a href="{{asset('/admin')}}">
				<img src="{{$infoweb['imglogo']}}">
			</a>
		</div>
		<div id="myaccount">
			<a href="#">
				<img src="{{asset('public'.$useradmin['srcImg'])}}">
				<p>{{$useradmin['name']}}</p>
			</a>
			<a href="{{asset('/admin/logout')}}"><p>LogOut</p></a>
		</div>
	</header>
	<content>
		<div id="content-left">
			<ul id="dashboard">
				<li><span><img src="{{asset('/public/images/icons/computer.png')}}"><p>DashBoard</p></span>
					<ul class="subnav">
						<li><a href="{{asset('/admin/dashboard')}}">DashBoard</a></li>
						<li><a href="{{asset('/admin/menu')}}">Danh Mục</a></li>
						<li><a href="{{asset('/admin/product')}}">Sản Phẩm</a></li>
						<li><a href="{{asset('/admin/post')}}">Tin Tức</a></li>
						<li><a href="{{asset('/admin/images')}}">Album Ảnh</a></li>
					</ul>
				</li>
				<li><span><img src="{{asset('/public/images/icons/advanced.png')}}"><p>Advanced</p></span>
				<ul class="subnav">
					<li>
						<a href="{{asset('/admin/webseting')}}">Web setting</a>
					</li>
					<li>
						<a href="{{asset('/admin/info-home')}}">Nội Dung Trang Chủ</a>
					</li>
					<li>
						<a href="{{asset('/admin/producer')}}">Nhà Sản Xuất</a>
					</li>
					<li>
						<a href="{{asset('/admin/banner')}}">Banner</a>
					</li>
					<li>
						<a href="{{asset('/admin/introduce')}}">Giới Thiệu</a>
					</li>
				</ul>
				</li><li><span><img src="{{asset('/public/images/icons/edit.png')}}"><p>Thiết Kế Website</p></span>
					<ul class="subnav">
						<li>
							<a href="{{asset('/admin/webdesign/edithomepage')}}">Edit Home Page</a>
						</li>
						<li>
							<a href="{{asset('/admin/webdesign/editheader')}}">Edit Header</a>
						</li>
						<li>
							<a href="{{asset('/admin/webdesign/editcontent')}}">Edit Content</a>
						</li>
						<li>
							<a href="{{asset('/admin/webdesign/editfooter')}}">Edit Footer</a>
						</li>
					</ul>
				</li><li><span><img src="{{asset('/public/images/icons/search-icon.png')}}"><p>Search</p></span>
				</li>
			</ul>
		</div>
		<div id="content-right">
			<div id="content-top">
				<h1>@yield('title')</h1>
				<div id="content-top-right">
					<a href="{{asset('/')}}admin/@yield('addlink')/add">
						<p class="add" title="Thêm Dữ Liệu">+</p>
					</a>
					<a href="#" id="copy">
						<p class="copy" title="Chức năng chưa mở">
							<img src="{{asset('/public/images/icons/copy.png')}}">
						</p>
					</a>
					<a href="#" id="delete">
						<p class="delete" title="Xóa">
							<img src="{{asset('/public/images/icons/41779.png')}}">
						</p>
					</a>
				</div>
			</div>
			<div id="content-main" name="@yield('addlink')">
				<h4 class="title-page">@yield('titlepage')</h4>
				@yield('processingimg')
				<div id="container">
					@yield('container')
				</div>
			</div>
		</div>
	</content>
	<footer></footer>
</body>
</html>