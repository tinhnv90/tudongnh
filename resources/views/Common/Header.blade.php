<div id="header" class="w100min">
	<div id="topbar-mobile" class="mb">
		<h1><a href="{{asset('/')}}" title="Trang Chủ">Tủ Đông Nhà Hàng</a></h1>
	</div>
	<div id="menu-mobile" class="mb w100min">
		<div class="search-form-mobile w100min">
			<form class="w100min" method="get" action="{{asset('/search')}}">
				<input class="bor-box" type="text" name="searchtxt" placeholder="Tìm Kiếm">
				<button class="bor-box" type="submit"><i class="fas fa-search"></i></button>
			</form>
		</div>
		<div id="nav-bar-mobile" class="w100min">
			<div class="open-nav-mobile">
				<i class="fas fa-bars"></i>
			</div>
			<div class="cart-mobile">
				<p>
					<a href="{{asset('/gio-hang')}}" class="wh100" 
						title="thông tin giỏ hàng">
						<span class="cart-item">{{$productNumberInTheCart}}</span>
						<i class="fas fa-shopping-cart"></i>
					</a>
				</p>
				<p>
					<a href="{{asset('/san-pham-ua-thich')}}" class="wh100" 
						title="thông tin giỏ hàng">
						<span class="totalWishList-mb">{{$productNumberInTheWishlist}}</span>
						<i class="fas fa-heart"></i>
					</a>
				</p>
				<p>
					<a href="{{asset('/so-sanh')}}" class="wh100" 
						title="thông tin giỏ hàng">
						<span class="totalCompare-mb">{{$productNumberInTheCompare}}</span>
						<i class="fas fa-retweet"></i>
					</a>
				</p>
			</div>
		</div>
		<div id="category-mobile">
			<ul class="w100min">
				@foreach($listCategory as $category)
				<li class="w100min">
					<h3>
						@if($category['pathCt']=='trang-chu' || $category['pathCt']=='home' || $category['pathCt']=='tin-tuc')
							<a class="nametext" href="{{asset('/'.str_replace(['trang-chu','home'],'',$category['pathCt']))}}" 
								title="{{$category['titleCt']}}">{{$category['titleCt']}}</a>
						@else
							<a class="nametext" href="{{$urlcate.$category['pathCt']}}" 
								title="{{$category['titleCt']}}">{{$category['titleCt']}}</a>
						@endif
					</h3>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
	<div id="topbar" class="hide-mobile w100min">
		<div id="topbar-top" class="w100min">
			<div class="container">
				<div class="check-cart col-top">
					<a class="wh100" href="{{asset('/san-pham-ua-thich')}}" 
						title="sản phẩm yêu thích">
						<i class="fas fa-heart"></i>
						<p>Sản Phẩm Ưa Thích (<span class="totalWishList">{{$productNumberInTheWishlist}}</span>)</p>
					</a>
				</div>
				<div class="check-cart col-top">
					<a class="wh100" href="{{asset('/so-sanh')}}" 
						title="so sánh sản phẩm">
						<i class="fas fa-retweet"></i>
						<p>So Sánh Sản Phẩm (<span class="totalCompare">{{$productNumberInTheCompare}}</span>)</p>
					</a>
				</div>
				<div class="myaccount col-top">
					<a href="{{asset('/tai-khoan')}}" title="My Account" 
						class="account">
						<i class="fa fa-user"></i>
						<i class="fas fa-caret-down"></i>
					</a>
					<ul class="mb login">
						<li>
							<a href="{{asset('/dang-nhap')}}" 
								title="Đăng Nhập">Đăng Nhập</a>
						</li>
						<li>
							<a href="{{asset('/dang-ky')}}" 
								title="Đăng Ký">Đăng Ký</a>
						</li>
					</ul>
				</div>
				<div class="langauge col-top">
					<img src="{{$icons.'vn_vert09.gif'}}" alt="ngôn ngữ Việt Nam">
					<i class="fas fa-caret-down"></i>
				</div>
			</div>
			<div id="topbar-contact">
				<div class="topbar-contact-email"><h3>Email: <a title="Email: vinakitchen.net@gmail.com " href="mailto:vinakitchen.net@gmail.com">vinakitchen.net@gmail.com</a></h3></div>
				<div class="topbar-contact-zalo">
					<h3>zalo : A.Dương: 
						<a title="zalo 0969 578 901" href="https://zalo.me/0969578901"> 0969 578 901</a>
					</h3>
				</div>
				<div class="topbar-contact-zalo">
					<h3>- A.Cường:
						<a title="zalo 0943 148 666" href="https://zalo.me/0943148666"> 0943 148 666</a>
					</h3>
				</div>
			</div>
		</div>
		<div id="topbar-bottom" class="w100min">
			<div id="logo" class="col50">
				@if(isset($logotext))
					<h1>
						<a href="{{asset('/')}}" 
							title="Trang Chủ Tủ Đông Inox Nhà Hàng">{{$logotext}}</a>
					</h1>
				@else
					<a href="{{asset('/')}}" title="Trang Chủ Tủ Đông Inox Nhà Hàng">
						<img src="{{$infoweb['imglogo']}}" 
							alt="logo Trang Chủ Tủ Đông Inox Nhà Hàng">
					</a>
				@endif
			</div>
			<div id="topbar-bottom-right" class="col50">
				<div class="search">
					<form action="/" method="get" class="w100min" id="form-search">
						<input type="text" name="searchtxt" placeholder="Tìm Kiếm...">
						<button type="submit"><i class="fas fa-search"></i></button>
					</form>
				</div>
				<div class="cart">
					<h3 class="wh100">
						<a class="wh100" href="{{asset('/gio-hang')}}"><span class="cart-item" data-cart='{{$productNumberInTheCart}}'>{{$productNumberInTheCart}}</span> Sản phẩm - <span class="cart-price" data-price='{{0}}'>{{'0'}}</span> vnđ</a>
					</h3>
				</div>
			</div>
		</div>
	</div>
	<div id="menu" class="hide-mobile w100min">
		<ul class="nav-bar">
			@foreach($listCategory as $category)
			@if($category['pathCt']=='trang-chu' || $category['pathCt']=='home' || $category['pathCt']=='tin-tuc')
			<li>
				<h3><a href="{{asset('/'.str_replace(['trang-chu','home'],'',$category['pathCt']))}}" 
					title="{{$category['titleCt']}}">{{$category['titleCt']}}</a>
				</h3>
			</li>
			@else
			<li @if(count($category['children'])>0) class="parent" @endif>
				<h3><a href="{{$urlcate.$category['pathCt']}}" 
					title="{{$category['titleCt']}}">{{$category['titleCt']}}</a>
				</h3>
				@if(count($category['children'])>0)
					<ul>
					@foreach($category['children'] as $subcategory)
						<li>
							<h3>
								<a href="{{$urlcate.$subcategory['pathCt']}}" title="{{$subcategory['titleCt']}}">{{$subcategory['titleCt']}}</a>
							</h3>
						</li>
					@endforeach
					</ul>
				@endif
			</li>
			@endif
			@endforeach
		</ul>
	</div>
	<div id="wrapper" class="w100min">
		<div class="col25-p first">
			<h4 class="nametext">Miễn Phí Giao Hàng.<br/>Trong Nội Thành Hà Nội</h4>
		</div>
		<div class="col25-p">
			<h4 class="nametext">Chính Sách Đổi Trả Dễ Dàng.<br/>Không lo Hàng Giả, Hàng Nhái</h4>
		</div>
		<div class="col25-p">
			<h4 class="nametext">Bảo Hành Dài Hạn.<br/>12 Tháng Bảo Hành Lỗi Kỹ Thuật</h4>
		</div>
		<div class="col25-p last">
			<h4 class="nametext">HotLine 24/7<br/>Đội Ngũ Tư Vấn Luôn Sẵn Sàng</h4>
		</div>
	</div>
</div>