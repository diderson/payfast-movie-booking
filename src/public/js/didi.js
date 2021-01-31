/**
 * --------------------------------------------------------------------------
 * Custom Javascript file didi.js
 * Version: 1.0
 * Copyright (c) 2021-present, Didi Baka,  All rights reserved
 * --------------------------------------------------------------------------
 */


 window.datatable = $('.datatable').DataTable({
 	"columnDefs": [ {
 		"targets": 'no-sort',
 		"orderable": false,
 	} ]
 });
 $('.datatable, .datatable_server').attr('style', 'border-collapse: collapse !important');

 $('.select-chosen').select2({
     theme: 'bootstrap'
 });

 $('.select-multiple').select2({
     theme: 'bootstrap'
 });

 $('#list-page').on('click', '.item-remove', function(e) {

 	e.preventDefault();

 	var token = $(this).attr("data-token");
 	var delete_url = $(this).attr("data-link");
 	swal({
 		title: 'Are you sure?',
 		type: 'warning',
 		showCancelButton: true,
 		confirmButtonColor: '#3085d6',
 		cancelButtonColor: '#d33',
 		confirmButtonText: 'Yes, Delete !',
 		cancelButtonText: 'Cancel'
 	}).then(function(result){
 		if (result.value) {
                //$.loadingBlockShow();
                $.ajax({
                	type: "POST",
                	url: delete_url,
                	data:{'_method':'DELETE', '_token':token},
                	success: function(data) {
                        console.log(data); // show response from the php script.
                        //$.loadingBlockHide();
                        //$('#'+item_hash).remove();
                        swal(
                        	'Deleted!',
                        	'The Entry has been deleted successfuly.',
                        	'success'
                        	);

                        $("#list-page").load(location.href +" #list-page", function(data) {
                        });

                    }, error: function(){
                    	swal({
                    		type: 'error',
                    		title: 'Oops...',
                    		text: 'Something went wrong!'
                    	})
                    }
                });
            }
        });
 });

 $('#list-page-datatable').on('click', '.item-remove', function(e) {

 	e.preventDefault();

 	var token = $(this).attr("data-token");
    //token = '{{ csrf_token() }}';
    var delete_url = $(this).attr("data-link");
    var the_row = $(this);
    //datatable.row( this ).delete();
    swal({
    	title: 'Are you sure?',
    	type: 'warning',
    	showCancelButton: true,
    	confirmButtonColor: '#3085d6',
    	cancelButtonColor: '#d33',
    	confirmButtonText: 'Yes, Delete !',
    	cancelButtonText: 'Cancel'
    }).then(function(result){
    	if (result.value) {
    		$.ajax({
    			type: "POST",
    			url: delete_url,
    			data:{'_method':'DELETE', '_token':token},
    			success: function(data) {
                        console.log(data); // show response from the php script.
                        //$('#'+item_hash).remove();
                        swal(
                        	'Deleted!',
                        	'The Entry has been deleted successfuly.',
                        	'success'
                        	);
                        //removing row in datatable
                        datatable.row(the_row.parents('tr')).remove().draw();

                    }, error: function(){
                    	swal({
                    		type: 'error',
                    		title: 'Oops...',
                    		text: 'Something went wrong!'
                    	})
                    }
                });
    	}
    });
});