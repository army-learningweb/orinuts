export default function listUsersFilter() {
    // Lọc theo trạng thái + tìm kiếm (Ajax) ------------------------------------
    $(document).on("input", ".filter_status_user, .search_user", function () {
        let status_value = $(".filter_status_user").val();
        let search_value = $(".search_user").val();
        let data = {
            status_value: status_value,
            search_value: search_value,
        };
        ajax_action_with_blade(data, "/admin/users/list");
    });

    // Tìm kiếm ở trash_list (Ajax)
    $(document).on("input", ".search_user_trash", function () {
        let search_value_trash = $(".search_user_trash").val();
        let data = { search_value_trash: search_value_trash };
        ajax_action_with_blade(data, "/admin/users/trash");
    });

    // Tùy chỉnh phân trang kết hợp với lọc + tìm kiếm (normal_list) - (trash_list) (Ajax) ------------------------------------
    $(document).on("click", ".user_pagination a", function (e) {
        // Vô hiệu hóa GET a của Panigation cho route thành POST
        e.preventDefault();
        
        let url = $(this).attr('href');
        let status_value = $(".filter_status_user").val();
        let search_value = $(".search_user").val();
          
        let data = {
            status_value: status_value,
            search_value: search_value,
        };
        ajax_action_with_blade(data, url);
    });

    // Hàm Ajax POST method dùng chung
    function ajax_action_with_blade(data, url) {
        $.ajax({
            type: "post",
            url: url,
            data: data,
            dataType: "json",
            success: function (data) {
                if (data.view == "") {
                    $(".list_users").html(
                        '<p class="text-gray-500 px-3 pt-0 rounded-lg"> Nội dung này chưa có bản ghi nào ! </p>',
                    );
                } else {
                    $(".list_users").html(data.view);
                }
            },
        });
    }
}
