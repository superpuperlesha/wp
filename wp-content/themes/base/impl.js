//======
// $(document).on('change', '#xxx', function(){
	
// });


//===BOOTSTRAPE # tooltip===
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});

var Loading = '<center><h3>Loading...</h3><br/><img src="'+WPThemeURL+'img/loading.gif"></center>';

jQuery(document).ready(function($){
	
	//===set focus for all windows===
	$('.modal').on('shown.bs.modal', function() {
		$('#xxx').focus();
	})
	
	
	//===click on key opener form===
	$(document).on('click', '.xxx', function(){
		$('#xxx').modal();
	});
	
	
	//===xxx===
	$(document).on('click', '#tt_user_action_plantime_start', function(){
		$('#xxx').html(Loading);
		
		var fromto  = $('#xxx').val();
		
		$.ajax({
			type: 'POST',
			url:  WPajaxURL,
			data: {
					action:   'xxx',
					stfromto: fromto,
				  },
			success:     function(data, textStatus, XMLHttpRequest) {
				$('#xxx').html(data);
			},
			error: function(MLHttpRequest, textStatus, errorThrown) {
				alert(errorThrown);
			}
		});
	});
});