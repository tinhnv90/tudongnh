$(document).ready(function(){
	function postAjax(pathname,json_parementer,callbackResult){
		var url=window.location.origin+'/admin/'+pathname;
		var jsonData={};
		$.ajaxSetup({headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}});
		$.ajax({
            type : 'POST',
            url  : url,
            data : json_parementer,
            success :  function(data){
            	callbackResult(data);
            }
        });
	}

	function callbackResult(data){
		alert(data.result+' done!');
	}
	$("button[name='save_warpper']").click(function(){
		var json_parementer={
			'war1_top':$("input[name='war1_top']").val(),
			'war1_bottom':$("input[name='war1_bottom']").val(),
			'war2_top':$("input[name='war2_top']").val(),
			'war2_bottom':$("input[name='war2_bottom']").val(),
			'war3_top':$("input[name='war3_top']").val(),
			'war3_bottom':$("input[name='war3_bottom']").val(),
			'war4_top':$("input[name='war4_top']").val(),
			'war4_bottom':$("input[name='war4_bottom']").val()
		};
		pathname='savewarpper';
		postAjax(pathname,json_parementer,callbackResult);
	});

	$("button[name='save_leftMain']").click(function(){
		var json_parementer={
			'leftMain1T':$("input[name='leftMain1T']").val(),
			'leftMain1B':$("input[name='leftMain1B']").val(),
			'leftMain2T':$("input[name='leftMain2T']").val(),
			'leftMain2B':$("input[name='leftMain2B']").val(),
			'leftMain3T':$("input[name='leftMain3T']").val(),
			'leftMain3B':$("input[name='leftMain3B']").val(),
			'leftMain4T':$("input[name='leftMain4T']").val(),
			'leftMain4B':$("input[name='leftMain4B']").val(),
			'leftMain5T':$("input[name='leftMain5T']").val()
		};
		pathname='saveContentLeft';
		postAjax(pathname,json_parementer,callbackResult);
	});

	//sản phẩm xem nhiều
	$("select[name='listproduct']").change(function(){
		var json_parementer={'idcategory':$(this).val()};
		pathname='saveListProduct';
		postAjax(pathname,json_parementer,callbackResult);
	});
	$("select[name='typelistproduct']").change(function(){
		var json_parementer={'productType':$(this).val()};
		pathname='saveListProduct';
		postAjax(pathname,json_parementer,callbackResult);
	});

	//danh sách sản phẩm chính của trang
	$("select[name='productMain']").change(function(){
		var json_parementer={'idcategory':$(this).val()};
		pathname='saveProductMain';
		postAjax(pathname,json_parementer,callbackResult);
	});

	//danh sách tin tức
	$("select[name='postType']").change(function(){
		var json_parementer={'postType':$(this).val()};
		pathname='savePostType';
		postAjax(pathname,json_parementer,callbackResult);
	});

	//specialPost
	$("select[name='specialPost']").change(function(){
		var json_parementer={'idPost':$(this).val()};
		pathname='savespecialPost';
		postAjax(pathname,json_parementer,callbackResult);
		var href=window.location.origin+'/admin/post/edit-';
		href+=$(this).val()+'/'+$("meta[name='_token']").attr('content');
		if($(this).val()==0) href=window.location.origin+'/admin/post/add';
		$(".post1>a:last-child").attr('href',href);
	});

	$("select[name='post2']").change(function(){
		var json_parementer={'idPost':$(this).val()};
		pathname='post2';
		postAjax(pathname,json_parementer,callbackResult);
		var href=window.location.origin+'/admin/post/edit-';
		href+=$(this).val()+'/'+$("meta[name='_token']").attr('content');
		if($(this).val()==0) href=window.location.origin+'/admin/post/add';
		$(".post2>a:last-child").attr('href',href);
	});
	$("select[name='post3']").change(function(){
		var json_parementer={'idPost':$(this).val()};
		pathname='post3';
		postAjax(pathname,json_parementer,callbackResult);
		var href=window.location.origin+'/admin/post/edit-';
		href+=$(this).val()+'/'+$("meta[name='_token']").attr('content');
		if($(this).val()==0) href=window.location.origin+'/admin/post/add';
		$(".post3>a:last-child").attr('href',href);
	});
});