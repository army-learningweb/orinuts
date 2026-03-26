export default function listOutOfStock() {
    // Tùy chỉnh nút phân trang
    $(document).on("click", ".out_of_stock_pagination a", function (e) {
        e.preventDefault();

        let page_link = $(this).attr("href");
        let quantity = 10;
        let data = {quantity:quantity}
        
        $.ajax({
            type: "post",
            url: page_link,
            data: data,
            dataType: "json",
            success: function (data) {
                $(".list-out-of-stock").html(data.view);
            },
        });
    });
}
