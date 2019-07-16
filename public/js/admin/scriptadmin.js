function convert_PathUrl(alias) {
    var str = alias.toLowerCase();
    str = str.toLowerCase();
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a"); 
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e"); 
    str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i"); 
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o"); 
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u"); 
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y"); 
    str = str.replace(/đ/g,"d");
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`|-|{|}|\||\\/g," ");
    str = str.replace(/ + /g," ");
    str = str.trim(); 
    str=str.split(' ').join('-');
    return str;
}

$(document).ready(function(){
	$('#checkbox-all').click(function(){
		var ischeckbox_all_category=$(this).prop('checked');
		if (ischeckbox_all_category) {
			$('input[name="subcategory"]').prop('checked',true);
		}else{
			$('input[name="subcategory"]').prop('checked',false);
		}
	});

	$('#delete').click(function(){
		var selected_category=[];
		var isdelete=confirm('Bạn có thực sự muốn xóa điều này hay không!');
		if(isdelete){
			$('#container form input[class="checkbox-record"]').each(function(){
				if($(this).prop('checked'))
					selected_category.push($(this).attr('value'));
			});
			if (selected_category.length>0) {
				$.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              	});
				$.ajax({
			        type : 'POST',
			        url  : window.location.href+'/delete',
			        data : {delete_id : selected_category},
			        success :  function(data){
			        	alert(data.resuilt_delete);
			        	location.replace(window.location.href.slice(0, -1));
			        }
		        });
			}else
				alert('Bạn chưa chọn mục để xóa');
		}
	});

	//-------------------script admin-menu-add------------------
	$('#nav-tag li p').click(function(){
		$('#nav-tag li p').removeClass('click-nav-tag-admin-menu');
		$(this).addClass('click-nav-tag-admin-menu');

		$('.nav-tag-seting').css('display','none');
		$('.'+$(this).attr('name')).css('display','block');

		var selected_tag=$(this).attr('name');
		if(selected_tag=='Chung'){
			$('#tag1').css('display','block');
			$('#tag2').css('display','none');
			$('#tag3').css('display','none');

		}else if(selected_tag=='Dữ Liệu'){
			$('#tag2').css('display','block');
			$('#tag1').css('display','none');
			$('#tag3').css('display','none');
		}else if(selected_tag=='slide-seting'){
			$('.banner-seting').css('display','none');
			$('.slide-seting').css('display','block');
		}else if(selected_tag=='banner-seting'){
			$('.banner-seting').css('display','block');
			$('.slide-seting').css('display','none');
		}
		else{
			$('#tag3').css('display','block');
			$('#tag2').css('display','none');
			$('#tag1').css('display','none');
		}
	});

	$('#tag1 input[name="txtName_category"]').keyup(function(){
		$('#tag2 input[name="pathCt1"]').val(convert_PathUrl($(this).val()));
		$('#tag2 input[name="pathCt"]').val(convert_PathUrl($(this).val()));
	});

	$('#tag1 input[name="txtnamepro"]').keyup(function(){
		$('#tag2 input[name="pathPro"]').val(convert_PathUrl($(this).val()));
	});
	$('#tag1 input[name="txtnamepost"]').keyup(function(){
		$('#tag2 input[name="pathPost"]').val(convert_PathUrl($(this).val()));
	});


	//*****************************manage images*********************
	$('#manageimages li').click(function(){
		var checkboximg=$(this).contents().filter('input');
		if(checkboximg.attr('checked')){
			checkboximg.removeAttr('checked');
		}else checkboximg.attr('checked','checked');
	});

	$('.checkboxallimg').click(function(){
		var ischeckbox_all_category=$(this).prop('checked');
		if (ischeckbox_all_category) {
			$('.checkboximages').prop('checked',true);
		}else{
			$('.checkboximages').prop('checked',false);
		}
	});

	$('.deleteimages').click(function(){
		var listdel_sqlpathimg=[];
		var pathimg_delete_host=[];
		var isdelete=confirm('Bạn có thực sự muốn xóa điều này hay không!');
		if(isdelete){
			$('.checkboximages').each(function(){
				if($(this).prop('checked')){
					pathimg_delete_host.push($(this).attr('value'));
					listdel_sqlpathimg.push($(this).attr('name'));
				}
			});
		}
		if (listdel_sqlpathimg.length>0) {
			$.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              }
          	});
			$.ajax({
		        type : 'POST',
		        url  : window.location.origin+'/admin/images/delete',
		        data : {
		        	listdelete_sqlpathimg : listdel_sqlpathimg,
		        	listpathimg_host : pathimg_delete_host
		        },
		        success :  function(data){
		        	alert(data.resuilt_delete);
		        	location.replace(window.location.href);
		        }
	        });
		}else
			alert('Bạn chưa chọn mục để xóa');
	});

	$('#processingImg .refreshf5').click(function(){
		location.replace(window.location.href);
	});

	//************************UPLOAD IMAGES*******************
	//*********BY FORM
	$('.uploadimg').click(function(){
		var txtdestination=$(this).attr('name');
		var openfiledialog=document.getElementById('namefile');
		if(openfiledialog.dispatchEvent(new MouseEvent("click"))){
			$('#namefile').on('change', function(event) {
				document.getElementById('btnupload').dispatchEvent(new MouseEvent("click"));
			});
		}
	});
	//BY AJAX
	$('#uploadfile').click(function(){
    	$('#openfile-dialog').click();
	});
	$('#openfile-dialog').on('change', function(event) {
		upload(this);
		//function upload in choosefileimages
	});

	//************************END UPLOAD IMAGES*****************
	$('#processingImg .newfolder').click(function(){
		$.ajaxSetup({
          headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}});
		$.ajax({
	        type : 'POST',
	        url  : window.location.origin+'/admin/images/createfolder',
	        data : {
	        	pathdir : $(this).attr('name')
	        },
	        success :  function(data){
	        	if(data.resuilt_createfolder=='false')
	        		alert('Lỗi Khởi Tạo Thư Mục Mới');
	        	else 
	        		if (data.resuilt_createfolder=='') 
	        			location.replace(window.location.href);
	        		else
	        		alert(data.resuilt_createfolder);
	        }
        });
	});
	$('.uploadfileimages .newfolder').click(function(){
		$.ajaxSetup({
          headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}});
		$.ajax({
	        type : 'POST',
	        url  : window.location.origin+'/admin/images/createfolder-ajax',
	        data : {
	        	pathdir : $(this).attr('name')
	        },
	        success :  function(data){
	        	$('.uploadfileimages .refreshf5').click();
	        }
        });
	});

	var dblclickTitleFile=null;
	var oldAltImg='';
	$('#manageimages li p').dblclick(function(){
		$(this).contents().filter('span').css('display','none');
		$(this).contents().filter('input').css('display','block');
		oldAltImg=$(this).contents().filter('input').val();
		dblclickTitleFile=$(this);
	});
	$('#manageimages li p').keyup(function(){
		if(dblclickTitleFile != null){
			var txtinput=convert_PathUrl($(this).contents().filter('input').val());
			$(this).contents().filter('span').text(txtinput);
			$(this).contents().filter('input').attr('value',txtinput);
		}
	});
	

	$(document).click(function (e){
		if(dblclickTitleFile != null){
			var obj=e.target;
			var text_exist_title_update=true;
			if(obj!=dblclickTitleFile.contents().filter('input')[0]){
				var this_span=$(dblclickTitleFile).contents().filter('span');
				var this_input=$(dblclickTitleFile).contents().filter('input');
				//kiểm tra tên file/thư mục đẫ tồn tại hay chưa?
				$('.checkboximages').each(function(){
					if($(this_span).text()==$(this).attr('name')){
						$(this_input).val(oldAltImg);
						$(this_span).text(oldAltImg);
						alert('path url trùng nhau');
						text_exist_title_update=false;
						return text_exist_title_update;
					}
				});
				//hủy update nếu trùng tên file/folder
				this_span.css('display','block');
				this_input.css('display','none');
				if(!text_exist_title_update){
					dblclickTitleFile=null;
					return false;
				}
				
				var newAltImg=this_input.val();
				var newPathImg=convert_PathUrl(newAltImg);
				var newSrcImg=dblclickTitleFile.attr('value').replace(oldAltImg,'');
				$.ajaxSetup({
		          headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}});
				$.ajax({
			        type : 'POST',
			        url  : window.location.origin+'/admin/images/updatetitlefile',
			        data : {
			        	_newAltImg : newAltImg,
			        	_newPathImg : newPathImg,
			        	_newSrcImg : newSrcImg,
			        	_oldSrcImg : dblclickTitleFile.attr('value'),
			        	_oldAltimg : oldAltImg
			        },
			        success :  function(data){
			        	window.location.replace(window.location.href);
			        }
		        });
				numb=0;oldAltImg='';
				dblclickTitleFile=null;
			}
		}
	    
	});

	$('.copyclipboard').click(function(){
		var listcopyclipboard=[];
		var listpathImg=[];
		$('.checkboximages').each(function(){
			if($(this).prop('checked')){
				listcopyclipboard.push($(this).attr('value'));
				listpathImg.push($(this).attr('name'));
			}
		});
		if(listcopyclipboard.length>0){
			$.ajaxSetup({
	          headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
	    	});
			$.ajax({
		        type : 'POST',
		        url  : window.location.origin+'/admin/images/copyclipboard',
		        data : {
		        	listclipboard : listcopyclipboard,
		        	clipboardpathImg : listpathImg
		        },
		        success :  function(data){
		        	location.replace(window.location.href);
		        }
	        });
		}
	});

	$('.paste').click(function(){
		$.ajaxSetup({
          headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
      	});
		$.ajax({
	        type : 'POST',
	        url  : window.location.origin+'/admin/images/pasteclipboard',
	        data : {
	        	pathdest : $(this).attr('name')
	        },
	        success :  function(data){
	        	copy=0;
	        	alert(data.result_paste);
	        	location.replace(window.location.href);
	        }
        });
	});


	$('#nav-openfile .refreshf5').click(function(){
		$('.uploadfileimages .newfolder').attr('name',$('.img-open-folder').attr('name'));
		$.ajaxSetup({
          headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
      	});
      	$.ajax({
	        type : 'POST',
	        url  : window.location.origin+'/admin/images/refreshfolder',
	        data : {
	        	pathfolder : $('.img-open-folder').attr('name')
	        },
	        success :  function(data){
				var choosefolder=$('.img-open-folder').attr('name');
	        	$('#frameleft-folder li').each(function(){
					$(this).remove();
				});
				for (var i = 0; i < data.length; i++) {
					var parent=document.getElementById("frameleft-folder");

					var li=document.createElement('li');
	    			var name = document.createAttribute("name");
	                name.value = data[i];
	                li.setAttributeNode(name);

	                var space='---';
	                if(i==0)
	                	space='';
	                var srcimg=window.location.origin+'/public/images/icons/';
	                if(choosefolder==data[i]){
	                	srcimg+='folder-open.png';
	                }else{
	                	srcimg+='folder.ico';
	                }
	                var valuenameimg=data[i].split('/');
	                var p=document.createElement('p');
	                var text=document.createTextNode(space.repeat(valuenameimg.length-2));
	                p.appendChild(text);
	                li.appendChild(p);

	                var img=document.createElement('img');
	                var nameimg=document.createAttribute('name');
	                var src=document.createAttribute('src');
	                var class_=document.createAttribute('class');
	                nameimg.value=data[i];
	                src.value=srcimg;
	                class_.value='img-open-folder';
	                img.setAttributeNode(nameimg);
	                img.setAttributeNode(src);
	                if(choosefolder==data[i])
	                img.setAttributeNode(class_);
	                li.appendChild(img);

	                var p=document.createElement('p');
	                var text=document.createTextNode(valuenameimg[valuenameimg.length-1]);
	                p.appendChild(text);
	                li.appendChild(p);

	                parent.appendChild(li);
				}
	        }
        });
		$.ajax({
	        type : 'POST',
	        url  : window.location.origin+'/admin/choosefolder',
	        data : {
	        	pathfolder : $('.img-open-folder').attr('name')
	        },
	        success :  function(data){
				$('#frameright-images li').each(function(){
					$(this).remove();
				});
				for (var i = 0; i < data.listimages.length; i++) {
					var parent=document.getElementById("frameright-images");

	    			var li=document.createElement('li');
	    			var name = document.createAttribute("name");
	                name.value = data.listimages[i]['pathImg'];
	                var _class = document.createAttribute("class");
	                _class.value = 'deleteidimg'+data.listimages[i]['idImg'];
	                li.setAttributeNode(name);
	                li.setAttributeNode(_class);

	                var img=document.createElement('img');
	                var nameimg=document.createAttribute('name');
	                nameimg.value=data.listimages[i]['idImg'];
	                img.setAttributeNode(nameimg);
	                
	                var src=document.createAttribute('src');
	                src.value=window.location.origin+'/public'+data.listimages[i]['srcImg'];
	                img.setAttributeNode(src);
	                li.appendChild(img);

	                var p=document.createElement('p');
	                var text=document.createTextNode(data.listimages[i]['altImg']);
	                p.appendChild(text);
	                li.appendChild(p);

	                parent.appendChild(li);
				}
	        }
        });
	});

	$('#frameleft-folder').on("click", 'li img',function(){
		var src=window.location.origin+"/public/images/icons/";
		$('#frameleft-folder li img').attr('src',src+"folder.ico").
			removeClass('img-open-folder');

		$(this).attr('src',src+"folder-open.png").
			addClass('img-open-folder');
		$('input[name="namefileimages"]').val('');

		$('.uploadfileimages .newfolder').attr('name',$(this).attr('name'));

		var pathfolderImg=$(this).attr('name').replace('/images/','');
		$('#iddestination').attr('value',pathfolderImg);
		$('#iddestination').val('value',pathfolderImg);

		$.ajaxSetup({
          headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
      	});
		$.ajax({
	        type : 'POST',
	        url  : window.location.origin+'/admin/choosefolder',
	        data : {
	        	pathfolder : $(this).attr('name')
	        },
	        success :  function(data){
				$('#frameright-images li').each(function(){
					$(this).remove();
				});
				for (var i = 0; i < data.listimages.length; i++) {
					var parent=document.getElementById("frameright-images");

	    			var li=document.createElement('li');
	    			var name = document.createAttribute("name");
	                name.value = data.listimages[i]['pathImg'];
	                var _class = document.createAttribute("class");
	                _class.value = 'deleteidimg'+data.listimages[i]['idImg'];
	                li.setAttributeNode(name);
	                li.setAttributeNode(_class);

	                var img=document.createElement('img');
	                var nameimg=document.createAttribute('name');
	                nameimg.value=data.listimages[i]['idImg'];
	                img.setAttributeNode(nameimg);
	                
	                var src=document.createAttribute('src');
	                src.value=window.location.origin+'/public'+data.listimages[i]['srcImg'];
	                img.setAttributeNode(src);
	                li.appendChild(img);

	                var p=document.createElement('p');
	                var text=document.createTextNode(data.listimages[i]['altImg']);
	                p.appendChild(text);
	                li.appendChild(p);

	                parent.appendChild(li);
				}
	        }
        });
	});
    $('#frameright-images').on("click", 'li img',function(){
    	$('#frameright-images li img').removeClass('addborder');
    	$(this).addClass('addborder');
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
    $('input[name="namefileimages"]').keyup(function(){
    	if($(this).val()=='')
    		$('#frameright-images li').css('display','block');
    	else{
    		$('#frameright-images li').css('display','none');
    		$('#frameright-images li[name^="'+$(this).val()+'"]').css('display','block');
    	}
    });

    $('.deleteopenfileimages').click(function(){
		var isdelete=confirm('Bạn có muốn xóa file ảnh này không!?');
		if(isdelete){
			$.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              }
          	});
			$.ajax({
		        type : 'POST',
		        url  : window.location.origin+'/admin/images/deleteimages',
		        data : {
		        	idImgdelete : $('.addborder').attr('name'),
		        	srcimg : $('.addborder').attr('src').
		        				replace(window.location.origin+'/public','')
		        },
		        success :  function(data){
		        	$('.refreshf5').click();
		        }
	        });
		}
	});

	$('input[name="nameproducer"]').keyup(function(){
		var pathproducer=$(this).val();
		$('input[name="pathProducer"]').val(convert_PathUrl(pathproducer));
		$('input[name="pathProducer"]').attr('value',convert_PathUrl(pathproducer));
	});

	$('.logo-producer img').each(function(){
        $(this).css('margin-top','10px');
    });
    $('.addli').click(function(){
    	var nameclass=$(this).attr('name');
    	var numli=$('.li'+nameclass+' li:last-child').attr('name');
    	$('.li'+nameclass).append('<li name="'+(++numli)+'"></li>');
    	$('.li'+nameclass+' li:last-child').
    		load(window.location.origin+'/admin/banner/li-'+nameclass+'?add='+numli);
    });

    $('.listproduct-inhome select[name="showproducthome"]').change(function(){
    	$.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      	});
		$.ajax({
	        type : 'POST',
	        url  : window.location.origin+'/admin/menu/update-showproducthome',
	        data : {
	        	idcategory : $(this).attr('data-idcategory'),
	        	showproducthome : $(this).val()
	        },
	        success :  function(data){
	        	location.replace(window.location.href);
	        }
        });
    });
});