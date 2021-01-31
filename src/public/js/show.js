/**
 * --------------------------------------------------------------------------
 * Custom Javascript file didi.js
 * Version: 1.0
 * Copyright (c) 2021-present, Didi Baka,  All rights reserved
 * --------------------------------------------------------------------------
 */

function getTheatreAjax(){
	var location_id = $('#location_id').val();
	var url_location = '/get-theatre/'+location_id+'';

	$.ajax({
		url: url_location,
		type: 'GET',
		success: function(data) {
			console.log('Data from Ajax',data);
			$('#theatre_id').empty();
			$('#theatre_id').append('<option value="">Select Theatre</option>');
			$.each(data,function(key, value)
			{
				$('#theatre_id').append('<option value=' + key + '>' + value + '</option>');
			});

		},error: function(error) {
			$('#theatre_id').empty();
			$('#theatre_id').append('<option value="">Select Theatre</option>');
			console.log(error);
		}
	});
}