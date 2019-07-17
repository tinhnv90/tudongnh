<div id="war-banner" class="w100min">
	@foreach($threeBannerInHome as $banner)
	<div class="col33">
		<div class="warpper">
			<a href="@if($banner['pathBn']=='')# @else {{$banner['pathBn']}} @endif" class="w100min" title="{{$banner['nameBn']}}">
				<img class="wh100" src="{{$dir.$banner['get_images']['srcImg']}}" 
					alt="{{$banner['get_images']['altImg']}}">
			</a>
		</div>
	</div>
	@endforeach
</div>