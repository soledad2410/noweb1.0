<div class="product-details">
    <h3>Chi tiết sản phẩm {{$product->name}}</h3>
    <div class="product-cate">
        <div class="left-info col-md-4">
            <img src="{{$url->get_thumbnail($product)}}" width="300" alt="no-image" title=""/>
        </div>
        <div class="right-info col-md-8 p-info">
            <div class="item">
                <div class="col-md-3"><span class="strong">Mô tả ngắn: </span></div>
                <div class="col-md-9">{{$product->brief}}</div>
            </div>
            @foreach ($pp as $item)
            <?php $product_var = $item->product_var;?>
            <div class="item">
                <div class="col-md-3"><span class="strong">{{$item->title}}: </span></div>
                <div class="col-md-9">{{$product->$product_var}}</div>
            </div>
            @endforeach
            <div class="item">
                <div class="col-md-3"><span class="strong">Đơn giá: </span></div>
                <div class="col-md-9"><span class="price">
                    {{($product->price != 0) ? number_format($product->price) . ' VNĐ' : 'Liên hệ ngay để đưọc báo giá'}}
                </span></div>
            </div>
        </div>
    </div>
</div>
<div class="social">
    <div class="addthis_native_toolbox"></div>
</div>
@if (isset($relatedProducts) && count($relatedProducts) > 0)
<div class="product-related">
    <h3>Các sản phẩm khác</h3>
    <div class="list-prod">
        @foreach ($relatedProducts as $item)
        <div class="item-prod" id="pro_{{$item->id}}">
            <a class="prod-img" href="{{$url->get_product_url($item)}}">
                <img src="{{$url->get_thumbnail($item)}}" width="194" height="202"/>
            </a>
            <a class="prod-name" href="{{$url->get_product_url($item)}}">{{$item->name}}</a>
            <p class="item-summary">{{$item->brief}}</p>
        </div>
        @endforeach
    </div>
</div>
<script type="text/javascript">
$(function(){$(".list-prod").owlCarousel({items: 3,navigation : true});});
</script>
@endif