@extends('admins.frameadmin')
@section('title','Danh Mục')
@section('addlink','images')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{asset('public/css/admin/style-manageimages.css')}}">
@stop
@section('titlepage')
	<p>Quản Lý Hình Ảnh</p><a href="{{asset('/admin/images')}}">images</a>
	<span>/</span>
@stop
@section('processingimg')
<form id="formupload" action="{{asset('/admin/images/uploadfie')}}" method="post" enctype="multipart/form-data" style="display: none;">
	{{csrf_field()}}
	<input type="file" multiple  accept=".png, .jpg, .jpeg, .ico" name="namefile[]" id="namefile">
	<input type="text" name="txtdestination" id="iddestination" value="">
	<button type="submit" name="btnupload" id="btnupload"></button>
</form>
<div id="processingImg">
	<span class="inpall"><input type="checkbox" class="checkboxallimg">chọn tất cả</span>
	<ul>
		@if(!Session::has('listclipboard'))
			<span id="ispaste"></span>
		@endif
		<li>
			<img title="New folder" class="newfolder" name="/" src="{{asset('public/images/icons/add_folder-512.png')}}">
			<p>New Folder</p>
		</li>
		<li>
			<img title="upload Images(<20 file/upload)" class="uploadimg" name="/" src="{{asset('public/images/icons/upload-file-icon-1776.png')}}">
			<p>Upload</p>
		</li>
		<li>
			<img title="Copy clipboard" class="copyclipboard" name="/" src="{{asset('public/images/icons/copy-icon.png')}}">
			<p>Cut</p>
		</li>
		<li>

			<img title="Paste" class="paste" name="/" src="{{asset('public/images/icons/paste.png')}}">
			<p>Paste</p>
		</li>
		<li>
			<img title="Delete Images/folder" class="deleteimages" src="{{asset('public/images/icons/document_delete.png')}}">
			<p>Delete</p>
		</li>
		<li>
			<img title="refresh" class="refreshf5" src="{{asset('public/images/icons/61bdgrp8g1l.png')}}">
			<p>Refresh</p>
		</li>
	</ul>
</div>
@stop
@section('container')
<ul id="manageimages">
	@foreach($scanfolder as $folders)
		@if(!is_file(public_path().'/images/'.$folders))
		<li>
			<input class="checkboximages" type="checkbox" name="{{$folders}}" 
				value="{{'/images/'.$folders}}">
			<a href="{{asset('/admin/images/'.$folders)}}">
				<div class="frameImg">
					<img src="{{asset('public/images/icons/folder-blue.png')}}">
				</div>
			</a>
			<p value="{{'/images/'.$folders}}"><span>{{$folders}}</span><input type="text" value="{{$folders}}"></p>
		</li>
	@else
		<li>
			<input class="checkboximages" type="checkbox" name="{{$folders}}" value="{{'/images/'.$folders}}">
			<div class="frameImg">
				<img src="{{asset('/public/images/'.$folders)}}">
			</div>
			<p value="{{'/images/'.$folders}}"><span>{{$folders}}</span><input type="text" value="{{$folders}}"></p>
		</li>
	@endif
	@endforeach
</ul>
@stop