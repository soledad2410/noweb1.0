/**
 * Created by hung_it on 09/03/2015.
 */
$(function()
{

    /** Import product list **/
$('#import-product-form').submit(function(e){
        e.preventDefault();
        var data = $(this).serialize();
        $.post('/cp/inventory/import',data,function(rs){

        },'json');
    });


    /** Choose import file **/
    $('#choose-import-file').click(function()
    {
        if($(this).is(':checked')){
            $('.excel-input').show();
        } else {
            $('.excel-input').hide();
        }
    });

    /** Add product **/
    $('#product-form').submit(function(e)
    {
        e.preventDefault();
        var form = $(this);
        $.post('/cp/inventory/product',
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

    /** Delete brand **/
    $('button.delete-brand').click(function(){
        var id = $(this).closest('form').find('input[name="id"]').val();
        if(!isNaN(id))
        {
            BootstrapDialog.confirm('Xóa thông tin ', function(confirm)
            {
                if(confirm){
                    $.post(
                        '/cp/brand/delete',
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

    /** Show edit catalogue form **/
    $('.edit-catalogue').click(function(){
        var id = $(this).attr('data-value');
        var name = $(this).attr('title');
        showEditInventoryCatalogueForm(id,name);
    });

    /** Submit edit catalogue **/
    $('#edit-catalogue').submit(function(e){
        e.preventDefault();
        var form = $(this);
        $.post('/cp/inventory/edit-catalogue',
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

    /** Delete catalogue **/
    $('button.delete-catalogue').click(function(){
        var id = $(this).closest('form').find('input[name="id"]').val();
        if(!isNaN(id))
        {
            BootstrapDialog.confirm('Xóa thông tin ', function(confirm)
            {
                if(confirm){
                    $.post(
                        '/cp/inventory/delete-catalogue',
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

    /** Add catalogue**/
    $('#add-catalogue-form').submit(function(e){
        e.preventDefault();
        var form = $(this);
        $.post('/cp/inventory/catalogue',
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
});

function showEditInventoryCatalogueForm(id,title)
{
    var data = {id:id,name:title};
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

function filterByBrand(id)
{
    var url = changeUriParam('brand',id);
    document.location.href = url;
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

function suggestProductCode(el)
{
    var val = $(el).val();
    if(val.trim().length)
    {
        $.get('/cp/inventory/get-product',
            {phrase : val},
            function(rs)
            {
                var str = '';
                if(rs.length)
                {
                    var str = '';
                    for(var i in rs)
                    {
                        str += '<li><a href="javascript:;" onclick="selectProductCode(this)" data-value="'+rs[i].id+'" data-rel="'+rs[i].code+'" >' + rs[i].name + ' - ' +rs[i].code+ '</a></li>';
                    }
                    $(el).parent().find('ul').html(str).show();
                } else {
                    $(el).parent().find('ul').html(str).hide();
                }
            }
        );
    }
}

function selectProductCode(el)
{
    var id = $(el).attr('data-value');
    var code = $(el).attr('data-rel');
    $(el).closest('.product-suggest-wrap').find('input.product-id').val(id);
    $(el).closest('.product-suggest-wrap').find('input.product-code').val(code);
    $(el).closest('ul').hide();
}

function addImportProductField()
{
    var html = '<div class="form-group">';
    html += '<div class="col-lg-3 product-suggest-wrap">';
    html += '<input type="hidden" class="product-id" name="product_id[]" />';
    html += '<input class="form-control product-code " onkeyup="suggestProductCode($(this))" type="text"  placeholder="Mã chủng loại" required/>';
    html += '<ul class="dropdown-menu btn-sm">';
    html += '</ul>';
    html += '</div>';
    html += '<div class="col-lg-3">';
    html += '<input class="form-control number-field" name="quantity[]" type="text" placeholder="Số lượng nhập"/>';
    html += '</div>';
    html += '<div class="col-lg-3">';
    html += '<input class="form-control currency-field" name="import_price[]" placeholder="Đơn giá nhập (vnđ)"/>';
    html += '</div>';
    html += '<div class="col-lg-3 input-group">';
    html += '<input class="form-control number-field spinner-input" type="text" name="damaged[]" placeholder="Hư hỏng" />';
    html += '<div class="spinner-buttons input-group-btn">';
    html += '<button class="btn btn-default" type="button" onclick="$(this).closest(\'.form-group\').remove()">';
    html += '<i class="icon-minus"></i>';
    html += '</button>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    $('.list-import-product').append(html);
}