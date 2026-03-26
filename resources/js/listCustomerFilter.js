export default function listCustomerFilter(){
    // Danh sách theo tìm kiếm
    $(document).on('input','.search_customer',function(){
        let search_value = $('.search_customer').val();
        let data = {
            search_value:search_value
        }

        ajax_with_blade_action('/admin/customers',data);
        
    });

    // Tìm kiếm ở trash_list (Ajax)
    $(document).on("input", ".search_customer_trash", function () {
        let search_value_trash = $(".search_customer_trash").val();
        let data = { search_value_trash: search_value_trash };

        ajax_with_blade_action("/admin/customers/trash",data);
    });

    // Tùy chỉnh nút phân trang cùng với bộ lọc + tìm kiếm
    $(document).on('click','.customer_pagination a',function(e){
        e.preventDefault();

        let search_value = $('.search_customer').val();
        let page_link = $(this).attr('href');
        let data = { search_value:search_value }
        console.log(page_link);
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
                $('.list_customers').html(data.view);
            }
        });
    }
}