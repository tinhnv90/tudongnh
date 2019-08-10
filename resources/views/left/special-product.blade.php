@if(isset($listSpecialProduct))
<div id="special-product" class="w100min bor-box">
	<div class="title-page">
		<h3>SẢN PHẨM NỔI BẬT</h3>
	</div>
	<?php if(!isset($numrowpro)) $numrowpro=5; ?>
	<div class="war-special w100min @if(count($listSpecialProduct)>$numrowpro) scroll-y @endif">
	<ul class="w100min">
		@foreach($listSpecialProduct as $product)
			<li class="w100min bor-b">
				<div class="content">
					<h3 class="w100min"><a href="{{$product['pathPro']}}" 
						title="{{$product['namePro']}}">{{$product['namePro']}}</a>
					</h3>
					<h4 class="w100min">Liên Hệ</h4>
					<div class="w100min rating">
						<i class="fas fa-star star1"></i>
						<i class="fas fa-star star2"></i>
						<i class="fas fa-star star3"></i>
						<i class="fas fa-star star4"></i>
						<i class="fas fa-star-half-alt star5"></i>
					</div>
				</div>
				<div class="images">
					<a class="wh100" href="{{$urlpro.$product['pathPro']}}" 
						title="{{$product['namePro']}}">
						<img src="{{$dir.$product['get_images']['srcImg']}}" 
							alt="{{$product['get_images']['altImg']}}" class="wh100">
					</a>
				</div>
			</li>
		@endforeach
	</ul>
	</div>
</div>
@endif