<table class="table">
    <thead>
    <tr id="search_customer_modal_box__body_inner_header">
        <th>ID</th>
        <th>タイトル</th>
        <th>決定</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->title }}</td>
            <td>
                <button type="button" class="btn btn-default btn-sm set-product"
                        data-id="{{ $product->id }}" data-name="{{ $product->title }}"
                        data-image="{{ $product->image }}"
                        data-width="{{ $product->ratio->width * 600 }}" data-height="{{ $product->ratio->height * 600 }}">
                    決定
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    // 商品選択時
    $('.set-product').click(function () {
        var id = $(this).data('id');
        $('#productApp').scope().initFabric($(this).attr('data-width'), $(this).attr('data-height'));
        $('#productApp').scope().loadProduct( $(this).data('name'), $(this).data('image'), id);
        setTimeout(function(){
            $('#productApp').scope().deactivateAll();
            var json = $('#productApp').scope().getDesignJson();

            $.ajax({
                type: 'post',
                data: {
                    'id': id,
                    'index': $('.item_box').length,
                    'json': json,
                    '_token': '{{csrf_token()}}'
                },
                url: '{{ url('/admin/products/ajaxSearch') }}'
            }).done(function (data) {
                $('.order_list').append(data);

                $('.product_result_area').html('');
                $('#product-search-modal').modal('hide');
                $('#product-search-modal').trigger('click');
            }).fail(function (data) {
                // alert("error!");
            });
        },100);
    });
</script>
