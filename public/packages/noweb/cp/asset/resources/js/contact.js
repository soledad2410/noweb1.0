$(function() {
    $('#view-contact').on('hidden.bs.modal', function () {
        location.reload();
    });
	/** Delete **/
	$('tbody a.delete').live('click', function(event) {
    	var id = $(this).attr('data-rel');
        BootstrapDialog.show({
            type: BootstrapDialog.TYPE_DANGER,
            title: 'Cảnh báo',
            message: 'Thông tin đã xóa sẽ không thể khôi phục lại',
            buttons: [{
                label: 'OK',
                cssClass: 'btn-primary',
                action: function(dialog){
                    dialog.close();
                    $.post('/cp/contacts/delete',
                        {id:id},
                        function(rs) {
                            if (rs.code == 'success') {
                            	$('tr[data-rel='+id+']').remove();
                            } else{
                            	showDialog(rs);
                            };
                        },'json'
                    )
                }
            },
                {
                    label: 'CANCEL',
                    cssClass: 'btn-warning',
                    action: function(dialog){
                        dialog.close();
                    }
                }
            ]
        });
    });

    /** Delete many **/
    $('button.remove').click(function(){
        BootstrapDialog.show({
            type: BootstrapDialog.TYPE_DANGER,
            title: 'Cảnh báo',
            message: 'Thông tin đã xóa sẽ không thể khôi phục lại',
            buttons: [{
                label: 'OK',
                cssClass: 'btn-primary',
                action: function(dialog){
                    dialog.close();
                    $.post('/cp/contacts/delete',
                        $('#contacts-list-form').serialize(),
                        function(rs) {
                            location.reload();
                        },'json'
                    )
                }
            },
                {
                    label: 'CANCEL',
                    cssClass: 'btn-warning',
                    action: function(dialog){
                        dialog.close();
                    }
                }
            ]
        });
    });
});