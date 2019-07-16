<div class="num-row">
	<p>{{$_GET['add']}}</p>
	<input type="text" name="idslide{{$_GET['add']}}" 
		value="0" hidden>
</div>
<div class="col-title">
	<input type="text" name="nameslide{{$_GET['add']}}" 
		value="name slide {{$_GET['add']}}">
</div>
<div class="col-href">
	<input type="text" name="pathslide{{$_GET['add']}}" 
		value="pathslide {{$_GET['add']}}">
</div>
<div class="col-images">
	<img src="{{asset('/public/images/icons/error-images.png')}}"
		class="openFileImages slideseting"
		name="slide{{$_GET['add']}}">
	<input type="text" name="slide{{$_GET['add']}}" 
		value="242" hidden>
</div>
<div class="col-status">
	<select name="status_slide{{$_GET['add']}}">
		<option value="1">Bật</option>
		<option value="0">Tắt</option>
	</select>
</div>
