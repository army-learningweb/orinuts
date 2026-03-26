export default function updateStatus(){
    // Danh mục bài viết
     $(document).on('change','.post_category_status',function(){
        let status_value = $(this).val();
        let category_id = $(this).data('id');
        let data = {status_value:status_value,category_id:category_id}
        
        $.ajax({
            type: "post",
            url: "/admin/post/categories/updateStatusCategory",
            data: data,
            dataType: "json",
            success: function (data) {
                $('.post_category_'+data.category_id).html(data.view);
                $('.post_active_status_category').html(`(${data.active_status})`);
                $('.post_unactive_status_category').html(`(${data.unactive_status})`);
            }
        });
    })

    // Danh mục sản phẩm
     $(document).on('change','.product_category_status',function(){
        let status_value = $(this).val();
        let category_id = $(this).data('id');
        let data = {status_value:status_value,category_id:category_id}
        
        $.ajax({
            type: "post",
            url: "/admin/product/categories/updateStatusCategory",
            data: data,
            dataType: "json",
            success: function (data) {
                $('.product_category_'+data.category_id).html(data.view);
                $('.active_status_category').html(`(${data.active_status})`);
                $('.unactive_status_category').html(`(${data.unactive_status})`);
            }
        });
    })

    // Sản phẩm
    $(document).on('change','.product_status',function(){
        let status_value = $(this).val();
        let product_id = $(this).data('id');
        let data = {status_value:status_value,product_id:product_id}
        
        $.ajax({
            type: "post",
            url: "/admin/product/updateStatus",
            data: data,
            dataType: "json",
            success: function (data) {
                $('.product_status_'+data.product_id).html(data.view);
                $('.active_status_product').html(`(${data.active_status})`);
                $('.unactive_status_product').html(`(${data.unactive_status})`);
            }
        });
    })

    // Bài viết
    $(document).on('change','.post_status',function(){
        let status_value = $(this).val();
        let post_id = $(this).data('id');
        let data = {status_value:status_value,post_id:post_id}

        $.ajax({
            type: "post",
            url: "/admin/post/updateStatus",
            data: data,
            dataType: "json",
            success: function (data) {
                $('.post_status_'+data.post_id).html(data.view);
                $('.publish_status_post').html(`(${data.publish_status})`);
                $('.draft_status_post').html(`(${data.draft_status})`);
                $('.pending_status_post').html(`(${data.pending_status})`);
                $('.disable_status_post').html(`(${data.disable_status})`);
            }
        });
    })

    // Thành viên
    $(document).on("change", ".user_status", function () {
        let status_value = $(this).val();
        let user_id = $(this).attr("data-id");
        let data = { status_value: status_value, user_id: user_id };
        $.ajax({
            type: "post",
            url: "/admin/users/updateStatus",
            data: data,
            dataType: "json",
            success: function (data) {
                $(".user_id_" + data.user_id).html(data.view);
                $(".active_status").html("(" + data.active_status + ")");
                $(".subpended_status").html("(" + data.subpended_status + ")");
                $(".unactive_status").html("(" + data.unactive_status + ")");
            },
        });
    });

    // Sliderr
    $(document).on("change", ".slider_status", function () {
        let status_value = $(this).val();
        let slider_id = $(this).attr("data-id");
        let data = { status_value: status_value, slider_id: slider_id };

        $.ajax({
            type: "post",
            url: "/admin/sliders/updateStatus",
            data: data,
            dataType: "json",
            success: function (data) {
                $('.slider_status_'+data.slider_id).html(data.view);
            },
        });
    });

    // Page
    $(document).on("change", ".page_status", function () {
        let status_value = $(this).val();
        let page_id = $(this).attr("data-id");
        let data = { status_value: status_value, page_id: page_id };

        $.ajax({
            type: "post",
            url: "/admin/pages/updateStatus",
            data: data,
            dataType: "json",
            success: function (data) {
                $('.page_status_'+data.page_id).html(data.view);
                $(".publish_status").html("(" + data.publish_status + ")");
                $(".draft_status").html("(" + data.draft_status + ")");
                $(".disable_status").html("(" + data.disable_status + ")");
            },
        });
    });

    // Menu
    $(document).on("change", ".menu_status", function () {
        let status_value = $(this).val();
        let menu_id = $(this).attr("data-id");
        let data = { status_value: status_value, menu_id: menu_id };
        
        $.ajax({
            type: "post",
            url: "/admin/menu/updateStatus",
            data: data,
            dataType: "json",
            success: function (data) {
                $('.menu_status_'+data.menu_id).html(data.view);
            },
        });
    });

    // order
    $(document).on("change", ".order_status", function () {
        let status_value = $(this).val();
        let order_id = $(this).attr("data-id");
        let data = { status_value: status_value, order_id: order_id };

        $.ajax({
            type: "post",
            url: "/admin/orders/updateStatus",
            data: data,
            dataType: "json",
            success: function (data) {

                if(data.status_value == 'canceled'){
                    $('.is_delivered_'+data.order_id).prop("disabled",true);
                    $('.view_details_'+data.order_id).html('...');
                }

                $('.order_status_'+data.order_id).html(data.view);
                $(".pending_status").html("(" + data.pending_status + ")");
                $(".processing_status").html("(" + data.processing_status + ")");
                $(".shipped_status").html("(" + data.shipped_status + ")");
                $(".delivered_status").html("(" + data.delivered_status + ")");
                $(".canceled_status").html("(" + data.canceled_status + ")");
                $(".revenue").html(data.revenue);
            },
        });
    });

    // Review
    $(document).on("change", ".review_status", function () {
        let status_value = $(this).val();
        let review_id = $(this).attr("data-id");
        let data = { status_value: status_value, review_id: review_id };
        
        $.ajax({
            type: "post",
            url: "/admin/reviews/updateStatus",
            data: data,
            dataType: "json",
            success: function (data) {
                $('.review_status_'+data.review_id).html(data.view);
                $('.pending_status_review').html("(" + data.pending_status + ")");
                $('.publish_status_review').html("(" + data.publish_status + ")");
                $('.canceled_status_review').html("(" + data.canceled_status + ")");
            },
        });
    });

}