export default function provisionalTotal(){
    $(document).on('input','#product_quantity',function(){
        let product_quantity = $(this).val();
        let product_id = $('.product_id').val();
        let url = $('.url').val();
        let data = {product_quantity:product_quantity,product_id:product_id}

        $.ajax({
            type: "post",
            url: url,
            data: data,
            dataType: "json",
            success: function (data) {
               
                $('.provisional-total').html(data.new_price);
                $('.total-from-detail').val(data.price_value);
            }
        });
    })
}