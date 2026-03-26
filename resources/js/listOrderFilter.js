export default function listOrderFilter(){
    // Danh sách lọc + tìm kiếm
    $(document).on('input','.filter_status_order, .search_order, .filter_status_date',function(){
        let status_value = $('.filter_status_order').val();
        let search_value = $('.search_order').val();
        let date_value = $('.filter_status_date').val();
        let data = {
            status_value:status_value,
            search_value:search_value,
            date_value:date_value
        }  

        console.log(data);
        ajax_with_blade_action('/admin/orders',data);
        
    });

    // Tùy chỉnh nút phân trang cùng với bộ lọc + tìm kiếm
    $(document).on('click','.order_pagination a',function(e){
        e.preventDefault();

        let status_value = $('.filter_status_order').val();
        let search_value = $('.search_order').val();

        let page_link = $(this).attr('href');

        let data = {
            status_value:status_value,
            search_value:search_value,
        }

        ajax_with_blade_action(page_link,data);
    })

    function ajax_with_blade_action(page_link = '',data){
        $.ajax({
            type: "post",
            url: page_link,
            data: data,
            dataType: "json",
            success: function (data) {
                console.log(data);
                $('.list_orders').html(data.view);
            }
        });
    }
   
}