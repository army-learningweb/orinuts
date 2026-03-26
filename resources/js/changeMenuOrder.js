export default function changeMenuOrder(){
    $(document).on('change','.menu-order',function(){
        let order_value = $(this).val();
        let menu_id = $(this).data('id');

        let data = {order_value:order_value,menu_id:menu_id}

        $.ajax({
            type: "post",
            url: "/admin/menu/changeOrder",
            data: data,
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('.order-num-'+data.menu_id).html(data.order_value);
            }
        });
    })
}