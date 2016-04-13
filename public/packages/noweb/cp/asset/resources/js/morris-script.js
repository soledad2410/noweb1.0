$(function () {
    $('#visitor_statistics_method').change(function(event) {
        var method_name = $(this).find('option:selected').val();
        $.get('/api/visitors?action=get&time='+method_name, function(data) {
            append_chart(data.data);
        }, 'json');
    });
});

function append_chart (dataArr) {
    $('#hero-area').html('');
    Morris.Area({
        element: 'hero-area',
        data: dataArr,
        xkey: 'day',
        ykeys: ['mobile_num', 'web_num'],
        labels: ['Mobile', 'PC'],
        fillOpacity: 0.5,
        hideHover: 'auto',
        behaveLikeLine: true,
        lineWidth: 1,
        resize: true,
        pointSize: 5,
        lineColors: ['#4a8bc2', '#ff6c60'],
        smooth: true,
    });
}