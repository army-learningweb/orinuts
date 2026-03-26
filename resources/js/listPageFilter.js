export default function listPageFilter(){
    // Danh sách lọc + tìm kiếm
    $(document).on('input','.filter_status_page, .search_page',function(){
        let status_value = $('.filter_status_page').val();
        let search_value = $('.search_page').val();

        let data = {
            status_value:status_value,
            search_value:search_value
        }

        ajax_with_blade_action('/admin/pages/list',data);
        
    });

    // Tìm kiếm ở thùng rác
    $(document).on('input','.search_page_trash',function(){
        let search_value = $(this).val();
        let data = {search_value:search_value};

        ajax_with_blade_action('/admin/pages/trash',data);
    })

    // Tùy chỉnh nút phân trang cùng với bộ lọc + tìm kiếm
    $(document).on('click','.page_pagination a',function(e){
        e.preventDefault();

        let status_value = $('.filter_status_page').val();
        let search_value = $('.search_page').val();

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
                $('.list_pages').html(data.view);
            }
        });
    }
   
}