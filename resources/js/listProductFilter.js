export default function listProductFilter(){
    // Danh sách lọc + tìm kiếm
    $(document).on('input','.filter_status_product, .search_product',function(){
        let status_value = $('.filter_status_product').val();
        let search_value = $('.search_product').val();

        let data = {
            status_value:status_value,
            search_value:search_value
        }

        ajax_with_blade_action('/admin/product/list',data);
        
    });

    // Tìm kiếm ở thùng rác
    $(document).on('input','.search_product_trash',function(){
        let search_value = $(this).val();
        let data = {search_value:search_value};

        ajax_with_blade_action('/admin/product/trash',data);
    })

    // Tùy chỉnh nút phân trang cùng với bộ lọc + tìm kiếm
    $(document).on('click','.product_pagination a',function(e){
        e.preventDefault();

        let status_value = $('.filter_status_product').val();
        let search_value = $('.search_product').val();

        let page_link = $(this).attr('href');
        
       
        let data = {
            status_value:status_value,
            search_value:search_value,
        }
        ajax_with_blade_action(page_link,data);
    })

    function ajax_with_blade_action($page_link = '',data){
        $.ajax({
            type: "post",
            url: $page_link,
            data: data,
            dataType: "json",
            success: function (data) {
                $('.list_products').html(data.view);
            }
        });
    }
   
}