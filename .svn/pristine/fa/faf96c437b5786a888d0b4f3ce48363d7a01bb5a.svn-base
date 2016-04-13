$(function(){
	// Append detail rating
	$('tbody').on('click','span',function()
    {
        var parent = $(this).parent();
        var tbody = $(this).parents('tbody');
        var thisPID = $(this).parents('tr').attr('data-rel');

        if($(parent).hasClass('close-detail'))
        {
            $(parent).removeClass('close-detail');
            $(tbody).find('tr[parent='+thisPID+']').hide();
        }
        else
        {
            $(parent).addClass('close-detail');
            if($(tbody).find('tr[parent='+thisPID+']').length > 0)
            {
                $(tbody).find('tr[parent='+thisPID+']').show();
            } else {
                var id = $(this).attr('data-value');
                $.post('/cp/product/get-review/'+id,{},function(rs)
                {
                    if(typeof rs != 'undefined')
                    {
                    	var content ='';
                    	for (var i = 0; i < rs.length; i++) {
                    		content +='<tr parent="'+rs[i].product_id+'" class="review-detail" rel="'+rs[i].id+'"><td class="center"><input type="checkbox" value="'+rs[i].id+'" name="id[]"></td><td class="text-right" colspan="3">'+rs[i].review_rating+'</td><td class="text-right" colspan="2">'+rs[i].created_at+'</td><td><div class="btn-group"><a data-toggle="dropdown" href="javascript:;">';
                            if (rs[i].review_status == 1) {
                            	content += '<i class="icon-ok"></i> Đã duyệt';
                            } else {
                            	content += '<i class="icon-remove"></i> Chưa duyệt';
                            };
                            content += '</a><ul class="dropdown-menu choose-edit btn-sm"><li><a href="javascript:;" data-rel="'+rs[i].id+'" onclick="change_status('+rs[i].id+', 1);"><i class="icon-ok"></i> Duyệt</a></li><li><a href="javascript:;" data-rel="'+rs[i].id+'" onclick="change_status('+rs[i].id+', 0);"><i class="icon-remove"></i> Bỏ duyệt</a></li><li class="divider"></li><li><a class="reply" data-rel="'+rs[i].id+'" href="javascript:;"><i class="icon-reply"></i> Trả lời</a></li><li><a class="delete" data-rel="'+rs[i].id+'" href="javascript:;"><i class="icon-remove"></i> Xóa</a></li></ul></div></td></tr>';
                    	};
                        $(parent).parent().after(content);
                    }
                },'json')
            }
        }
    });
	/** Delete **/
    $('tbody').on('click', 'a.delete',function()
    {
    	var id = $(this).attr('data-rel');
    	var thisTr = $(this).parents('tr');
        BootstrapDialog.show({
	        type: BootstrapDialog.TYPE_DANGER,
	        title: 'Cảnh báo',
	        message: 'Thông tin đã xóa sẽ không thể khôi phục lại',
	        buttons: [{
	            label: 'OK',
	            cssClass: 'btn-primary',
	            action: function(dialog){
	                dialog.close();
	                $.post(
	                    '/cp/product/delete-review',
	                    {id:id},
	                    function(rs)
	                    {
	                        if(typeof rs != 'undefined' && rs.code == 'success')
	                        {
	                            thisTr.remove();
	                        } else {
	                            showDialog(rs);
	                        }
	                    }
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
    /** Delete multi review **/
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
                    $.post('/cp/product/delete-review',
                        $('#form-list-reviews-table').serialize(),
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
    /** Show reply form **/
    $('tbody').on('click','.reply', function()
    {
        var id = $(this).attr('data-rel');
        var el = $(this);
        $.post('/cp/product/get-review/'+id,
            {},
            function(rs)
            {
                if(typeof rs != 'undefined')
                {
                    $('#reply-review').show();
                    $('#reply-review').find('.reviewer_name').text(rs.reviewer_name);
                    $('#reply-review').find('.review_text').text(rs.review_text);
                    $('#reply-review').find('input[name=id]').val(rs.id);
                    $('#reply-review').find('input[name=product_id]').val(rs.product_id);
                    BootstrapDialog.show({
                        'title' : 'Trả lời bình luận',
                        'message' : $('#reply-review'),
                        onhide: function(){
                            location.reload();
                        }
                    });
                }
            }
        );
    });
});

function change_status (pid, status)
{
    if(!isNaN(parseInt(pid)) && !isNaN(parseInt(status)))
    {
       var id = $(this).attr('rel');
       $.post('/cp/product/save-review/'+pid,
           {status:status},
           function(rs){
               if(typeof rs != 'undefined'  && rs.code == 'success')
               {
                   showDialog(rs);
               }
           },'json'
           );
   }
}