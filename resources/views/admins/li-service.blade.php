<div class="num-row">
	<p>{{$_GET['add']}}</p>
	<input type="text" name="idservice{{$_GET['add']}}" 
		value="0" hidden>
</div>
<div class="col-title">
	<input type="text" name="nameservice{{$_GET['add']}}" 
		value="name service {{$_GET['add']}}">
</div>
<div class="col-href">
	<input type="text" name="pathservice{{$_GET['add']}}" 
		value="pathservice {{$_GET['add']}}">
</div>
<div class="col-images">
	<img src="{{asset('/public/images/icons/error-images.png')}}"
		class="openFileImages serviceseting"
		name="service{{$_GET['add']}}">
	<input type="text" name="service{{$_GET['add']}}" 
		value="242" hidden>
</div>
<div class="col-status">
	<select name="status_service{{$_GET['add']}}">
		<option value="1">Bật</option>
		<option value="0">Tắt</option>
	</select>
</div>
