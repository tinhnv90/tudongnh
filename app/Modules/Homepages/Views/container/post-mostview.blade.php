<div id="post" class="w100min">
	<div class="title-page bor-b">
		<h3><span>TIN TỨC NỔI BẬT</span></h3>
	</div>
	<div class="scoll">
		<ul>
		@foreach($listPostMostView as $posts)
			<li class="col-pro5">
				<div class="images w100min">
					<a class="wh100" href="{{$urlpost.$posts['pathPost']}}" 
						title="{{$posts['titlePost']}}">
						<img src="{{$dir.$posts['get_images']['srcImg']}}" 
							alt="{{$posts['get_images']['altImg']}}">
					</a>
				</div>
				<div class="content w100min">
					<h3 class="name w100min">
						<a href="{{$urlpost.$posts['pathPost']}}" 
							title="{{$posts['titlePost']}}">{{$posts['titlePost']}}</a>
					</h3>
					<div class="short-description w100min">
						<p>{{$posts['shortDescription']}}</p>
					</div>
					<div class="readmore w100min">
						<a href="{{$urlpost.$posts['pathPost']}}" 
							title="{{$posts['titlePost']}}">
							<i class="fas fa-angle-double-right"></i>
							<span>Xem Thêm</span>
						</a>
					</div>
				</div>
			</li>
		@endforeach
		</ul>
	</div>
</div>