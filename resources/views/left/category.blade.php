<div id="category-left" class="bor-box w100min">
	<div class="title-page bor-b">
		<h3>DANH MỤC SẢN PHẨM</h3>	
	</div>
	<ul class="w100min">
		@foreach($listCategory as $category)
		@if($category['leveCt']==0)
			@if($category['pathCt']=='trang-chu' || $category['pathCt']=='home')
			<li>
				<h3>
					<i class="fas fa-angle-double-right" aria-hidden="true"></i>
					<a class="nametext" href="{{asset('/')}}" 
						title="{{$category['titleCt']}}">{{$category['titleCt']}}</a>
				</h3>
			</li>
			@elseif($category['typeCt']=='product')
			<li>
				<h3>
					<i class="fas fa-angle-double-right" aria-hidden="true"></i>
					<a class="nametext" href="{{$urlcate.$category['pathCt']}}" 
						title="{{$category['titleCt']}}">{{$category['titleCt']}}</a>
				</h3>
			</li>
			@endif
		@endif
		@endforeach
	</ul>
</div>