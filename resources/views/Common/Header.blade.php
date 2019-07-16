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
				<p><a href="{{asset('/')}}" title="thông tin giỏ hàng"><span class="cart-item">{{'0'}}</span> Sản Phẩm - <span class="cart-price">{{'0'}}</span> vnđ <i class="fas fa-shopping-cart"></i></a></p>
			</div>
		</div>
		<div id="category-mobile">
			<ul class="w100min">
				<li class="w100min"><h3><a class="nametext" href="{{asset('/')}}" title="{{'category name'}}">{{'category name'}}</a></h3></li>
				<li class="w100min"><h3><a class="nametext" href="{{asset('/')}}" title="{{'category name'}}">{{'category name'}}</a></h3></li>
				<li class="w100min"><h3><a class="nametext" href="{{asset('/')}}" title="{{'category name'}}">{{'category name'}}</a></h3></li>
				<li class="w100min"><h3><a class="nametext" href="{{asset('/')}}" title="{{'category name'}}">{{'category name'}}</a></h3></li>
				<li class="w100min"><h3><a class="nametext" href="{{asset('/')}}" title="{{'category name'}}">{{'category name'}}</a></h3></li>
			</ul>
		</div>
	</div>
	<div id="topbar" class="hide-mobile w100min">
		<div id="topbar-top" class="w100min">
			<div class="container">
				<div class="check-cart col-top">
					<a href="cart">Giỏ Hàng</a>
				</div>
				<div class="myaccount col-top">
					<a href="{{asset('/myaccount')}}" title="My Account" class="account">
						<i class="fa fa-user"></i>
						<i class="fas fa-caret-down"></i>
					</a>
					<ul class="mb login">
						<li><a href="/login" title="Đăng Nhập">Đăng Nhập</a></li>
						<li><a href="/register" title="Đăng Ký">Đăng Ký</a></li>
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
				<h1><a href="{{asset('/')}}" title="Trang Chủ">TuDongNhaHang.Com</a></h1>
			</div>
			<div id="topbar-bottom-right" class="col50">
				<div class="search">
					<form action="/" method="get" class="w100min" id="form-search">
						<input type="text" name="searchtxt" placeholder="Tìm Kiếm...">
						<button type="submit"><i class="fas fa-search"></i></button>
					</form>
				</div>
				<div class="cart">
					<h3><span class="cart-item" data-cart='{{"0"}}'>{{'0'}}</span> Sản phẩm - <span class="cart-price" data-price='{{0}}'>{{'0'}}</span> vnđ</h3>
				</div>
			</div>
		</div>
	</div>
	<div id="menu" class="hide-mobile">
		<ul class="nav-bar">
			<li>
				<h3><a href="#">Trang chủ</a></h3>
			</li>
			<li>
				<h3><a href="#">Trang chủ</a></h3>
			</li>
			<li class="parent">
				<h3><a href="#">Trang chủ</a></h3>
				<ul>
					<li><h3><a href="#">Trang chủ</a></h3></li>
				</ul>
			</li>
			<li>
				<h3><a href="#">Trang chủ</a></h3>
			</li>
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