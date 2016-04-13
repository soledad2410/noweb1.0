$(function(){
    /** Show reply form **/
    $('tbody').on('click','.reply', function()
    {
        var id = $(this).attr('data-value');
        var el = $(this);
        $.post('/cp/news/get-comment',
            {id:id},
            function(rs)
            {
                if(typeof rs != 'undefined')
                {
                    $('#reply-comment').show();
                    $('#reply-comment').find('.fullname').text(rs.fullname);
                    $('#reply-comment').find('.content').text(rs.content);
                    $('#reply-comment').find('input[name=id]').val(rs.id);
                    $('#reply-comment').find('input[name=news_id]').val(rs.news_id);
                    $('#reply-comment').find('.news_name').text($('tr[rel='+id+']').find('td.news_name a').text());
                    BootstrapDialog.show({
                        'title' : 'Trả lời bình luận',
                        'message' : $('#reply-comment'),
                        onhide: function(){
                            location.reload();
                        }
                    });
                }
            }
        );
    });
    /** Delete a comment **/
    $('tbody').on('click','.delete', function()
    {
        var id = $(this).attr('data-value');
        var el = $(this);
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
    });
    /** Delete multi comments **/
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
                    $.post('/cp/news/delete-comment',
                        $('#comments-list-form').serialize(),
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
function change_status(id, status) {
    if(!isNaN(id))
    {
        $.post('/cp/news/edit-comment', {id:id,status:status}, function(data) {
            showDialog(data);
        });
    }
}