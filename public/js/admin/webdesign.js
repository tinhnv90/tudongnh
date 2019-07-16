$(document).ready(function(){
	$('.m-pointer').mouseover(function(){
		$(this).css('cursor','pointer');
	});

	$('#config-content-home').on('click','.insert',function(){
		var elementid=$(this).attr('attrid');
		var name=$(this).attr('name');
		var pathdelete=$(this).attr('pathdelete');
		for (var i = 1; i < 31; i++) {
			if(!$('div').hasClass(elementid+"_"+i)){
				$.ajaxSetup({
		          headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
		    	});
				$.ajax({
			        type : 'POST',
			        url  : window.location.origin+'/admin/webdesign/insertnode',
			        data : {
			        	elementid : elementid,
			        	order : i
			        },
			        success :  function(data){
						$('.'+name).append('<div class="w100min" name="'+elementid+'_'+i+'"></div>');
						$('.'+name+'>div:last-child').
							load(window.location.origin+
									'/admin/webdesign/append-child?attrid='+
									elementid+'&order='+i+'&id='+data+'&pathdelete='+pathdelete
								);
							var pathdelete=$('.delete'+data);
							pathdelete.attr('pathdelete',pathdelete+'/'+data);
			        }
		        });
				return true;
			}
		}
	});

	$('#config-content-home').on('click','.delete',function(){
		var name=$(this).attr('name');
		$.ajaxSetup({
          headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
    	});
		$.ajax({
	        type : 'POST',
	        url  : window.location.origin+'/admin/webdesign/deletenode',
	        data : {
	        	idcomp : $(this).attr('attrid')
	        },
	        success :  function(data){
				$('div[name="'+name+'"]').remove();
	        }
        });
	});

	

	$(".tag-bar ul li").click(function(){
		if(!$(this).hasClass('active')){
			$('.tag-bar>ul>li').removeClass('active');
			$(this).addClass('active');
			var tag_class_name=$(this).attr('data-class');
			$('.frame-edit-css .first').removeClass('first');
			$('.frame-edit-css .'+tag_class_name).addClass('first');
		}
	});
	$('.exits-style').click(function(){
		$('.frame-edit-css').css('display','none');
	});

	//****script frame chọn ảnh************************************
    var chooseimg='';
    $('#content-right').on("click", '.openFileImages',function(){
    	chooseimg=$(this).attr('name');
    	$('#framebackground').css('display','block');
    	$('#fre').css('display','block');
    });
    $('#frameright-images').on("dblclick", 'li img',function(){
    	var srcimg=$(this).attr('src');
    	var idimg=$(this).attr('name');
		$('input[name="'+chooseimg+'"]').attr('value',idimg);
		$('img[name="'+chooseimg+'"]').attr('src',srcimg);
		chooseimg='';
		
		$('#framebackground').css('display','none');
    	$('#fre').css('display','none');
    });
	$('.closeopenfile').click(function(){
		$('#framebackground').css('display','none');
		$('#fre').css('display','none');
	});
//*****end script frame chọn ảnh*************************
//*******update style sheet**************************
	$('#config-content-home').on('click','.update',function(){
		$('.frame-edit-css').css('display','block');
		var componentid=$(this).attr('attrid');
		
		$('.frame-edit-css').attr('data-styleid',componentid);
		getStyleSheet(componentid);
	});
	$('#submit-save-style').click(function(){
		$('.frame-edit-css').css('display','none');

		var componentid=$('.frame-edit-css').attr('data-styleid');
		updateStyleSheet(componentid,'data json');
	});

	function getStyleSheet(componentid){
		console.log('componentid - '+componentid);
	}
	function updateStyleSheet(componentid,jsondata){
		console.log('componentid - '+componentid+' : '+jsondata);
	}
//************End update style sheet****************
});