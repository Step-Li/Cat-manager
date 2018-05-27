$(document).on('submit','#upload_file', function(e) {
	e.stopPropagation(); 
	e.preventDefault();
	var form_data = new FormData($('#upload_file').get()[0]);
	$.ajax({
		url: 'ajax-for-submit.php',
		contentType: false,
		processData: false,
		data: form_data,
		type: $(this).attr('method'),
      	success: function(data){
      		$('#root').trigger('click');
			$('#root').trigger('click');
			$('#upload_file')[0].reset();
      	},
      	error: function(data){
        	console.log(data);
      	}
	});
});