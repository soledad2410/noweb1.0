$(function()
{
	//$('.fancybox').fancybox();
    // new contacts notification
    // check_new_contacts(5000);
    // unapproved comments notification
    // check_unapproved_comments(5000);
    //append users online statistics
    // append_users_online_statistics(5000);
    // Get articles list
  //  get_articles('view');
    // Append news number to dashboard widget
   // count_all_records('news');
    // Append product number to dashboard widget
   // count_all_records('product');
    // Modules Access
    // module_access();

    /** Enable bootstrap tooltip */
    $('body').tooltip({
        selector: '[data-toggle="tooltip"]'
    });
    /** Datetime picker **/
    $(".datetime-picker").datetimepicker({format: 'hh:ii dd-mm-yyyy'});
    /** Change language **/
    $('ul.select-language li').click(function(){
        var langId = $(this).children('a').attr('data-value');
        var currentLangId = $('a.current-language').attr('data-value');
        if(langId != currentLangId)
        {
            $.post(
                '/cp/setting/switchlang',
                {'lang_id' : langId},
                function(rs)
                {
                    if(rs.code == 'success')
                    {
                        location.reload();
                    }
                }
            );
        }
    });
    /** Format currency **/
    $("body").on('keydown','.currency-field',function (e) {
        $(this).autoNumeric('init');
    });
    /** Number field enforce **/
    $("body").on('keydown','.number-field',function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    $('.date-picker').datepicker({format : 'dd-mm-yyyy'});
    $('.sign-out-system').click(function()
    {
        signout();
    });
    /** Clear error input **/
    $('input,textarea').on('focus',function()
    {
        $(this).removeClass('error')
        $(this).next('label.error').remove();
        $(this).next('p.help-block').remove();
        $(this).closest('.form-group').removeClass('has-error');
    });
    $('.btn-default').on('click', function()
        {
            $(this).closest('form').clearForm();
        }
    );
    /**  selected select box **/
    $('select').each(function()
    {
        if($(this).attr('data-value'))
        {
            var val = $(this).attr('data-value');
            $(this).find('option').each(function()
            {
                if($(this).val() == val)
                {
                    $(this).attr('selected','selected');
                }
            });
        }

    });

    /** Change limit page **/
    $('select.per-page').change(function(){
       var limit = parseInt($(this).val());
      if(!isNaN(limit) && limit >0)
      {
          var url = changeUriParam('per-page',limit);
          document.location.href = url;
      }
    });
    /** Export excel **/
    $('a.export-excel').click(function(){
       var tableId = $(this).attr('resource');
        $('#'+tableId).tableExport({type:'xls',escape:'false'});
    });
    /** Export excel **/
    $('a.export-word').click(function(){
        var tableId = $(this).attr('resource');
        $('#'+tableId).tableExport({type:'doc',escape:'false'});
    });
    /** Export csv **/
    $('a.export-csv').click(function(){
        var tableId = $(this).attr('resource');
        $('#'+tableId).tableExport({type:'csv',escape:'false'});
       // exportTableToCSV.apply(this, [$('#'+tableId), 'download.csv']);
    });
    ///** Export png - exception chrome **/
    $('a.export-png').click(function(){
        var tableId = $(this).attr('resource');
        $('#'+tableId).tableExport({type : 'png',escape : 'false'});
    });
    /** ajax paginator **/

    ///** Export powerpoint**/
    //$('a.export-ppt').click(function(){
    //    var tableId = $(this).attr('resource');
    //    $('#'+tableId).tableExport({type : 'powerpoint',escape : 'false'});
    //});
    ///** Export pdf **/
    //$('a.export-pdf').click(function(){
    //    var tableId = $(this).attr('resource');
    //    $('#'+tableId).tableExport({type : 'pdf','pdfFontSize' : '7' ,escape : 'false'});
    //});
    /** Checked checkbox **/
    $('input[type="checkbox"]').each(function()
    {
        if($(this).attr('data-value'))
        {
            var vals = $(this).attr('data-value').split('|');
            var val = $(this).val();
            if($.inArray(val,vals) >= 0)
            {
                $(this).attr('checked','checked');
            }
            if(isNaN($(this).val()))
            {
                 if($.inArray($(this).val(),vals) >= 0)
                {
                    $(this).attr('checked','checked');
                }
            }

        }
    });
    /** Check all **/
    $('.check-all').click(function()
    {
        var tableId = $(this).attr('resource');
        if($(this).is(':checked')){
            $('#' + tableId).children('tbody').children('tr').addClass('selected');
            $('#' + tableId).find('input[type="checkbox"]').each(function(){
               $(this).attr('checked','true');
            });
            $('button.remove').show();
            $('button.approval').show();
            $('button.takedown').show();

        } else {
            $('#' + tableId).children('tbody').children('tr').removeClass('selected');
            $('#' + tableId).find('input[type="checkbox"]').each(function(){
                $(this).removeAttr('checked');
            });
            $('button.remove').hide();
            $('button.approval').hide();
            $('button.takedown').hide();
        }
    });
    $('tbody').on('click','input[type="checkbox"]',function(){
        if($(this).is(':checked'))
        {
            $(this).closest('tr').addClass('selected');
            $('button.remove').show();
            $('button.approval').show();
            $('button.takedown').show();
        } else {
            $(this).closest('tr').removeClass('selected');
            $('button.remove').hide();
            $('button.approval').hide();
            $('button.takedown').hide();
        }
    });
    /** Order column list **/
    $('td.sort').each(function(){
        var dataSort = $(this).attr('data-value');
        var currentSort = getURLParam('sortBy');

        var sortType  = getURLParam('sort');
        if(currentSort == dataSort)
        {
            var sort = 'asc';
            if(sortType == 'asc' || sortType == 'desc')
            {
                sort = sortType;
            }
            $(this).removeClass('sorting').addClass('sorting_' + sort);
        }
    });

    $('td.sort').click(function()
    {
        var dataSort = $(this).attr('data-value');
        var sort = 'asc';
        if($(this).hasClass('sorting_asc'))
        {
            sort = 'desc';
        }
        var url = changeUriParam('sortBy',dataSort);

        url = changeUriParam('sort',sort,url);
        document.location.href = url;

    });
});
/** Signout system function **/
function signout()
{
    $.post(
        '/cp/logout',
        {},
        function(rs)
        {
            if(typeof rs.code != 'undefined' && rs.code == 'success')
            {
                location.reload();
            }
        },
        'json'
    )
}

function createSuccessNotify(title,msg){
    var content = '<div class="alert alert-success alert-block fade in">';
    content += '<button type="button" class="close close-sm" data-dismiss="alert">';
    content += '<i class="icon-remove"></i>';
    content += '</button>';
    content += '<h4>';
    content += '<i class="icon-ok-sign"></i>';
    content += title;
    content += '</h4>';
    content += '<p>'+msg+'</p>';
    content += '</div>';
    return content;

}

function showSuccessDialog(obj,title,msg)
{
    $(obj).closest('.panel-body').append(createSuccessNotify(title,msg));
}

$.fn.clearForm = function() {
    resetCKEditor();
    return this.each(function() {
        var type = this.type, tag = this.tagName.toLowerCase();
        if(!$(this).is(':disabled') && !$(this).attr('readonly'))
        {
        if (tag == 'form')
        {
            return $(':input',this).clearForm();
        }
        if (type == 'text' || type == 'password' || tag == 'textarea')
        {
            this.value = '';
        }
        else if (type == 'checkbox' || type == 'radio')
        {
            this.checked = false;
        }
        else if (tag == 'select')
        {
            $(this).find('option').removeAttr('selected');
        }
        }
    });
};

function browserImageFile(id,multi,filePath){
    var finder = new CKFinder();
    finder.basePath = '/public/3rd/ckfinder/';
    finder.resourceType = 'Images';
    if(multi == true){
        finder.selectMultiple = true;
        finder.selectActionFunction = setMultiImages;
    }else{
        finder.selectActionFunction = setFileField;
    }

    if(filePath!=null){
        finder.startupPath=filePath;
    }
    finder.selectActionData=id;
    finder.popup();
}

function browseFile(id)
{
    var finder = new CKFinder();
    finder.basePath = '/public/3rd/ckfinder/';
    finder.selectActionFunction = setFileField;
    finder.selectActionData = id;
    finder.popup();
}

function setFileField(fileUrl,data){
    document.getElementById( data["selectActionData"] ).value = fileUrl;
    $("#"+data["selectActionData"]+"-thumb").html("<img src='/"+fileUrl+"'/>");
}

function setMultiImages(file_url,data){
    var els=data["selectActionData"];
    document.getElementById(data["selectActionData"]).value += file_url+'|';
    $("#"+data["selectActionData"]+"-thumb").append("<img src='"+file_url+"' height='70' onclick='remove_image(this,\""+els+"\");' title='click here to remove this image' style='cursor:pointer'/>");
}

function remove_image(els,id){
    var image=$(els).attr("src");
    var value=$("#"+id).val();
    $("#"+id).val(value.replace(image+'|',''))
    $(els).remove();
}

function show403Error()
{
    BootstrapDialog.show({
        type: BootstrapDialog.TYPE_DANGER,
        title: 'Cảnh báo',
        message: 'Tài khoản của bạn không đủ quyền thực hiện tác vụ này',
        buttons: [{
            label: 'OK',
            cssClass: 'btn-primary',
            action: function(dialog){
                dialog.close();
            }
        }]
    });
}
function showTaskError(rs)
{
    BootstrapDialog.show({
        type: BootstrapDialog.TYPE_DANGER,
        title: 'Cảnh báo',
        message: rs.msg,
        buttons: [{
            label: 'OK',
            cssClass: 'btn-primary',
            action: function(dialog){
                dialog.close();
                if(typeof rs.redirect != 'undefined')
                {
                    document.location.href = rs.redirect;
                } else {
                    location.reload();
                }
            }
        }]
    });
}

function showSuccessDialog(rs)
{
    BootstrapDialog.show({
        type: BootstrapDialog.TYPE_SUCCESS,
        title: 'Thông báo',
        message: rs.msg,
        buttons: [{
            label: 'OK',
            cssClass: 'btn-primary',
            action: function(dialog){
                dialog.close();
                if(typeof rs.redirect != 'undefined')
                {
                    document.location.href = rs.redirect;
                } else {
                    location.reload();
                }
            }
        }]
    });
}
function showDialog(rs)
{
    if(typeof rs.code != 'undefined' && typeof rs.errors == 'undefined')
    {
        switch(rs.code)
        {
            case '403' :
                show403Error();return;
            break;
            case 'error' :
                if(typeof rs.msg != 'undefined')
                {
                showTaskError(rs);
                }
             return;
            break;
            case 'success' :
                if(typeof rs.msg != 'undefined')
                {
                    showSuccessDialog(rs);
                }
            return;
            break;
            default:
                showTaskError('Có lỗi xảy ra, thực hiện tác vụ thất bại');
                return;
            break;
        }
    }
    showTaskError('Có lỗi xảy ra, thực hiện tác vụ thất bại');
    return;
}
/** Show dialog form **/
function bindFormData(form,data)
{
    $(form).find('*').each(function(){
        if($(this).attr('name'))
        {

            if(typeof data[$(this).attr('name')] != 'undefined')
            {
                if($(this).attr('type') == 'radio')
                {   if($(this).val() == data[$(this).attr('name')])
                    {
                     $(this).attr('checked','checked');
                    }
                }
                else {
                 $(this).val(data[$(this).attr('name')]);
                }
            }
        }
    });
}

/** Custom plugin **/
(function($)
{
    /** Bind errors response                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             to form from ajax **/
    $.fn.bindErrors = function(errors)
    {
        $(this).find('*').each(function()
        {
            if(typeof errors[$(this).attr('name')] != 'undefined')
            {
                $(this).addClass('error').next('.help-block').remove();
                $(this).addClass('error').after('<p  class="help-block">'+errors[$(this).attr('name')]+'</p>')
                $(this).closest('.form-group').addClass('has-error');
            }
        });
        return this
    }
    /** Table to excel **/
    $.fn.exportExcel = (function(sheetName)
    {
        var uri = 'data:application/vnd.ms-excel;base64,'
            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'
            , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
            , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
        var ctx = {worksheet: sheetName || 'Worksheet', table: $(this).html()}

        window.location.href = uri + base64(format(template, ctx))
    });
    /** Caching autosave **/

    $.fn.autoSave = (function(name)
    {
        updateCKEditor();
        $.post('/cp/caching/' + name,
            $(this).serialize()
            ,function(rs){

            },
            'json'
        )
    });

    /** Ajax paginator **/

    $.fn.ajaxPaginator = (function(options,callbackFunction)
    {
        var root = $(this);
        var rootEl = $(this).children('ul');

        $(this).on('click', $(rootEl).children('li') ,function(e){
            var dataSource = $(this).children('ul').attr('data-source');
            var els = $(e.target);
            var page = $(els).attr('data-value');
            options.page = page;
            $.get(dataSource,
                options,
                function(rs)
                {   if(rs.code == 'success' && typeof rs.data != 'undefined'){
                    if(typeof  callbackFunction== 'function')
                    {
                        callbackFunction(rs);
                        $(root).find('li').removeClass('active');
                        $(root).find('a[data-value="'+page+'"]').parent('li').each(function(){
                            if(!$(this).hasClass('prev') && !$(this).hasClass('next')){
                                $(this).addClass('active');
                            }
                        });
                        if(page >1)
                        {
                            $(root).find('li.prev').children('a').attr('data-value',parseInt(page)-1);

                        }
                        $(root).find('li.next').children('a').attr('data-value',parseInt(page)+1);
                    }
                }
                },'json'
            );
        });
    });
    /**Build checkbox tree view **/
    $.fn.checkboxTreeView = (function()
    {
        $(this).find('.tree-node').each(function(){
            var level = countTreeLevel(this);
            var value = $(this).attr('data-value');
            var parent = $(this).attr('parent');
            $(this).attr('level',level);
            $(this).css('padding-left',(parseInt(level)-1)*10 +'px');
            /** click on tree item **/
            $(this).find('input[type="checkbox"]').click(function(){
                if($(this).is(':checked'))
                {
                    $(this).closest('.tree-node').clickTreeItem('true');
                } else {
                    $(this).closest('.tree-node').clickTreeItem();
                }
            });
        });
    });
    $.fn.clickTreeItem = (function(click){
        var value = $(this).attr('data-value');
        var parent = $(this).attr('parent');
        $(this).closest('.tree-view').find('.tree-node[parent="'+value+'"]').each(function(){
            if(click)
            {
                $(this).find('input[type="checkbox"]').attr('checked','checked');
            } else {
                $(this).find('input[type="checkbox"]').removeAttr('checked');
            }
            $(this).clickTreeItem(click);
        });
    });

}(jQuery));
function countTreeLevel(el)
{
    var count = 1;
    var parentId = $(el).attr('parent');
    if(parentId != 0){
    var parentItem = $(el).closest('.tree-view').find('.tree-node[data-value="'+parentId+'"]');
        count += countTreeLevel(parentItem);
    }
    return count;
}
//function goPage(el)
//{
//    var page = $(el).attr('data-value');
//    var dataSource = $(el).parent('li').parent('ul').attr('data-source');
//    if(page && dataSource)
//    {
//        $.get(dataSource,
//            {page:page},
//            function(rs)
//            {   if(rs.code == 'success' && typeof rs.data != 'undefined'){
//                if(typeof  callbackFunction== 'function')
//                {
//                    callbackFunction(rs.data);
//                    $(root).find('li').removeClass('active');
//                    $(els).addClass('active');
//                }
//            }
//            },'json'
//        );
//    }
//}

function toAnsi(text){
    //text = html_entity_decode (text);
    text = text.replace(/(ä|à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
    text = text.replace(/ç/g,"c");
    text = text.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
    text = text.replace(/(ì|í|î|ị|ỉ|ĩ)/g, 'i');
    text = text.replace(/(ö|ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
    text = text.replace(/(ü|ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
    text = text.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
    text = text.replace(/(đ)/g, 'd');
    /** upper case */
    text = text.replace(/(Ä|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/g, 'A');
    text = text.replace(/Ç/g,"C");
    text = text.replace(/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/g, 'E');
    text = text.replace(/(Ì|Í|Ị|Ỉ|Ĩ)/g, 'I');
    text = text.replace(/(Ö|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/g, 'O');
    text = text.replace(/(Ü|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/g, 'U');
    text = text.replace(/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/g, 'Y');
    text = text.replace(/(Đ)/g, 'D');
    text = text.toLowerCase();
    text = text.replace(/ +/g,"-");
    text=text.replace(/\s\s+/, '-');
    //text=trim(preg_replace('/[^a-z0-9 ]/', ''));
    text = text.replace("----","-");
    text = text.replace("---","-");
    text = text.replace("--","-");
    return text;
}

function changeUriParam(paramName, paramValue,link)
{
    var url = window.location.href;
    if(typeof link !== 'undefined')
    {
        url = link;
    }
    var pattern = new RegExp('('+paramName+'=).*?(&|$)')
    var newUrl=url
    if(url.search(pattern)>=0){
        newUrl = url.replace(pattern,'$1' + paramValue + '$2');
    }
    else{
        newUrl = newUrl + (newUrl.indexOf('?')>0 ? '&' : '?') + paramName + '=' + paramValue
    }
    return newUrl
}

function getURLParam(paramName){
    var url = window.location.href;
    if(url.indexOf("?")>0){
        list = url.split("?");
        url = list[1];

        if(url.indexOf(paramName+ "=")>=0){
            var paramList = url.split("&");
            for(var i=0; i<paramList.length; i++){
                var param = paramList[i].split("=");
                if(paramName == param[0]){
                    return param[1];
                }
            }
        }
    }
    return "";
}
/** Ckeditor config **/
function initCKeditor(fieldName,toolBar,width,height){
    var toolbar=(toolBar==null)?'Full':toolBar;
    var width=(width==null)?'100%':width;
    var height=(height==null)?400:height;
    var ck = CKEDITOR.replace(fieldName,{toolbar: toolbar,width: width,height: height});
    CKFinder.selectActionFunction = setFileField;
    CKFinder.setupCKEditor( ck, '/public/3rd/ckfinder/');

}

function updateCKEditor()
{
    for ( instance in CKEDITOR.instances )
    {
        CKEDITOR.instances[instance].updateElement();
        CKEDITOR.instances[instance].on('change',function(e) {
           // console.log(e);
        });
    }

}
function resetCKEditor()
{
    for ( instance in CKEDITOR.instances )
    {
        CKEDITOR.instances[instance].setData('');
        CKEDITOR.instances[instance].updateElement();
    }

}
function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}

function unsetItem(needle, haystack, number)
{
    var index = haystack.indexOf(needle);
    if (index > -1) {
        var count = 1;
        if(!isNaN(number) && number >0)
        {
            count = number;
        }
        haystack.splice(index, count);
    }
    return haystack;
}

function slugify(el) {
    var val = $(el).val()
    $(el).closest('form').find('input[name="slug"]').val(toAnsi(val));
}

function str_repeat(pattern, count) {
    if (count < 1) return '';
    var result = '';
    while (count > 1) {
        if (count & 1) result += pattern;
        count >>= 1, pattern += pattern;
    }
    return result + pattern;
}

function check_new_contacts (time) {
    $.get('/cp/contacts/get_new_contacts', function(data) {
        $('.num_contact').html(data.count);
        if (data.count > 0) {
            $('#header_inbox_bar .badge.bg-important').show();
            var list = '';
            $(data.contacts).each(function(index, el) {
                list += '<li><a href="#view-contact" data-toggle="modal" data-rel="'+el['id']+'" onclick="view_detail_contact('+el['id']+')"><span class="subject"><span class="from">'+el['contact_user']+'</span></span><span class="message">'+el['contact_content'].substr(0,34)+'...</span></a></li>';
            });
            $('#header_inbox_bar ul.list-new-contact').html(list);
        } else {
            $('#header_inbox_bar .badge.bg-important').hide();
        };
    });
    setTimeout(function() {
        check_new_contacts(time);
    },time);
}

function view_detail_contact (id) {
    $.get('/cp/contacts/get/'+id, function(data) {
        $('#view-contact').find('span').each(function(index, el) {
            if(typeof data[$(el).attr('data-rel')] != 'undefined') {
                $(el).html(data[$(el).attr('data-rel')]);
            };
        });
    });
    $.post('/cp/contacts/edit/'+id, { status: 1}, function() {});
}

function check_unapproved_comments (time) {
    $.get('/api/get-comments-unapproved', function(data) {
        $('.num_comments').html(data.data.count);
        if (data.data.comments.length > 0) {
            $('#header_comment_bar .badge.bg-warning').show();
            var list = '';
            $(data.data.comments).each(function(index, el) {
                list += '<li><a href="#show-comments" data-toggle="modal" data-rel="'+el['id']+'" onclick="show_comments('+el['id']+')"><span class="subject"><span class="from">'+el['fullname']+'</span></span><span class="message">'+el['content'].substr(0,34)+'...</span></a></li>';
            });
            $('#header_comment_bar ul.list-comments').html(list);
        } else {
            $('#header_comment_bar .badge.bg-warning').hide();
        };
    }, 'json');
    setTimeout(function() {
        check_unapproved_comments(time);
    },time);
}

/** Change comments status **/
function change_comment_status(id, status) {
    if(!isNaN(id))
    {
        $.post('/cp/news/edit-comment', {id:id,status:status}, function(data) {
            showDialog(data);
        });
    }
}

function show_comments (id) {
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
                        change_comment_status(id, 1);
                        location.reload();
                    }
                });
            }
        }
    );
}
$(function() {
    /** Submit reply comment **/
    $('#reply-comment').submit(function(e){
        e.preventDefault();
        var form = $(this);
        $.post('/cp/news/save-comment',
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
    // Get users online number
});

function append_users_online_statistics (time) {
    $.get('/api/users-online', function(data) {
        $('.users_online').html(data.data);
    }, 'json');
    setTimeout(function() {
        append_users_online_statistics(time);
    },time);
}



function get_articles(type) {
    var list = '';
    $.get('/api/get-articles?type='+type, function(data) {
        $.each(data.data, function(index, article) {
            list += '<article class="media">';
            list += '<a class="pull-left thumb p-thumb">';
            list += '<img src="'+ article.thumbnail +'">';
            list += '</a>';
            list += '<div class="media-body">';
            list += '<a href="#" class=" p-head">'+ article.name +'</a>';
            list += '<p>'+ article.brief.substr(0,56) +'</p>';
            list += '</div>';
            list += '</article>';
        });
        $('#tab_list_articles .tab-pane').html(list);
    }, 'json');
}

function count_all_records (api_name) {
    $.get('/api/'+api_name+'?action=count', function(data) {
        $('div[module-rel='+api_name+'] h1').text(data.data);
    }, 'json');
}

function module_access () {
    $.get('/api/module?action=active', function(data) {
        var modules = data.data;
        modules.push('all');

        var item_num = 0;
        var classCol = 'col-md-12';
        $('div[data-rel=modules] .item').each(function(index, el) {
            if ($.inArray($(el).attr('module-rel'), modules) >= 0) {
                item_num++;
                $(el).show();
                switch(item_num) {
                    case 2:
                        classCol = 'col-md-6';
                        break;
                    case 3:
                        classCol = 'col-md-4';
                        break;
                    case 4:
                        classCol = 'col-md-3';
                        break;
                    case 5:
                    case 6:
                        classCol = 'col-md-2';
                        break;
                    default:
                        classCol = 'col-md-12';
                        break;
                }
                // console.log($(el).attr('module-rel'));
            };
        });
        $('div[data-rel=modules] .item').addClass(classCol);
        $('#sidebar ul[data-rel=modules] > li').each(function(index, el) {
            if ($.inArray($(el).attr('module-rel'), modules) < 0) {
                $(el).remove();
            }
        });
    }, 'json');
}