<div id="product-list-by-category" class="w100min">
	<div class="title-page bor-b">
		<h3>
			<span>
				<a href="{{$urlcate.$category['pathCt']}}" 
					title="{{$category['titleCt']}}">{{$category['titleCt']}}</a>
			</span>
		</h3>
	</div>
	@if(isset($countproduct))
	<div id="filter" class="w100min bor-b">
		<form method="get" action="{{url()->current()}}" class="wh100">
			<div class="sort-product col50">
				<label>Sắp Xếp :</label>
				<select name="sortBy" @if(isset($disabled))disabled @endif>
					<option @if(isset($namePro_ASC)){{$namePro_ASC}}@endif value="namePro_ASC">Tên (A - Z)</option>
					<option @if(isset($namePro_DESC)){{$namePro_DESC}}@endif value="namePro_DESC">Tên (Z - A)</option>
					<option @if(isset($numview_ASC)){{$numview_ASC}}@endif value="numview_ASC">Cũ Nhất</option>
					<option @if(isset($numview_DESC)){{$numview_DESC}}@endif value="numview_DESC">Mới Nhất</option>
				</select>
			</div>
			<div class="display-number col50">
				<label>Hiển Thị : </label>
				<select name="limit" @if(isset($disabled))disabled @endif>
					<option @if(isset($_16)){{$_16}}@endif value="16">16</option>
					<option @if(isset($_32)){{$_32}}@endif value="32">32</option>
					<option @if(isset($_64)){{$_64}}@endif value="64">64</option>
					<option @if(isset($_96)){{$_96}}@endif value="96">96</option>
				</select>
			</div>
		</form>
	</div>
	@endif
	@include('Product.ListProducts')
	@if(isset($countproduct) && $countproduct>16)
		@include('Common.page')
	@endif
</div>