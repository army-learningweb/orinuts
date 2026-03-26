export default function listReviewFilter(){
    // Danh tìm kiếm
    $(document).on('input','.search_review',function(){
        let search_value = $('.search_review').val();
        let data = {
            search_value:search_value
        }

        ajax_with_blade_action('/admin/reviews',data);
        
    });

    // Tùy chỉnh nút phân trang cùng với bộ lọc + tìm kiếm
    $(document).on('click','.review_pagination a',function(e){
        e.preventDefault();
        let search_value = $('.search_order').val();
        let page_link = $(this).attr('href');
        let data = {
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
                $('.list_reviews').html(data.view);
            }
        });
    }
   
}