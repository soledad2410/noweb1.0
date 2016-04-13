/**
 * Created by hung_it on 5/11/2015.
 */

$(function(){
    $('form input[name="name"]').change(function() {
        $('form input[name="slug"]').val(toAnsi($(this).val()));
    });
    // Style categories trees
    $('ul.prod-cat li').each(function(){
        var level = (countParent($(this).find('a'))-1);
        var width = parseInt(level) * 10;
        $(this).find('span.tree-separator').css('width',width +'px');
    });
    $('select[name=parent_id] option').each(function(){
        var level = (countParentSelectBox(this)-1);
        var width = parseInt(level) * 20;
        var temp = $(this).text();
        $(this).text(str_repeat('--- ', level) + temp);
    });
    /** Go edit product **/
    $('a.adv-edit').click(function() {
        var id = $(this).attr('data-rel');
        goEditPage(id);
    });
    /** Go add product page with data **/
    $('a.copy-product').click(function() {
        var id = $(this).attr('data-rel');
        copyPage(id);
    });

    $('#product-create-form').submit(function(e){
        e.preventDefault();
        updateCKEditor();
        var data = $(this).serialize();
        $.post('/cp/product/create',data,function(rs){
            if(typeof rs.code != 'undefined')
            {
                if( rs.code == 'error')
                {

                    $(form).bindErrors(rs.errors);
                }
                if(rs.code == 'success'){
                    rs.redirect = '/cp/product/edit/'+rs.id;
                    showSuccessDialog(rs);
                }
            }
        },'json');
    });
    /** Create new catalogue **/
    $('.add-catalogue-form').submit(function(e)
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
    /** Add brand **/
    $('#brand-form').submit(function(e)
    {
        e.preventDefault();
        var form = $(this);
        $.post('/cp/brand/create',
            $(form).serialize(),
            function(rs)
            {
                if(typeof rs.code != 'undefined')
                {
                    if( rs.code == 'error')
                    {

                        $(form).bindErrors(rs.errors);
                    }
                    if(rs.code == 'success'){
                        showDialog(rs);
                    }
                }
            },'json'
        );
    });
    /** Browse image file  **/
    $('.get-thumbnail').click(function(){
        browserImageFile('brandlogo');
    });
    $('.get-prodimg').click(function(){
        browserImageFile('prodimg');
    });
    /** Show edit catalogue form **/
    $('.edit-catalogue').click(function(){
        var id = $(this).attr('data-value');
        var name = $(this).attr('title');
        showEditCatalogueForm(id,name);
    });
    /** Submit edit catalogue **/
    $('#edit-catalogue').submit(function(e){
        e.preventDefault();
        var form = $(this);
        $.post('/cp/category/edit/' + form.find('input[name=id]').val(),
            $(form).serialize(),
            function(rs)
            {
                if(typeof rs.code != 'undefined')
                {
                    if( rs.code == 'error')
                    {

                        $(form).bindErrors(rs.errors);
                    }
                    if(rs.code == 'success'){
                        showDialog(rs);
                    }
                }
            },'json'
        );
    });
    /** Delete catalogue **/
    $('button.delete-catalogue').click(function(){
        var id = $(this).closest('form').find('input[name="id"]').val();
        if(!isNaN(id))
        {
            BootstrapDialog.confirm('Xóa thông tin ', function(confirm)
            {
                if(confirm){
                    $.post(
                        '/cp/category/delete',
                        {id:id},
                        function(rs)
                        {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   if(typeof rs.code != 'undefined')
                            {
                                if(rs.code == 'success')
                                {
                                  location.reload();
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
        }
    });
    /** Add product **/
    $('#product-form').submit(function(e)
    {
        e.preventDefault();
        var form = $(this);
        $.post('/cp/product/create',
            $(form).serialize(),
            function(rs)
            {
                if(typeof rs.code != 'undefined')
                {
                    if( rs.code == 'error')
                    {

                        $(form).bindErrors(rs.errors);
                    }
                    if(rs.code == 'success'){
                        rs.redirect = '/cp/product/edit/'+rs.id;
                        showSuccessDialog(rs);
                    }
                }
            },'json'
        );
    });
    /** Edit product **/
    $('#product-edit-form').submit(function(e)
    {
        e.preventDefault();
        var form = $(this);
        $.post('/cp/product/edit/' + form.find('input[name=id]').val(),
            $(form).serialize(),
            function(rs)
            {
                if(typeof rs.code != 'undefined')
                {
                    if( rs.code == 'error')
                    {

                        $(form).bindErrors(rs.errors);
                    }
                    if(rs.code == 'success'){
                        showDialog(rs);
                    }
                }
            },'json'
        );
    });
    /** Delete **/
    $('a.delete-product').click(function(){
        var id = $(this).attr('data-rel');
        deleteProduct(id);
    });
    /** Delete multi products **/
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
                    $.post('/cp/product/delete',
                        $('#form-list-products-table').serialize(),
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

function showEditCatalogueForm(id,title) {
    var data = {id:id,name:title,slug:toAnsi(title)};
    var parent = $('a[rel='+id+']').attr('parent');
    $('#edit-catalogue').find('option[value='+parent+']').attr('selected', 'selected');
    bindFormData('#edit-catalogue',data);
    $('#edit-catalogue').show();
    BootstrapDialog.show({
        'title' : 'Sửa danh mục kho',
        'message' : $('#edit-catalogue'),
        onhide: function(){
            location.reload();
        }
    });

}
function showEditProductForm(id) {
    $.post('/cp/product/get',
        {id:id},
        function(rs)
        {
            if(typeof rs != 'undefined') {
                $('#product-edit-form').show();
                $('#image-thumb').html('<img src="'+rs.image+'" alt="image"/>');

                bindFormData('#product-edit-form',rs);

                BootstrapDialog.show({
                    'title' : 'Sửa thông tin sản phẩm',
                    'message' : $('#product-edit-form'),
                    onhide: function(){
                        location.reload();
                    }
                });
            }
        }
    );
}
function showEditBrandForm(id)
{
    $.post('/cp/brand/get',
        {id:id},
        function(rs)
        {
            if(typeof rs != 'undefined')
            {

                $('#brandlogo-thumb').html('<img src="'+rs.logo+'" alt="no-image"/>');
                $('#brand-form').find('button.btn-danger').show();
                $('#brand-form').show();

                bindFormData('#brand-form',rs);

                BootstrapDialog.show({
                    'title' : 'Sửa Thương hiệu',
                    'message' : $('#brand-form'),
                    onhide: function(){
                        location.reload();
                    }
                });
            }
        }
    );
}
function goEditPage (id) {
    if(!isNaN(id)) {
        document.location.href = '/cp/product/edit/' + id;
    }
}
function copyPage (id) {
    if(!isNaN(id)) {
        BootstrapDialog.confirm('Bạn có muốn sao chép sản phẩm này?', function(confirm)
        {
            if(confirm){
                $.post('/cp/product/get', { id: id }, function(data) {
                    data.id = null;
                    data.code = Math.random().toString(36).substring(0,5);
                    var dataParam = $.param(data);
                    $.post('/cp/product/create',
                        dataParam,
                        function(rs)
                        {
                            if(typeof rs.code != 'undefined')
                            {
                                if( rs.code == 'error')
                                {

                                    $(form).bindErrors(rs.errors);
                                }
                                if(rs.code == 'success'){
                                    window.location.href = '/cp/product/edit/'+rs.id;
                                }
                            }
                        },'json'
                    );
                });

            } else {
                return;
            }
        });
    }
}
function deleteProduct(id)
{
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
                    '/cp/product/delete',
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
function change_status (pid, status)
{
    if(!isNaN(parseInt(pid)) && !isNaN(parseInt(status)))
    {
       var id = $(this).attr('rel');
       $.post('/cp/product/edit/'+pid,
           {id:pid,status:status},
           function(rs){
               if(typeof rs != 'undefined'  && rs.code == 'success')
               {
                   showDialog(rs);
               }
           },'json'
           );
   }
}
function countParent(el)
{
    var count = 1;
    var parent = $(el).attr('parent');
    if(typeof parent != 'undefined' && parent != 0)
    {
        count += countParent($('ul.prod-cat a[rel="'+parent+'"]'));
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