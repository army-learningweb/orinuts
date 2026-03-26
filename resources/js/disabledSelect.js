export default function disabledSelect() {
    $(document).on("input", "select#page", function () {
        let select_product = $("select#product");
        let select_post = $("select#post");

        let this_value = $(this).val();

        if (this_value > 0) {
            select_product.prop("disabled", true);
            select_post.prop("disabled", true);
        } else {
            select_product.prop("disabled", false);
            select_post.prop("disabled", false);
        }
    });

    $(document).on("input", "select#product", function () {
        let select_page = $("select#page");
        let select_post = $("select#post");

        let this_value = $(this).val();
        
        if (this_value > 0) {
            select_page.prop("disabled", true);
            select_post.prop("disabled", true);
        } else {
            select_page.prop("disabled", false);
            select_post.prop("disabled", false);
        }
    });

     $(document).on("input", "select#post", function () {
        let select_page = $("select#page");
        let select_product = $("select#product");

        let this_value = $(this).val();
        
        if (this_value > 0) {
            select_page.prop("disabled", true);
            select_product.prop("disabled", true);
        } else {
            select_page.prop("disabled", false);
            select_product.prop("disabled", false);
        }
    });
}
