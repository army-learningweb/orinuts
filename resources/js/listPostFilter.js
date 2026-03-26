export default function listPostFilter(){
    // Danh sách lọc + tìm kiếm
    $(document).on('input','.filter_status_post, .search_post',function(){
        let status_value = $('.filter_status_post').val();
        let search_value = $('.search_post').val();

        let data = {
            status_value:status_value,
            search_value:search_value
        }
        ajax_with_blade_action('/admin/post/list',data);
        
    });

    // Tìm kiếm ở thùng rác
    $(document).on('input','.search_post_trash',function(){
        let search_value = $(this).val();
        let data = {search_value:search_value};

        ajax_with_blade_action('/admin/post/trash',data);
    })

    // Tùy chỉnh nút phân trang cùng với bộ lọc + tìm kiếm
    $(document).on('click','.post_pagination a',function(e){
        e.preventDefault();

        let status_value = $('.filter_status_post').val();
        let search_value = $('.search_post').val();

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
                $('.list_posts').html(data.view);
            }
        });
    }
   
}