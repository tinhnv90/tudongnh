<div class="frame-edit-css" data-styleid=''>
	<p class="exits-style m-pointer">x</p>
	<div class="title-page">
		<h2>Edit Row</h2>
	</div>
	<div class="tag-bar">
		<ul class="w100min">
			<li class="active" data-class="General"><p>General</p></li>
			<li data-class="Background"><p>Background</p></li>
			<li data-class="Style"><p>Style</p></li>
			<li data-class="Font"><p>Font</p></li>
		</ul>
	</div>
	<ul class="General first">
		<li>
			<label>General name: </label>
			<input type="text" name="attrclass" placeholder="VD: 'class-1,class2'">
		</li>
		<li>
			<label>Youtube Link: </label>
			<input type="text" name="youtube_link">
		</li>
		<li>
			<label>Component: </label>
			<select name="componentid">
				<option value="0">None</option>
				<option value="1">component 1</option>
				<option value="2">component 2</option>
				<option value="3">component 3</option>
				<option value="4">component 4</option>
			</select>
		</li>
		<li>
			<label>Float : </label>
			<select name="floats">
				<option value="none">None</option>
				<option value="left">Left</option>
				<option value="right">Right</option>
				<option value="unset">Unset</option>
			</select>
		</li>
	</ul>
	<ul class="Background">
		<li>
			<label>Background color: </label>
			<input type="text" name="bkgcolor" placeholder="#fff">
		</li>
		<li class="bkgimages min-h">
			<label>Background Images: </label>
			<img src="{{asset('/public/images/icons/error-images.png')}}" 
				class="openFileImages m-pointer" name="bkgimages">
			<input type="text" name="bkgimages" value="242" hidden="">
		</li>
		<li>
			<label>Background Repeat: </label>
			<select name="bkgrepeat">
				<option value="none">None</option>
				<option value="repeat">Repeat</option>
				<option value="repeat-x">Repeat-X</option>
				<option value="repeat-y">Repeat-Y</option>
			</select>
		</li>
	</ul>
	<ul class="Style">
		<li>
			<label>Width : </label>
			<input type="text" name="width">
		</li>
		<li>
			<label>Height : </label>
			<input type="text" name="height">
		</li>
		<li class="min-h">
			<label>Box: </label>
			<div class="box-margin">
				<span class="box-name">Margin</span>
				<div class="w100min">
					<input class="unfloat" type="text" name="margin_top">
				</div>
				<div class="w100min">
					<input type="text" name="margin_left">
					<div class="box-border">
						<span class="box-name">Border</span>
						<div class="w100min">
							<input class="unfloat" type="text" name="border_top">
						</div>
						<div class="w100min">
							<input type="text" name="border_left">
							<div class="box-padding">
								<span class="box-name">Padding</span>
								<div class="w100min">
									<input class="unfloat" type="text" name="padding_top">
								</div>
								<div class="w100min">
									<input class="unfloat" type="text" name="padding_left">
									<input class="unfloat" type="text" name="padding_right">
								</div>
								<div class="w100min">
									<input class="unfloat" type="text" name="padding_bottom">
								</div>
							</div>
							<input type="text" name="border_right">
						</div>
						<div class="w100min">
							<input class="unfloat" type="text" name="border_bottom">
						</div>
					</div>
					<input type="text" name="margin_right">
				</div>
				<div class="w100min">
					<input class="unfloat" type="text" name="margin_bottom">
				</div>
			</div>
		</li>
		<li>
			<label>Border Style : </label>
			<select name="border_type">
				<option value="none">None</option>
				<option value="solid">solid</option>
				<option value="unset">Unset</option>
			</select>
		</li>
		<li>
			<label>Border Color: </label>
			<input type="text" name="border_color">
		</li>
		<li>
			<label>Border Radius: </label>
			<input type="text" name="border_radius">
		</li>
	</ul>
	<ul class="Font">
		<li>
			<label>Font Size : </label>
			<input type="text" name="font_size">
		</li>
		<li>
			<label>Font Weight : </label>
			<input type="text" name="font_weight">
		</li>
		<li>
			<label>Font Type : </label>
			<input type="text" name="font_type">
		</li>
		<li>
			<label>Color: </label>
			<input type="text" name="color">
		</li>
		<li>
			<label>Text Align: </label>
			<select name="text_align">
				<option value="left">Left</option>
				<option value="right">Right</option>
				<option value="center">Center</option>
			</select>
		</li>
	</ul>
	<div class="submit-save">
		<button id="submit-save-style">Lưu</button>
	</div>
</div>