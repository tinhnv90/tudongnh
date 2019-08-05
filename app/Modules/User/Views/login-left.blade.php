<div id="column-left" class="w100min bor-box">
	<div class="title-page bor-b">
		<h3><p>TÀI KHOẢN</p></h3>
	</div>
	<div class="content w100min">
		@if(!Auth::check())
		<h3>
			<i class="fas fa-angle-double-right"></i>
			<a href="{{asset('/dang-nhap')}}" title="Đăng Nhập">Đăng Nhập</a>
		</h3>
		<h3>
			<i class="fas fa-angle-double-right"></i>
			<a href="{{asset('/dang-ky')}}" title="Đăng Ký Tài Khoản">Đăng Ký</a>
		</h3>
		@endif
		<h3>
			<i class="fas fa-angle-double-right"></i>
			<a href="{{asset('/tai-khoan')}}" title="Thông Tin Khách Hàng">Thông Tin Khách Hàng</a>
		</h3>
		<h3>
			<i class="fas fa-angle-double-right"></i>
			<a href="{{asset('/lich-su-giao-dich')}}" 
				title="Lịch Sử Giao Dịch">Lịch Sử Giao Dịch</a>
		</h3>
		<h3>
			<i class="fas fa-angle-double-right"></i>
			<a href="{{asset('/thanh-toan')}}" title="Thanh Toán">Thanh Toán</a>
		</h3>
		@if(Auth::check())
		<h3>
			<i class="fas fa-angle-double-right"></i>
			<a href="{{asset('/dang-xuat')}}" title="Đăng Xuất">Đăng Xuất</a>
		</h3>
		@endif
	</div>
</div>