export default function getNewAlert() {

    const url = window.location.href
    if(url != 'http://orinuts.test/admin/dashboard') return false
    
    setInterval(() => {
        $.ajax({
            type: "post",
            url: "/admin/dashboard/getNewAlert",
            dataType: "json",
            success: function (data) {
                $('.new_orders_alert').html(data.view);
                $('.alert_count').html(data.alert_count);
                $('.pending_num_stat').html(data.alert_count);
            },
        });
    }, 5000);
}
