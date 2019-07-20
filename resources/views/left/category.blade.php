@if(isset($listCategory))
<div id="category-left" class="bor-box w100min">
	<div class="title-page bor-b">
		<h3>DANH MỤC SẢN PHẨM</h3>	
	</div>
	<?php if(!isset($idcategory)){ $idcategory=0; $idparent=0;} ?>
	<ul class="w100min">
		@foreach($listCategory as $category)
		@if($category['leveCt']==0)
			@if($category['pathCt']=='trang-chu' || $category['pathCt']=='home')
			<li>
				<h3 @if($category['idcategory']==$idcategory) class="active-nav" @endif>
					<i class="fas fa-angle-double-right" aria-hidden="true"></i>
					<a class="nametext" href="{{asset('/')}}" 
						title="{{$category['titleCt']}}">{{$category['titleCt']}}</a>
				</h3>
			</li>
			@elseif($category['typeCt']=='product')
			<li @if(0<count($category['children'])) class="parent" @endif>
				<h3 @if($category['idcategory']==$idcategory || $category['idcategory']==$idparent) class="active-nav" @endif>
					<i class="fas fa-angle-double-right" aria-hidden="true"></i>
					<a class="nametext" href="{{$urlcate.$category['pathCt']}}" 
						title="{{$category['titleCt']}}">{{$category['titleCt']}}</a>
				</h3>
				@if(count($category['children'])>0)
					<ul class="bor-box">
						@foreach($category['children'] as $children)
						<li>
							<h3 @if($children['idcategory']==$idcategory) class="active-nav" @endif>
								<i class="fas fa-angle-double-right" aria-hidden="true"></i>
								<a class="nametext" 
									href="{{$urlcate.$children['pathCt']}}" 
									title="{{$children['titleCt']}}">{{$children['titleCt']}}</a>
							</h3>
						</li>
						@endforeach
					</ul>
				@endif
			</li>
			@endif
		@endif
		@endforeach
	</ul>
	<?php unset($idcategory); ?>
</div>
@endif