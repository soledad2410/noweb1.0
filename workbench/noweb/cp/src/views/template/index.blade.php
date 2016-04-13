<style type="text/css">
    figure{text-align:center;}
    figure >a {display:inline-block;overflow:hidden;width:100%;height:400px;}
    figure >a>img{width:100%;}
</style>
<!-- page start-->
<section class="panel">
    <header class="panel-heading">
        Danh sách giao diện website
    </header>
    <div class="panel-body">
        <ul class="grid cs-style-3 list-theme">
            @foreach($allThemes as $theme)
            <li class="col-lg-4">
                <figure>
                    <a href="{{$theme['thumb']}}" rel="group" class="fancybox"><img alt="img04" src="{{$theme['thumb']}}"></a>
                    <figcaption>
                        <h3>{{$theme['name']}}</h3>
                        @if(in_array($theme['name'],$installedThemes))
                        <a href="javascript:;">Cấu hình|</a>
                        <a href="javascript:;">Sửa|</a>
                        <a href="javascript:;">Xóa giao diện</a>
                        @else
                        <a href="javascript:;" onclick="installTheme('{{$theme["name"]}}')">Cài đặt|</a>
                        <a href="javascript:;" onclick="removeTheme('{{$theme["name"]}}')">Xóa giao diện</a>
                        @endif
                    </figcaption>
                </figure>
            </li>
            @endforeach
        </ul>
    </div>
</section>
<script type="text/javascript">
$(function(){
	$(".fancybox").fancybox();
})
</script>
<!-- page end-->
