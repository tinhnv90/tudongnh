<div id="product-list-by-category" class="w100min">
	<div class="title-page bor-b">
		<h3>
			<span>
				<a href="{{$urlcate.$listProductOfCategory['pathCt']}}" 
					title="{{$listProductOfCategory['titleCt']}}">{{$listProductOfCategory['titleCt']}}</a>
			</span>
		</h3>
	</div>
	<?php $listproducts=$listProductOfCategory['listproduct']; ?>
	@include('Product.ListProducts')
</div>