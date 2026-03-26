export default function checkoutShip() {
    let timeout;

    $(document).on("change", ".payment_method", function () {
        let payment_method = $(this).val();
        let data = { payment_method: payment_method };

        clearTimeout(timeout);

        timeout = setTimeout(() => {
            $.ajax({
                type: "post",
                url: "/thanh-toan",
                data: data,
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    $(".checkout-ship").html(data.view_ship);
                    $(".cart-total").html(data.cart_total);
                },
            });
        }, 300);
    });
}
