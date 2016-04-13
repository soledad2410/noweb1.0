/**
 * Created by hung_it on 15/01/2015.
 */
 $(function(){

    $('.cate-type').hide();
    $('#cate-type').on('change',function()
    {
        var module = $(this).val();
        $('.cate-type').each(function()
        {
            var val = $(this).attr('data-val');
            if(module == val){$(this).show();}else{$(this).hide();}
        });
    });

    var module = $('#cate-type').val();
    $('.cate-type').each(function()
    {
        var val = $(this).attr('data-val');
        if(module == val){$(this).show();}else{$(this).hide();}
    });

    /** Delete category **/
    $('a.delete-cate').click(function()
    {
        var cateId = $(this).attr('data-rel');
        var el = $(this);
        BootstrapDialog.show(
        {
            type: BootstrapDialog.TYPE_DANGER,
            title: 'Cảnh báo',
            message: 'Thông tin đã xóa sẽ không thể khôi phục lại',
            buttons: [
            {
                label: 'OK',
                cssClass: 'btn-primary',
                action: function(dialog)
                {
                    dialog.close();
                    $.post('/cp/category/delete',
                        {'id' : cateId},
                        function(rs)
                        {
                            if(rs.code == 'success')
                            {
                                $(el).closest('tr').remove();
                            } else{
                                showDialog(rs);
                            }
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

    /** Delete categories list **/
    $('button.remove').click(function()
    {
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
                    $.post('/cp/category/delete',
                        $('#category-list-form').serialize(),
                        function(rs) {
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

    /** Edit category **/
    $('#edit-category-form').submit(function(e)
    {
        e.preventDefault();
        var form = $(this);
        $.post('/cp/category/edit',
            $(this).serialize(),
            function(rs)
            {
                if( rs.code == 'error' && typeof rs.errors != 'undefined')
                {
                    $(form).bindErrors(rs.errors);
                } else
                {
                    showDialog(rs);
                }
                if(rs.code == 'success')
                {
                    showDialog(rs);
                }
            },'json'
        )
    });

    /** Sort category **/
    $("#category-list-table").rowSorter(
    {
        handler: "td.sorter",
        // disabledRowClass: "child",
        onDrop: function(tbody, row, new_index, old_index)
        {
            var position = {};
            $('#category-list-table tbody tr').each(function(index, el)
            {
                position[$(el).attr('rel')] = index+1;
            });
            $.post('/cp/category/save-order', { position: position }, function(rs)
            {
                showDialog(rs);
            });
        }
    });

    /** Create new category **/
    $('.add-category-form').submit(function(e)
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

    /** Update category **/
    $('.edit-category-form').submit(function(e)
    {
        e.preventDefault();
        var form = $(this);
        var id = $('#cate_id').val();
        $.post('/cp/category/edit/'+id,
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
    // Style categories trees
    $('tr.tree-tr').each(function(){
        var level = (countParent(this)-1);
        var width = parseInt(level) * 20;
        $(this).find('span.tree-separator').css('width',width +'px');
    });
    $('select.category-tree option').each(function(index, el){
        var level = (countParentSelectBox(this)-1);
        var width = parseInt(level) * 20;
        var spa = $(el).html();
        $(el).html(str_repeat('--- ', level) + spa);
    });
});

function countParent(el)
{
    var count = 1;
    var parent = $(el).attr('parent');
    if(parent != 0)
    {
        count += countParent($('tr[rel="'+parent+'"]'));
    }
    return count;
}
function countParentSelectBox(el)
{
    var count = 1;
    if($(el).attr('parent')){

        var parent = $(el).attr('parent');
        if(parent != 0)
        {
            count += countParentSelectBox($('option[value="'+parent+'"]'));
        }
    }
    return count;
}

function change_status (cate_id, status)
{
    if(!isNaN(parseInt(cate_id)) && !isNaN(parseInt(status)))
    {
        var id = $(this).attr('rel');
        $.post('/cp/category/edit/'+cate_id,
            {id:cate_id,status:status},
            function(rs){
                if(typeof rs != 'undefined'  && rs.code == 'success')
                {
                    showDialog(rs);
                }
            },'json'
        );
    }
}

function change_show_menu (cate_id, show_menu)
{
    if(!isNaN(parseInt(cate_id)) && !isNaN(parseInt(show_menu)))
    {
        var id = $(this).attr('rel');
        $.post('/cp/category/edit/'+cate_id,
            {id:cate_id,show_menu:show_menu},
            function(rs){
                if(typeof rs != 'undefined'  && rs.code == 'success')
                {
                    showDialog(rs);
                }
            },'json'
        );
    }
}