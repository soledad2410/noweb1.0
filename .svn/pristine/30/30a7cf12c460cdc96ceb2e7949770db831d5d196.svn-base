/**
 * Created by hung_it on 06/01/2015.
 */
$(function()
{
    /** go edit news page **/
    $('a.edit-news').click(function()
    {
            var id = $(this).attr('data-rel');
            goEditNewsPage(id);
    });

    /** Hide tag if it's selected **/
    var tags = $('input[name="tags"]').val();
    var selectedTagIds = tags.split('|');
    $('.tag-item').each(function(){
        var val = $(this).attr('data-value');
        if(inArray(val, selectedTagIds)){
            $(this).hide();
        }
    });

    /** Select tag item from popup **/
    var tags = $('input[name="tags"]').val();
    $('.tag-item').click(function()
    {
        var txt = $(this).text();
        var tagId = $(this).attr('data-value');

        tags += '|' + tagId;
        $('input[name="tags"]').val(tags);
        var el =  '<a style="margin:5px" class="btn btn-default btn-sm tag-item-remove" href="javascript:;" data-value="'+tagId+'"><i class="icon-minus"></i>'+txt+'</a>';
       $('#selected-tags').append(el);
        $(this).hide();
    });
    $('#selected-tags').on('click','.tag-item-remove', function()
    {
        var tagId = $(this).attr('data-value');
        var txt = $(this).text();
        var tagsArray = $('input[name="tags"]').val().split('|');
        var newArray = unsetItem(tagId, tagsArray);
        $('input[name="tags"]').val(newArray.join('|'));
        $(this).remove();
        $('.tag-item[data-value="'+tagId+'"]').show();
    });
    /** Category checkbox treeview **/
    $('.tree-view').checkboxTreeView();
    $('#news-list-table-compact').on('click','input',function()
    {
        addRelatedNews($(this));
    });
    $('.form-ajax-list-news').submit(function(e)
    {
        e.preventDefault();
        $('#ajax_category_id').val($('form.form-ajax-list-news').find('select[name="category_id"]').val());
        $('#ajax_keyword').val($('form.form-ajax-list-news').find('input[name="keyword"]').val());
        $.get('/cp/news/get',$(this).serialize(),function(rs)
        {
            if(rs.code == 'success')
            {
                if(typeof rs.data != 'undefined')
                {
                    var data = rs.data;
                    var content = ''
                    var selectedsIds =  $('#related_news').val().split('|');
                    for(i in data)
                    {
                        var status = '<i class="icon-archive"></i> Lưu nháp';
                        if(data[i].status == 1)
                        {
                            status = '<i class="icon-ok"></i> Đã đăng';
                        }
                        if (data[i].status == 2)
                        {
                            status = '   <i class="icon-circle-arrow-down"></i> Đã hạ';
                        }
                        if(inArray(data[i].id,selectedsIds))
                        {
                            content += '<tr rel="' + data[i].id + '" class="selected">';
                            content += '<td class="center"><input type="checkbox" value="' + data[i].id + '" name="id[]" checked="checked"></td>';
                        } else {
                            content += '<tr rel="' + data[i].id + '">';
                            content += '<td class="center"><input type="checkbox" value="' + data[i].id + '" name="id[]"></td>';
                        }
                        content +=  '<td class="title">'+data[i].name+'</td>';
                        content +=  '<td>'+data[i].user.username+'</td>';
                        content +=  '<td class="status"><a href="javascript:;">'+status+'</a></td>';
                        content += '</tr>';
                    }
                    $('table#news-list-table-compact tbody').html(content);
                    $('div.ajax-paginator').html(rs.paginator);
                    $('#ajax-from').html(rs.range.from);
                    $('#ajax-to').html(rs.range.to);
                    $('#ajax-total').html(rs.total);
                }
            }
        });
    })
    /** Ajax paginator **/
    $('div.ajax-paginator').ajaxPaginator(
    {
        'per-page':$('#per-page').val()
    },
    function(rs){
        var selectedsIds =  $('#related_news').val().split('|');
        var content = ''
        var data = rs.data;
        for(i in data)
        {
            var status = '<i class="icon-archive"></i> Lưu nháp';
            if(data[i].status == 1)
            {
                status = '<i class="icon-ok"></i> Đã đăng';
            }
            if (data[i].status == 2)
            {
                status = '   <i class="icon-circle-arrow-down"></i> Đã hạ';
            }
            if(inArray(data[i].id,selectedsIds))
            {
                content += '<tr rel="' + data[i].id + '" class="selected">';
                content += '<td class="center"><input type="checkbox" value="' + data[i].id + '" name="id[]" checked="checked"></td>';
            } else {
                content += '<tr rel="' + data[i].id + '">';
                content += '<td class="center"><input type="checkbox" value="' + data[i].id + '" name="id[]"></td>';
            }
            content +=  '<td class="title">'+data[i].name+'</td>';
            content +=  '<td>Chưa phân loại</td>';
            content +=  '<td class="status"><a href="javascript:;">'+status+'</a></td>';
            content += '</tr>';
        }
        $('table#news-list-table-compact tbody').html(content);
        $('#ajax-from').html(rs.range.from);
        $('#ajax-to').html(rs.range.to);
        $('#ajax-total').html(rs.total);
    });

    /**Show ajax news table **/
    $('.show-news-table').click(function()
    {
        BootstrapDialog.show(
        {
            'title' : 'Chọn tin tức',
            'message' : $('#news-list-form').text(),
            onhide: function(){
               return;
            }
        });
    });

    $('#news-list-form').submit(function(e)
    {
        e.preventDefault();
    });

    /** Takedown article list **/
    $('button.news-task').click(function()
    {
        var status = $(this).attr('data-value');
        BootstrapDialog.show({
            type: BootstrapDialog.TYPE_WARNING,
            title: 'Cảnh báo',
            message: 'Thực hiện tác vụ này',
            buttons: [{
                label: 'OK',
                cssClass: 'btn-primary',
                action: function(dialog)
                {
                    dialog.close();
                    $.post('/cp/news/edit?status='+status,
                        $('#news-list-form').serialize(),
                        function(rs)
                        {
                            if(rs.code == 'success')
                            {
                                location.reload();
                            } else {showDialog(rs);}
                        }
                    )
                }
            },
                {
                    label: 'CANCEL',
                    cssClass: 'btn-warning',
                    action: function(dialog)
                    {
                        dialog.close();
                    }
                }
            ]
        });
    });

    /** Delete article list **/
    $('button.remove').click(function()
    {
        var status = $(this).attr('data-value');
        BootstrapDialog.show(
        {
            type: BootstrapDialog.TYPE_DANGER,
            title: 'Cảnh báo',
            message: 'Thông tin đã xóa sẽ không thể khôi phục lại',
            buttons: [{
                label: 'OK',
                cssClass: 'btn-primary',
                action: function(dialog)
                {
                    dialog.close();
                    $.post('/cp/news/delete',
                        $('#news-list-form').serialize(),
                        function(rs)
                        {
                            location.reload();
                        },'json'
                    )
                }
            },
                {
                    label: 'CANCEL',
                    cssClass: 'btn-warning',
                    action: function(dialog)
                    {
                        dialog.close();
                    }
                }
            ]
        });
    });
    /** Change order number **/
    $('.order-num').change(function()
    {
        var val = $(this).val();
        if(!isNaN(parseInt(val)))
        {
            var id = $(this).attr('rel');
            $.post('/cp/news/edit',
                {id:id,order_num:val},
                function(rs){
                    if(typeof rs != 'undefined'  && rs.code == 'success')
                    {
                        $('.order-num').each(function(){
                            if($(this).val() == val && $(this).attr('rel') != id)
                            {
                                $(this).val(rs.order_num);
                            }
                        });
                    }
                },'json'
            );
        }
    });

    /** Quick task **/
    $('a.news-task').click(function()
    {
        var id = $(this).attr('data-rel');
        var status = $(this).attr('data-value');
        $.post('/cp/news/edit?status='+status,
            {id: [id]},
            function(rs)
            {
                showDialog(rs);
            },'json'
        );
    });

    /** Delete newws **/
    $('a.delete-news').click(function()
    {
        var id = $(this).attr('data-rel');
        deleteNews(id);
    });

    /** Auto save news **/
    if($('#news-create-form').length)
    {
        for ( instance in CKEDITOR.instances )
        {
            CKEDITOR.instances[instance].on('change',function(e)
            {
                $('#news-create-form').autoSave('news')
            });
        }
        $('#news-create-form').find('input').change(function()
        {
            $('#news-create-form').autoSave('news');
        });
        $('#news-create-form').find('textarea').change(function()
        {
            $('#news-create-form').autoSave('news');
        });

    }

    $('form input[name="name"]').change(function()
    {
        $('form input[name="slug"]').val(toAnsi($(this).val()));
    });

    /** Prevent default submit news form **/
    $('#news-create-form').submit(function(e)
    {
        e.preventDefault();
        var form  = $(this);
        $.post('/cp/news/create',
          form.serialize(),
            function(rs)
            {
                if(typeof rs.code != 'undefined')
                {
                    if( rs.code == 'error')
                    {
                        $(form).bindErrors(rs.errors);
                    }
                    if(rs.code == 'success')
                    {
                        rs.redirect = '/cp/news/edit/'+rs.id;
                        showSuccessDialog(rs);
                    }
                }
            },'json'
        );
    });
    $('button.draft-news').click(function(event)
    {
        var form =$('#news-create-form');
        var form_data = form.serialize();
        form_data = form_data + '&status=0';
        $.post('/cp/news/create',
          form_data,
            function(rs)
            {
                if(typeof rs.code != 'undefined')
                {
                    if( rs.code == 'error')
                    {
                        $(form).bindErrors(rs.errors);
                    }
                    if(rs.code == 'success')
                    {
                        rs.msg = 'Đã lưu nháp bài viết';
                        rs.redirect = '/cp/news/edit/'+rs.id;
                        showSuccessDialog(rs);
                    }
                }
            },'json'
        );
    });

    /** Submit edit news form **/
    $('#news-edit-form').submit(function(e)
    {
        e.preventDefault();
        var actURL = document.URL;
        var form  = $(this);
        updateCKEditor('');
        $.post(actURL,
            $(this).serialize(),
            function(rs)
            {
                if(typeof rs.code != 'undefined')
                {
                    if( rs.code == 'error')
                    {
                        showDialog(rs);
                        $(form).bindErrors(rs.errors);
                    }
                    if(rs.code == 'success')
                    {
                        showDialog(rs);
                    }
                }
            },'json'
        );
    });

    /** submit form **/
    $('a.publish-news').click(function()
    {
        updateCKEditor('');
        $('#news-create-form').submit();
    });

    $('tbody').on('click','span',function()
    {
        var parent = $(this).parent();

        if($(parent).hasClass('close-detail'))
        {
            $(parent).removeClass('close-detail');
            $(parent).parent().next('tr.description').hide();
        }
        else
        {
            $(parent).addClass('close-detail');
            if($(parent).parent().next('tr.description').length > 0)
            {
                $(parent).parent().next('tr.description').show();
            }
            else
            {
                var id = $(this).attr('data-value');
                if(id)
                {
                    $.post('/cp/news/get/' + id,{id: id},function(rs)
                    {
                        if(typeof rs.name != 'undefined')
                        {
                            var content = buildNewsQuickView(rs);
                            $(parent).parent().after(content);
                        }
                    },'json');
                }
            }
        }
    });

    /** Get image thumbnail **/
    $('.get-thumbnail').click(function()
    {
       browserImageFile('thumbnail');
    });

    /** Add category **/
    $('#add-category-form').submit(function(e)
    {
        e.preventDefault();
        var form = $(this);
        $.post('/cp/category/create',
            $(this).serialize(),
            function(rs)
            {
                if( rs.code == 'error')
                {
                    $(form).bindErrors(rs.errors);
                }
                if(rs.code == 'success')
                {
                    showDialog(rs);
                }
            },'json'
        )
    });
    $('#add-tag-form').submit(function(e)
    {
        e.preventDefault();
        var form = $(this);
        $.post(
            '/cp/tags/create',
            form.serialize(),
            function(rs)
            {
                if(typeof rs.code != 'undefined')
                {
                    if( rs.code == 'error')
                    {
                        $(form).bindErrors(rs.errors);
                    }
                    if(rs.code == 'success')
                    {
                        var str = '<a data-value="'+rs.tag.id+'" href="javascript:;" class="btn btn-default btn-sm tag-item" style="margin:5px"><i class="icon-plus"></i> '+rs.tag.name+'</a>';
                        $('#list-tags').append(str);
                    }
                }
                var tags = $('input[name="tags"]').val();
                $('.tag-item').click(function(){
                    var txt = $(this).text();
                    var tagId = $(this).attr('data-value');

                    tags += '|' + tagId;
                    $('input[name="tags"]').val(tags);
                    var el =  '<a style="margin:5px" class="btn btn-default btn-sm tag-item-remove" href="javascript:;" data-value="'+tagId+'"><i class="icon-minus"></i>'+txt+'</a>';
                   $('#selected-tags').append(el);
                    $(this).hide();
                });
            }
        )
    });
});

function deleteNews(id)
{
    BootstrapDialog.show(
    {
        type: BootstrapDialog.TYPE_DANGER,
        title: 'Cảnh báo',
        message: 'Thông tin đã xóa sẽ không thể khôi phục lại',
        buttons: [{
            label: 'OK',
            cssClass: 'btn-primary',
            action: function(dialog){
                dialog.close();
                $.post(
                    '/cp/news/delete',
                    {id:id},
                    function(rs)
                    {
                        if(typeof rs != 'undefined' && rs.code == 'success')
                        {
                            location.reload();
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

}
function goEditNewsPage(id)
{
    if(!isNaN(id))
    {
        document.location.href = '/cp/news/edit/' + id;
    }
}
function addRelatedNews(el)
{
    var newsId= $(el).val();
    var title = $(el).closest('tr').find('td.title').html();
    var status = $(el).closest('tr').find('td.status').html();
    var content = '<p data-value="'+newsId+'"><a title="Xóa khỏi danh sách" href="javascript:;" data-value="'+newsId+'" onclick="removeRelateNews(this)"> <i class="icon-minus"></i></a> '+title+status+'</p>';
    var str = $('#related_news').val()
    var relatedIds = str.split('|');
    if($(el).is(':checked'))
    {
        if(!inArray(newsId,relatedIds))
        {
            $('#news-related-list').append(content);
            str += newsId + '|';
            $('#related_news').val(str);
        }
    } else {
        var newsIds = str.split('|');
        str = unsetItem(newsId,newsIds).join('|');
        $('#related_news').val(str);
        $('#news-related-list').find('p[data-value="'+newsId+'"]').remove();
    }
}

function removeRelateNews(el)
{
    var newsId= $(el).attr('data-value');
    var str = $('#related_news').val();
    var newsIds = str.split('|');
    str = unsetItem(newsId,newsIds).join('|');
    $('#related_news').val(str);
    $(el).parent().remove();
    $('#news-list-table-compact').find('tr[rel="'+newsId+'"]').removeClass('selected');
    $('#news-list-table-compact').find('tr[rel="'+newsId+'"]').find('input[type="checkbox"]').removeAttr('checked');
}

function quickEdit(el)
{
    var newsId = $(el).attr('data-value');
    var child = $(el).children('i');
    if($(child).hasClass('icon-edit'))
    {
        $(el).closest('form').find('.form-control').removeClass('transparent').removeAttr('readonly');
        $(child).removeClass('icon-edit').addClass('icon-ok');
        $(child).closest('td').find('.icon-remove-sign').parent().show();
        $(child).text(' Lưu');
        $(child).closest('tbody').find('a.quick-edit-thumb').show();

    } else {
        var form =  $(child).closest('form');
        $(form).submit(function(e){
            e.preventDefault();
            $.post('/cp/news/edit',
                $(this).serialize(),
                function(rs)
                {
                    if(rs.code == 'error' && typeof rs.errors !='undefined')
                    {
                        $(form).bindErrors(rs.errors);
                    }
                    if(rs.code == 'success')
                    {
                        $(el).closest('form').find('.form-control').addClass('transparent').attr('readonly','true');
                        $(el).closest('form').find('.quick-edit-thumb').hide();
                        $(el).closest('form').find('.icon-remove-sign').parent().hide();
                        $(child).removeClass('icon-ok').addClass('icon-edit');
                        $(child).text(' Sửa nhanh');
                    }
                },'json'
            )
        });
        $(form).submit();

    }
}

function buildNewsQuickView(rs)
{
    var content ='<tr class="description">'+
        '<td colspan="9"><form>'+
        '<table cellspacing="0" cellpadding="5" border="0" style="padding-left:50px;" class="w100">'+
        '<tbody>'+
        '<tr>'+
        '<td class="w30 quick-view-thumb"><a href="javascript:;" style="display: inline-block" id="thumbnail_'+rs.id+'-thumb"><img src="'+rs.thumbnail+'" style="max-width: 150px"/></a>' +
        '<input type="hidden" name="thumbnail" id="thumbnail_'+rs.id+'" value="'+rs.thumbnail+'" />'+
        '<p><a class="quick-edit-thumb" style="display: none" href="javascript:;" onclick="browserImageFile(\'thumbnail_'+rs.id+'\')"> <i class="icon-edit"></i>Sửa</a></p>'+
        ' </td>'+
        '<td class="w70 "><div class="panel-body form-horizontal"> '+
        '<input type="hidden" name="id" value="'+rs.id+'"/>'+
        '<div class="form-group"><label class="col-sm-2 col-sm-2 control-label"> Tiêu đề: </label> <div class="col-lg-10 name" ><input readonly name="name" class="form-control transparent" onchange="slugify(this)" required value="'+rs.name+'"/></div></div>'+
        '<div class="form-group"><label class="col-sm-2 col-sm-2 control-label">Slug: </label><div class="col-lg-10 slug"><input readonly name="slug" class="form-control transparent" required value="'+rs.slug+'"/></div></div>' +
        '<div class="form-group"><label class="col-sm-2 col-sm-2 control-label"></label><div class="col-lg-10 brief"><textarea rows="3" name="brief" readonly class="form-control transparent">'+rs.brief+'</textarea></div></div>'+
        '</div></td></tr><tr>'+
        '<td>'+
        '       <a href="javascript:;"> <i class="icon-eye-open"></i> '+ (isNaN(parseInt(rs.view)) ? 0 :rs.view) +' Lượt view</a> |'+
        '       <a href="/cp/news/comments?news_id='+rs.id+'"> <i class="icon-comment"></i>  comment</a> |';

    if(rs.user)
    {
        content +=    '<a href="javascript:;"> <i class="icon-eye-open"></i> '+rs.user.username+'</a>';
    }
    content +='   </td>'+
    '   <td>'+
    '       <a style="display:none" href="javascript:;" onclick="cancelEdit(this)" data-value="'+rs.id+'"><i class="icon-remove-sign"> Hủy</i> |</a> '+
    '       <a href="javascript:;" onclick="quickEdit(this)" data-value="'+rs.id+'"><i class="icon-edit"> Sửa nhanh</i> </a> |'+
    '       <a href="javascript:;" onclick="shareFacebook(this)" data-value="'+rs.url+'"><i class="icon-facebook-sign"> Share facebook</i> </a> |'+
    '       <a href="javascript:;" onclick="deleteNews(\''+rs.id+'\')" data-value="'+rs.id+'"><i class="icon-remove"> Xóa</i> </a> |'+
    '       <a href="javascript :;" onclick="viewNews(this)" data-value="'+rs.url+'"><i class="icon-desktop"> Xem</i> </a>'+
    '   </td>'+
    '</tr>'+
    '</tbody>'+
    '</table></form>'+
    '</td>'+
    '</tr>';
    return content;
}

function cancelEdit(el)
{
    var newsId = $(el).attr('data-value');
    if(!isNaN(newsId))
    {
        $.post('/cp/news/get/' + newsId,{id: newsId},function(rs){
            if(typeof rs.name != 'undefined')
            {
                var content = buildNewsQuickView(rs);
                $(el).closest('tr.description').replaceWith(content);
            }
        },'json');
    }
}

/** Add news category **/
