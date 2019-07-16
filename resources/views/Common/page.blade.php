@if(isset($countproduct) && $countproduct > 0)
<?php
$sumPage=$countproduct/$productNumberDisplayed;
if($sumPage>(int)$sumPage)
	$sumPage=(int)(++$sumPage);
?>
<div id="page">
	<ul>
		@if($page>3)
		<li>
			<a href="{{$urlpage}}&page=1">
				<p><<</p>
			</a>
		</li>
		<li>
			<a href="{{$urlpage}}&page={{($page-1)}}">
				<p><</p>
			</a>
		</li>
		@endif
		@if($page-2>0)
		<li>
			<a href="{{$urlpage}}&page={{($page-2)}}">
				<p>{{($page-2)}}</p>
			</a>
		</li>
		@endif
		@if($page-1>0)
		<li>
			<a href="{{$urlpage}}&page={{($page-1)}}">
				<p>{{($page-1)}}</p>
			</a>
		</li>
		@endif
		<li>
			<a href="{{$urlpage}}&page={{$page}}">
				<p class="activepage">{{$page}}</p>
			</a>
		</li>
		@if($page+1<=$sumPage)
		<li>
			<a href="{{$urlpage}}&page={{($page+1)}}">
				<p>{{($page+1)}}</p>
			</a>
		</li>
		@endif
		@if($page+2<=$sumPage)
		<li>
			<a href="{{$urlpage}}&page={{($page+2)}}">
				<p>{{($page+2)}}</p>
			</a>
		</li>
		@endif
		@if($page+3<=$sumPage)
		<li>
			<a href="{{$urlpage}}&page={{($page+1)}}">
				<p>></p>
			</a>
		</li>
		<li>
			<a href="{{$urlpage}}&page={{($sumPage)}}">
				<p>>></p>
			</a>
		</li>
		@endif
	</ul>
</div>
@endif