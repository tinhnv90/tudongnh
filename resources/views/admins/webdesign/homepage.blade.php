@extends('admins.frameadmin')
@section('title','Thiết Kế Web')
@section('addlink','designweb')
@section('titlepage','Thết Kế Trang Chủ')
@section('stylesheet')
<link rel="stylesheet" type="text/css" 
	href="{{asset('/public/css/admin/webdesign.css')}}">
<script type="text/javascript" 
	src="{{asset('/public/js/admin/webdesign.js')}}"></script>
@stop
@section('frameImages')
	@include('admins.choosefileimages')
@stop
@section('container')
<div id="config-style-body" class="w100min">
	<div>
		<label>Style Sheet body </label>
		<textarea name="stylebody"></textarea>
		<button>Lưu</button>
	</div>
</div>
<div id="config-content-home">
	@include("admins.webdesign.frame_edit_css")
	<div class="edit edit{{$parentchild['idComponent']}}_{{$parentchild['orderComp']}}">
		<div class="action">
			<p class="insert" name="{{$parentchild['idComponent']}}_{{$parentchild['orderComp']}}" attrid="{{$parentchild['idComponent']}}" title="insert node">+</p>
			<p class="delete delete1" name="{{$parentchild['idComponent']}}_{{$parentchild['orderComp']}}" attrid="{{$parentchild['idComponent']}}" pathdelete="{{$parentchild['idComponent']}}" title="delete node">x</p>
			<p class="update" name="{{$parentchild['idComponent']}}_{{$parentchild['orderComp']}}" attrid="{{$parentchild['idComponent']}}" title="update node">i</p>
			<input type="text" name="class{{$parentchild['idComponent']}}_{{$parentchild['orderComp']}}" title="class" 
				placeholder="class name" class="input-class">
		</div>
	</div>
	<div class="parent-wh {{$parentchild['idComponent']}}_{{$parentchild['orderComp']}}">
		<input type="text" name="div{{$parentchild['idComponent']}}_{{$parentchild['orderComp']}}" value="{{$parentchild['idComponent']}}" hidden>
		
	</div>
</div>
@stop