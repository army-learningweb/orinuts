export default function getNewOrder() {

    const url = window.location.href
    if(url != 'http://orinuts.test/admin/dashboard') return false

    setInterval(() => {
        $.ajax({
            type: "post",
            url: "/admin/dashboard/getNewOrder",
            dataType: "json",
            success: function (data) {
                $('.new_orders_list').html(data.view);
            },
        });
    }, 5000);
}
