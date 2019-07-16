@extends('admins.frameadmin')
@section('title','Tin Tức')
@section('addlink','post')
@section('titlepage','Danh Sách Bài Đăng')
@section('stylesheet')
	<script type="text/javascript" src="{{asset('/public/js/admin/zomfileimg.js')}}">
	</script>
@stop
@section('container')
<form method="get" action="{{asset('/')}}" id="container-form-post">
		<ul>
			<li>
				<span class="sizecheckbox"><input type="checkbox" name="subcategory" value="id" id="checkbox-all"></span>
				<span class="w80">Hình Ảnh</span>
				<p class="w311">Tiêu Đề Bài Viết</p>
				<p>Người Đăng</p>
				<p>Ngày Đăng</p>
				<p>Thao Tác</p>
			</li>
			@foreach($listposts as $posts)
			<li>
				<span class="sizecheckbox">
					<input type="checkbox" name="subcategory" class="checkbox-record" value="{{$posts['idPost']}}">
				</span>
				<span class="pad0 zoom">
					<img alt="{{$posts['name']}}" 
						src="{{asset('/public').$posts['srcImg']}}">
				</span>
				<p class="w311">
					@if(strlen($posts['titlePost']) <95)
						{{$posts['titlePost']}}
					@else 
						{{substr($posts['titlePost'],0,-(strlen($posts['titlePost'])-95)).' ...'}}
					@endif
				</p>
				<p>{{$posts['name']}}</p>
				<p>{{date('d/m/Y',strtotime($posts['created_at']))}}</p>
				<p>
					<a href="/admin/post/edit-{{$posts['idPost']}}/{{csrf_token()}}">
						<img src="{{asset('/public/images/icons/edit-512.png')}}">
					</a>
				</p>
			</li>
			@endforeach
		</ul>
</form>
@include('Common.page')
@stop