<div class="edit" name="{{$_GET['attrid']}}_{{$_GET['order']}}">
	<div class="action">
		<p class="insert" name="{{$_GET['attrid']}}_{{$_GET['order']}}" attrid="{{$_GET['id']}}">+</p>
		<p class="delete delete{{$_GET['id']}}" name="{{$_GET['attrid']}}_{{$_GET['order']}}"
			 attrid="{{$_GET['id']}}" pathdelete="">x</p>
		<p class="update" name="{{$_GET['attrid']}}_{{$_GET['order']}}" attrid="{{$_GET['id']}}">i</p>
		<input type="text" name="order{{$_GET['attrid']}}_{{$_GET['order']}}" 
			value="{{$_GET['order']}}" title="order" placeholder="order" class="input-order">
		<input type="text" name="class{{$_GET['attrid']}}_{{$_GET['order']}}" title="class" 
			placeholder="class name" class="input-class">
	</div>
</div>
<div class="parent-wh {{$_GET['attrid']}}_{{$_GET['order']}}">
	<input type="text" name="div{{$_GET['attrid']}}_{{$_GET['order']}}" value="{{$_GET['id']}}" hidden>
</div>