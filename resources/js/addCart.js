export default function addCart() {
    $(document).on("click", ".add-cart", function (e) {
        e.preventDefault();

        let id = $(this).data("id");
        let data = { id: id };
        $.ajax({
            type: "post",
            url: "/gio-hang/add",
            data: data,
            dataType: "json",
            success: function (data) {
                $("main").append(data.status);
                $(".cart-place").html(data.view_cart_count);
            },
        });
    });
}
