<div id="special-article" class="w100min">
	<div class="first-artical w100min">
		<div class="images w100min">
			@if(isset($specialPost))
			<a href="{{$urlpost.$specialPost['pathPost']}}" 
				title="{{$specialPost['titlePost']}}" class="wh100">
				<img src="{{$dir.$specialPost['get_images']['srcImg']}}" 
					alt="{{$specialPost['get_images']['altImg']}}">
			</a>
			@else
			<a href="#" title="first- artical" class="wh100">
				<img class="wh100" src="{{asset('/public/images/banner/banner-may-bom-bun-4.jpg')}}" alt="{{'alt images'}}">
			</a>
			@endif
		</div>
		<div class="content w100min">
			<h2 class="w100min bor-b">
				<a href="{{$urlpost.$specialPost['pathPost']}}" 
					title="{{$specialPost['titlePost']}}">{{$specialPost['titlePost']}}</a>
			</h2>
		</div>
	</div>
	<div class="second-artical w100min">
		<h2 class="question w100min bor-b">
			<span><i class="fas fa-question-circle"></i></span>
			@if(isset($specialPost2))
			<a href="{{$urlpost.$specialPost2['pathPost']}}" 
				title="{{$specialPost2['titlePost']}}">{{$specialPost2['titlePost']}}</a>
			@else
			<a href="#" 
				title="Điều Gì Đặc Biệt Tại Tủ Đông inox Nhà Hàng?">Điều Gì Đặc Biệt Tại Tủ Đông inox Nhà Hàng?</a>
			@endif
		</h2>
		<h2 class="question w100min bor-b">
			@if(isset($specialPost3))
			<span><i class="fas fa-exclamation-circle"></i></span>
			<a href="{{$urlpost.$specialPost3['pathPost']}}" 
				title="{{$specialPost3['titlePost']}}">{{$specialPost3['titlePost']}}</a>
			@else
			<span><i class="fas fa-exclamation-circle"></i></span>
			<a href="#" title="Giới Thiệu Về Tủ Đông inox Nhà Hàng">Giới Thiệu Về Tủ Đông inox Nhà Hàng</a>
			@endif
		</h2>
	</div>
</div>