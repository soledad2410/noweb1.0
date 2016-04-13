$(function() {
    // activate Nestable for list 1
    $('#nestable_list_1').nestable();

    // Button click
    $('#nestable_list_menu button').on('click', function (e) {
        var target = $(e.target),
            action = target.data('action');
        if (action === 'expand-all') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
        }

        if (action === 'save-change') {
            var btn = $(this);
            btn.button('loading');
            var e = $('#nestable_list_1');
            var list = e.length ? e : $(e.target);
            var data = list.nestable('serialize');
            $.post('/cp/template/navigation', { menu: data } , function(data, textStatus, xhr) {
                btn.button('reset');
                showDialog(data);
            });
        }
    });

    $(window).scroll(function(){
        if ($(window).scrollTop() >= 100) {
            $('#nestable_list_menu').css({
                position: 'fixed',
                right: '-108px',
                top: '120px',
                transition: 'all 1s ease-in-out'
            });
        } else {
            $('#nestable_list_menu').css({
                position: 'absolute',
                right: '-108px',
                top: '132px',
            });
        }
    });
})