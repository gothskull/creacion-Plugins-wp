jQuery(document).ready(function($){
	
	$('input[name=correo_jq]').blur(function(){

		$.ajax({

			type:'POST',
			action:'check_email_jquery',
			data:'correo_jq =' + $(this).attr('value'),
			url: ajaxurl,

			beforesend: function(){

				$('#emailInfo').html('Comprobando correo...');
			},

			success:function(data){

				if(data=='valid'){

					$('#emailInfo').html('Email valido');
					
				}else{

					$('#emailInfo').html('Email no valido');
				}
			}
		});

	});		


});