export default function changeQuantityProductCat() {
    let timeout;

    $(document).on("change", ".product_cart_quantity", function () {
        let qty = $(this).val();
        let row_id = $(this).data("id");
        let price = $(this).data("price");

        let data = { qty: qty, row_id: row_id, price: price };

        clearTimeout(timeout);

        timeout = setTimeout(() => {
            $.ajax({
                type: "post",
                url: "/gio-hang/changeQuantity",
                data: data,
                dataType: "json",
                success: function (data) {
                    $(".total-amount-" + data.rowId).html(data.subtotal);
                    $(".total-amount").html(data.cart_provisional);
                    $(".cart-count").html(data.view_cart_count);
                    $(".view-ship").html(data.view_ship);
                    $(".cart-total").html(data.cart_total);
                    $(".cash-to-free-ship").html(data.cash_to_free_ship);
                    $(".total").html(data.cart_count);
                },
            });
        }, 300);
    });
}
