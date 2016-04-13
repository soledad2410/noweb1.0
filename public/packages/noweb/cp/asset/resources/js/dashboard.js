/** Delete a comment **/
function delete_comment (id) {
	BootstrapDialog.show({
        type: BootstrapDialog.TYPE_DANGER,
        title: 'Cảnh báo',
        message: 'Thông tin đã xóa sẽ không thể khôi phục lại',
        buttons: [{
            label: 'OK',
            cssClass: 'btn-primary',
            action: function(dialog){
                dialog.close();
                $.post('/cp/news/delete-comment',
			        {id:id},
			        function(rs)
			        {
			            if (rs.code == 'success') {
			                location.reload();
			            } else{
			                showDialog(rs);
			            };
			        }
			    );
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
}