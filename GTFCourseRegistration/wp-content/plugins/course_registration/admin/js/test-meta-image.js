// Inserts the image ULR into meta box text field when selected from the Media Library.
jQuery(document).ready(function($){
	var formfield = null;
	$('#upload_image_button').click(function(){
		$('html').addClass('Image');
		formfield = $('#test_mbe_image').attr('name');
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		return false;
	});

	// user inserts image URL into post
	window.orginal_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html){
		var fileurl;
		if(formfield != null){
			fileurl = $('img' ,html).attr('src');
			$('#test_mbe_image').val(fileurl);
			tb_remove();
			$('html').removeClass('Image');
			formfield = null;
		}
		else {
			window.original_send_to_editor(html);
		}
	};

});