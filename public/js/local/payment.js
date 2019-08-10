$(document).ready(function(){
	$('.bankplus>div>img').click(function(){
		var url=window.location.origin+'/'+$(this).attr('title');
		$.ajaxSetup({headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}});
		$.ajax({
            type : 'POST',
            url  : url,
            success :  function(data){
            }
        });
	});
	$('input[name="payment_type"]').click(function(){
		var url=window.location.origin+'/'+$(this).val();
		$('.payment-form').load(url);
	});
});