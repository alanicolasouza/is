/**
 * 
 */
jQuery(document).ready(function(){
	
	jQuery('#container .menu li').click(function(){
		var id = jQuery(this).attr('alt');
		jQuery('#container .content .form').css('display', 'none');
		jQuery('#container .content #'+id).css('display','block');
	});
	
	jQuery("div.buttomRadio").css('background-position', function(){
		if (jQuery('input#'+jQuery(this).attr('name')).val() == 1){
			return 'right';
		}
	}).click(function(){
		if (jQuery('input#'+jQuery(this).attr('name')).val() == 1){
			jQuery('input#'+jQuery(this).attr('name')).val('0');
			jQuery(this).css('background-position', 'left');
		}else{
			jQuery('input#'+jQuery(this).attr('name')).val('1');
			jQuery(this).css('background-position', 'right');
		}
	});
	
	jQuery("#container .content button.button").click(function(){
		var $this = jQuery(this).parent().parent();
		var formInput = $this.serialize();
		jQuery('#loading_admin').css('display','block').css('opacity',1);
		jQuery.ajax({
			type: 'POST',
			url: $this.attr('action'),
			data: formInput,
			context: document.body,
			dataType: 'json',
			success: function(data){
				jQuery('#loading_admin').css('display','none');
				if ( data.status == 'ok' ) 
					show_confirm( '' + data.message );
				if ( data.status == 'info' )
					show_info( '' + data.message );
				if ( data.status != 'info' && data.status != 'ok' )
					show_warning( '' + data.message );
			},
			error: function (error){
				jQuery('#loading_admin').css('display','none');
				show_error('Ocorreu um erro ao gravar os dados!<br />' +
						'&nbsp;&nbsp;&nbsp;&nbsp;Error : ' + error.status + 
						'<br />&nbsp;&nbsp;&nbsp;&nbsp;Error name : ' + error.statusText + 
						'<br />&nbsp;&nbsp;&nbsp;&nbsp;Content text : ' + error.responseText);
				console.log(error);
			}
		});
	});
});

/**
 * Mostra e adiciona conteudo a mensagem de confirm
 */
function show_confirm( html )
{
	var confirm = jQuery('#confirm');
	
	jQuery('#confirm > p:first-child').each(function(){
		
		confirm.css('display','block').animate({'opacity':1},1500);
		jQuery('#alerts').css('display','block');
		
		if ( jQuery(this).html() != '' )
			jQuery(this).append("\n<br/ >");
		
		jQuery(this).append(html);
	});
	return false;
}
/**
 * Mostra e adiciona conteudo a mensagem de info
 */
function show_info( html )
{
	var info = jQuery('#info');
	
	jQuery('#info > p:first-child').each(function(){
		
		info.css('display','block').animate({'opacity':1},1500);
		jQuery('#alerts').css('display','block');
		
		if ( jQuery(this).html() != '' )
			jQuery(this).append("\n<br/ >");
		
		jQuery(this).append(html);
	});
	return false;
}
/**
 * Mostra e adiciona conteudo a mensagem de warning
 */
function show_warning( html )
{
	var warning = jQuery('#warning');
	
	jQuery('#warning > p:first-child').each(function(){
		
		warning.css('display','block').animate({'opacity':1},1500);
		jQuery('#alerts').css('display','block');
		
		if ( jQuery(this).html() != '' )
			jQuery(this).append("\n<br/ >");
		
		jQuery(this).append(html);
	});
	return false;
}
/**
 * Mostra e adiciona conteudo a mensagem de error
 */
function show_error( html )
{
	var error = jQuery('#error');
	
	jQuery('#error > p:first-child').each(function(){
		
		error.css('display','block').animate({'opacity':1},1500);
		jQuery('#alerts').css('display','block');
		
		if ( jQuery(this).html() != '' )
			jQuery(this).append("\n<br/ >");
		
		jQuery(this).append(html);
	});
	return false;
}
/**
 * Fechar box de mensagem acionada
 */
function menssage_close( id )
{
	var obj = jQuery('#'+id);
	obj.animate({'opacity':0},1500,function(){
		jQuery('#'+id+' > p:first-child').html('');
		obj.css('display','none');
		verifica_closes();
	});
}
/**
 * Verifica se todos os box foram fechados
 */
function verifica_closes()
{
	var status = true;
	jQuery('#alerts > div').each(function(){
		if ( jQuery(this).css('display') != 'none' )
			status = false;
	});
	if ( status )
		jQuery('#alerts').css('display', 'none');
}
/**
 * Upload images
 */
jQuery(document).ready(function() {
	 
	jQuery('input.upload-img-w2p').click(function() {

		window.uniq_id = jQuery(this).attr('name');
		window.refid = jQuery(this).attr('refid');
		
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#' + window.refid ).val(imgurl);
			tb_remove();
		};
		
	 
		tb_show('', 'media-upload.php?post_id='+window.uniq_id+'&amp;type=image&amp;TB_iframe=true');
	 	return false;
	});
});
