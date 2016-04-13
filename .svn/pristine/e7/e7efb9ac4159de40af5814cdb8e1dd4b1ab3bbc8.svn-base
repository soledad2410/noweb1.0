$(function(){
	$('#add-media').submit(function(event) {
		event.preventDefault();
		$.post('/cp/gallery/add-media', $(this).serialize(), function(data) {
			if (data.code == 'success') {
				var str = '<li data-rel="'+data.media.id+'"><figure><a href="'+data.media.image+'" class="fancybox" rel="gallery"><img src="'+data.media.image+'" alt="'+data.media.name+'"></a><figcaption><h3>'+data.media.name+'</h3><span>'+data.media.description+'</span><a class="btn btn-sm btn-info btn-edit" rel="group" href="javascript:;">Sửa</a><a class="btn btn-sm btn-danger btn-delete" rel="group" href="javascript:;">Xóa</a></figcaption></figure></li>';
				$('#media-list ul').prepend(str);
				$('#add-media').clearForm();
			};
		}, 'json');
	});
	// Show media edit form
	$('.btn-edit').live('click', function(event) {
		var id = $(this).parents('li').attr('data-rel');

		$.post('/cp/gallery/get-media',{id:id},function(rs)
		{
            if(typeof rs != 'undefined')
            {
                $('#edit-media').show();

                bindFormData('#edit-media',rs);
                $('#edit-image-thumb img').attr('src', rs.image);

                BootstrapDialog.show({
                    'title' : 'Sửa chi tiết ảnh',
                    'message' : $('#edit-media'),
                    onhide: function() {
                        location.reload();
                    },
                });
            }
        }, 'json');
	});
	// Media edit form submit
	$('#edit-media').submit(function(event) {
		event.preventDefault();
		$.post('/cp/gallery/save-media', $(this).serialize(), function(data) {
			showDialog(data);
		});
	});
	/** Delete **/
	$('a.btn-delete').live('click', function(event) {
    	var id = $(this).parents('li').attr('data-rel');
        BootstrapDialog.show({
            type: BootstrapDialog.TYPE_DANGER,
            title: 'Cảnh báo',
            message: 'Thông tin đã xóa sẽ không thể khôi phục lại',
            buttons: [{
                label: 'OK',
                cssClass: 'btn-primary',
                action: function(dialog){
                    dialog.close();
                    $.post('/cp/gallery/delete-media',
                        {id:id},
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