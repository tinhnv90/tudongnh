<div id="product-list-by-category" class="w100min">
	<div class="title-page bor-b">
		<h3>
			<span>
				<a href="{{$urlcate.$listProductOfCategory['pathCt']}}" 
					title="{{$listProductOfCategory['titleCt']}}">{{$listProductOfCategory['titleCt']}}</a>
			</span>
		</h3>
	</div>
	<div class="scoll">
		<ul>
		@foreach($listProductOfCategory['listproduct'] as $key=>$products)
			<li class="col-pro4 @if($key==3)unmar-right @endif">
				<div class="images w100min">
					<a class="wh100" href="{{$urlpro.$products['pathPro']}}" 
						title="{{$products['namePro']}}">
						<img src="{{$dir.$products['get_images']['srcImg']}}" 
							alt="{{$dir.$products['get_images']['altImg']}}">
					</a>
				</div>
				<div class="content w100min">
					<h3 class="name w100min">
						<a href="{{$urlpro.$products['pathPro']}}" 
							title="{{$products['namePro']}}">{{$products['namePro'].' - '.$products['idproduct']}}</a>
					</h3>
					<div class="detail w100min">
						@if($products['get_detail']['price']==0)
						<p class="w100min price bor-b">Liên Hệ</p>
						@else
						<p class="w100min price bor-b">{{number_format($sumprice).' vnđ'}}</p>
						@endif
						<div class="rating w100min">
							<i class="fas fa-star star1"></i>
							<i class="fas fa-star star2"></i>
							<i class="fas fa-star star3"></i>
							<i class="fas fa-star star4"></i>
							<i class="fas fa-star-half-alt star5"></i>
						</div>
						<div class="cart w100min" 
							data-idproduct="{{$products['idproduct']}}">
							@if(Session::has('productInTheCart') && Session::has('productInTheCart.'.$products['idproduct']))
								<h4 class="add-cart bor-box bkg-addcart" 
									data-price="{{$products['get_detail']['price']}}">Hủy</h4>
							@else
								<h4 class="add-cart bor-box" 
									data-price="{{$products['get_detail']['price']}}">Mua Hàng</h4>
							@endif

							@if(Session::has('productInTheCompare') && Session::has('productInTheCompare.'.$products['idproduct']))
								<span class="add-compare color-active">
									<i class="fas fa-subscript"></i>
								</span>
							@else
								<span class="add-compare">
									<i class="fas fa-retweet"></i>
								</span>
							@endif

							@if(Session::has('productInTheWishlist') && Session::has('productInTheWishlist.'.$products['idproduct']))
							<span class="add-wishlist color-active">
							@else
							<span class="add-wishlist">
							@endif
								<i class="fas fa-heart"></i>
							</span>
						</div>
					</div>
				</div>
			</li>
		@endforeach
		</ul>
	</div>
</div>