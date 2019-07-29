@extends('admins.frameadmin')
@section('title','Thiết Lập Website')
@section('titlepage','Thiết Lập Website')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{$styleAdmin.'webseting.css'}}">
<script type="text/javascript" src="{{$scriptAdmin.'baseinfoweb.js'}}"></script>
@stop
@section('frameImages')
	@include('admins.choosefileimages')
@stop
@section('container')
<div class="tag-page w100min">
	<div class="tag padlr10"><h4 class="choose-tag tag1">Thông Tin Chung</h4></div>
	<div class="tag"><h4 class="tag2">Liên Hệ</h4></div>
	<div class="tag"><h4 class="tag3">Hình Ảnh</h4></div>
	<div class="tag"><h4 class="tag4">Analytics</h4></div>
	<div class="tag padlr10"><h4 class="tag5">Google Master Tool</h4></div>
	<div class="tag padlr10"><h4 class="tag6">Comment Facebook</h4></div>
</div>

<form id="infoweb" class="w100min" action="{{asset('/admin/webseting')}}" method="post">
	<div class="tag-infoweb w100min">
		<ul class="listlabel">
			<li><label>Tên Cửa Hàng<span class="start">*</span></label></li>
			<li><label>Title Page</label></li>
			<li class="adress-area"><label>Description</label></li>
			<li><label>KeyWork</label></li>
			<li><label>Giao Diện</label></li>
		</ul>
		<ul class="listinput">
			{{csrf_field()}}			
			<li>
				<input type="text" name="idinfoweb" value="{{$infoweb['idinfoweb']}}" hidden>
				<input type="text" name="nameweb" value="{{$infohtml[0]['descript']}}">
			</li>
			<li><input type="text" name="titlepage" value="{{$infoweb['metaTag']}}"></li>
			<li class="adress-area">
				<textarea name="description" rows="1">{{$infoweb['description']}}</textarea>
			</li>
			<li><input type="text" name="keywork" value="{{$infoweb['keyword']}}"></li>
			<li>
				<select name="listtheme">
				@foreach($listtheme as $_theme)
					<option @if($_theme["value"]==$infoweb["theme"]) selected @endif 
						value="{{$_theme['value']}}">
						{{$_theme['value']}}
					</option>
				@endforeach
				</select>
			</li>
		</ul>
	</div>
	<div class="tag-contact w100min tagnone">
		<ul class="listlabel">
			<li class="adress-area"><label title="Địa Chỉ Cửa Hàng">Địa Chỉ :</label></li>
			<li><label title="Địa Chỉ Email">Email :</label></li>
			<li><label title="Số Điện Thoại">HotLine :</label></li>
			<li><label title="Link Facebook">FaceBook :</label></li>
			<li><label title="Link Youtube">Youtube</label></li>
			<li><label title="Link Google">Google</label></li>
			<li><label title="Link Twitter">Twitter</label></li>
		</ul>
		<ul class="listinput">
			<li class="adress-area">
				<textarea name="adress" rows="4">{{$infoweb['adress']}}</textarea>
			</li>
			<li>
				<input type="text" name="email" placeholder="Email" 
					value="{{$infoweb['email']}}">
			</li>
			<li>
				<input type="text" name="phone" placeholder="Số Điện Thoại" 
				value="{{$infoweb['phone']}}">
			</li>
			<li>
				<input type="text" name="linkface" placeholder="Link Facebook" 
					value="{{$infoweb['facebook']}}">
			</li>
			<li>
				<input type="text" name="linkyoutube" placeholder="Link Youtube" 
					value="{{$infoweb['youtube']}}">
			</li>
			<li>
				<input type="text" name="linkgoogle" placeholder="Link Twitter" 
					value="{{$infoweb['google']}}">
			</li>
			<li>
				<input type="text" name="linktwitter" placeholder="Link Twitter" 
					value="{{$infoweb['twitter']}}">
			</li>
		</ul>
	</div>
	<div class="tag-images w100min tagnone">
		<div class="w100min logoweb">
			<p>Logo Cửa hàng :</p>
			<input type="text" name="imglogo" 
			value="{{$infoweb['imglogo']}}" hidden>
			<img class="openFileImages logo-web"
				src="{{$infoweb['imglogo']}}" name="imglogo">
			<span class="orlogo">Hoặc</span>
			<input type="text" name="logoName" 
				placeholder="Logo Bằng Chữ" value="{{$logotext}}">
		</div>
		<div class="w100min iconweb">
			<p>Icon :</p>
			<input type="text" name="imgicon" 
				value="{{$infoweb['imgicon']}}" hidden>
			<img class="openFileImages icon-web" 
				src="{{$infoweb['imgicon']}}" name="imgicon">
		</div>
	</div>
	<div class="tag-analytics w100min tagnone">
		<div class="listlabel">
			<label>Mã Theo Dõi Analytics</label>
		</div>
		<div class="listinput">
			<textarea name="analytic" rows="1">{{$infohtml[1]['value']}}</textarea>
		</div>
	</div>

	<div class="tag-mastertool w100min tagnone">
		<div class="listlabel">
			<label>Google Master Tool</label>
		</div>
		<div class="listinput">
			<textarea name="mastertool" rows="1">{{$infohtml[2]['value']}}</textarea>
		</div>
	</div>
	<div class="tag-appface w100min tagnone">
		<div class="listlabel">
			<label>App ID : </label>
			<label>script SDK : </label>
		</div>
		<div class="listinput">
			<input type="text" name="appidface" value="{{$infohtml[3]['descript']}}">
			<textarea name="facebook_sdk" rows="1">{{$infohtml[3]['value']}}</textarea>
		</div>
	</div>
	<div class="w100min submit-infoweb">
		<button type="submit">Lưu</button>
	</div>
</form>
@stop