<div id="slideshow" class="slide bor-box">
	<ul class="w100min">
	@foreach($listslide as $slide)
		<li class="w100min">
			<a href="{{$slide['pathBn']}}" title="{{$slide['nameBn']}}">
				<img src="{{$dir.$slide['get_images']['srcImg']}}" 
					alt="{{$slide['get_images']['altImg']}}">
			</a>
		</li>
	@endforeach
	</ul>
</div>