<div class="num-row">
	<p>{{$_GET['add']}}</p>
	<input type="text" name="idcustom{{$_GET['add']}}" 
		value="0" hidden>
</div>
<div class="col-title">
	<input type="text" name="namecustom{{$_GET['add']}}" 
		value="name custom {{$_GET['add']}}">
</div>
<div class="col-href">
	<input type="text" name="pathcustom{{$_GET['add']}}" 
		value="path custom {{$_GET['add']}}">
</div>
<div class="col-images">
	<img src="{{asset('/public/images/icons/error-images.png')}}"
		class="openFileImages custombanner"
		name="custom{{$_GET['add']}}">
	<input type="text" name="custom{{$_GET['add']}}" 
		value="242" hidden>
</div>
<div class="col-status">
	<select name="status_custom{{$_GET['add']}}">
		<option value="1">Bật</option>
		<option value="0">Tắt</option>
	</select>
</div>
