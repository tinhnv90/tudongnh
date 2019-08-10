<div class="payment-viettinbank w100min">
	<div class="payment_active">
		<div class="w100min">
			<label>Số Thẻ :</label>
			<input type="text" name="cardNumber" placeholder="Gồm 16 hoặc 19 số không dấu không dấu '-'">
			@if($errors->has('cardNumber'))
				<span class="note">{{$errors->first('cardNumber')}}</span>
			@endif
		</div>
		<div class="w100min">
			<label>Ngày Phát Hành :</label>
			<input type="text" name="month" placeholder="Tháng">
			<span class="slash">/</span>
			<input type="text" name="year" placeholder="Năm">
			@if($errors->has('month'))
				<span class="note">{{$errors->first('month')}}</span>
			@endif
			@if($errors->has('year'))
				<span class="note">{{$errors->first('year')}}</span>
			@endif
		</div>
		<div class="w100min">
			<label>Tên In Trên Thẻ :</label>
			<input type="text" name="nameCard">
			@if($errors->has('nameCard'))
				<span class="note">{{$errors->first('nameCard')}}</span>
			@endif
		</div>
	</div>
</div>