@extends('admins.frameadmin')
@section('title','Giới Thiệu')
@section('addlink','product')
@section('titlepage','Giới Thiệu Công Ty')
@section('stylesheet')
<script type="text/javascript" src="{{asset('/public/ckeditor/ckeditor.js')}}"></script>
<style type="text/css">
	#container form span{
		height: unset !important;
	    border: unset;
	    padding-top: unset;
	    padding-left: unset;
	}
	#cke_1_top{
    	width: calc(100% - 8px) !important;
	}
	#cke_1_contents{
	    height: 400px !important;
	    width: 100%;
	}
	.btnsubmit{
		text-align: center;
	}
	.btnsubmit button{
	    width: 200px;
	    height: 25px;
	    float: unset !important;
	    margin: 30px auto;
	}
	#show-introduce{
		padding:20px 0px;
	}
</style>
@stop
@section('container')
	<div id="show-introduce" class="w100min">
		<?php echo $container_introduce; ?>
	</div>
	<div id="conten-introduce" class="w100min">
		<form action="{{asset('/admin/introduce')}}" 
			method="post" class="w100min">
			{{csrf_field()}}
			<textarea name="introduce" id="container-introduce" 
				rows="500" cols="550">
				<?php echo $container_introduce; ?>
			</textarea>
			<script type="text/javascript">
				CKEDITOR.replace('introduce');
			</script>
			<div class="btnsubmit w100min">
				<button type="submit" name="btnintroduce">Lưu</button>
			</div>
		</form>
	</div>
@stop