$(function(){
	// Append Widget properties to form
	$('.add_widget_type_properties').click(function(event) {
		var content = $('#form-properties').html();
		$('.form-properties').append(content);
	});
	// Remove widget properties from form
	$('.remove-properties').live('click', function(event) {
		$(this).parents('.properties-content').remove();
	});
	// Submit add form
	$('#add-type-properties').submit(function(event) {
		event.preventDefault();
		var form  = $(this);
		$.post('/cp/widget-type/create', $(this).serialize(), function(data) {
			if (data.code == 'success') {
				data.redirect = '/cp/widget-type/edit/'+data.id;
                showSuccessDialog(data);
			} else {
				showDialog(data);
                $(form).bindErrors(data.errors);
			};
		});
	});
	// Submit edit form
	$('#edit-type-properties').submit(function(event) {
		event.preventDefault();
		var form  = $(this);
		var id = $(this).find('input[name=id]').val();
		$.post('/cp/widget-type/edit/'+id, $(this).serialize(), function(data) {
			if (data.code == 'success') {
				location.reload();
			} else {
				showDialog(data);
                $(form).bindErrors(data.errors);
			};
		});
	});
	// Delete a widget properties
	$('.delete').live('click', function(event) {
        var id = $(this).attr('data-rel');
        var el = $(this);
        BootstrapDialog.confirm('Xóa thông tin ', function(confirm)
        {
            if(confirm){
                $.post(
                    '/cp/widget-type/delete',
                    {id:id},
                    function(rs)
                    {
                        if(typeof rs.code != 'undefined')
                        {
                            if(rs.code == 'success')
                            {
                                $(el).parent().parent().remove();
                            } else {
                                showDialog(rs);
                            }
                        }
                    },'json'
                )
            }
            else
            {
                return;
            }
        });

    });
});