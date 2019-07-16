<!-- JavaScripts upload images by ajax-->
<script>
function upload(img){
	var form_data = new FormData();
    form_data.append('file', img.files[0]);
    form_data.append('_token', '{{csrf_token()}}');
    form_data.append('pathdes', $('.img-open-folder').attr('name'));
    $.ajax({
        url: "{{url('/admin/images/ajax-image-upload')}}",
        data: form_data,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function (data) {
        	$('.refreshf5').click();
        }
    });
}
</script>
<div id="framebackground"></div>
<div id="fre">
	<div id="frameImages" class="framebackground">
		<div class="title-page w100min">
			<h4>Quản Lý Hình Ảnh</h4>
			<span class="closeopenfile">x</span>
		</div>

<input type="file" accept=".png, .jpg, .jpeg, .ico" 
		name="file" hidden id="openfile-dialog">
<input type="hidden" id="file_name"/>

		<div id="nav-openfile" class="w100min">
			<div class="uploadfileimages">
				<ul class="w100min">
					<li>
						<img title="New folder" class="newfolder" name="/images" src="{{asset('public/images/icons/add_folder-512.png')}}">
						<p>New Folder</p>
					</li>
					<li>
						<img id="uploadfile" title="upload Images(<20 file/upload)" 
						src="{{asset('/public/images/icons/upload-file-icon-1776.png')}}" >
						<p>Upload</p>
					</li>
					<li>
						<img title="Delete Images/folder" class="deleteopenfileimages" 
						src="http://maybomhutbun.net/public/images/icons/document_delete.png">
						<p>Delete</p>
					</li>
					<li>
						<img title="refresh" class="refreshf5" src="http://maybomhutbun.net/public/images/icons/61bdgrp8g1l.png">
						<p>Refresh</p>
					</li>
				</ul>
			</div>
			<div class="searchfileimages">
				<input type="text" name="namefileimages" placeholder="Lọc Theo Tên và Mã Sản Phẩm">
				<button>Tìm Kiếm</button>
			</div>
		</div>
		<ul id="frameleft-folder">
			@foreach($listfolder as $key=>$folders)
				<li name="{{$folders}}">
					<p>{{str_repeat('---', count(explode('/',$folders))-2)}}</p>
					@if($key!=0)
						<img src="{{asset('/public/images/icons/folder.ico')}}" name="{{$folders}}">
					@else
						<img src="{{asset('/public/images/icons/folder-open.png')}}" 
						name="{{$folders}}" class="img-open-folder">
					@endif
					<p name='{{$folders}}'>
						<?php 
							$namefolder=explode('/', $folders);
							echo $namefolder[count($namefolder)-1]; 
						?>
					</p>
				</li>
			@endforeach
		</ul>
		<ul id="frameright-images">
			@foreach($listfile as $files)
				@if(is_file(public_path().'/images/products'.'/'.$files))
				<li name="{{$files}}" class="imgaes-{{$listidImg[$i]}}">
					<img src="{{asset('/public/images/'.$files)}}" name="{{$listidImg[$i]}}">
					<p>{{$files}}</p>
				</li>
				<?php $i++ ?>
				@endif
			@endforeach
		</ul>
	</div>
</div>