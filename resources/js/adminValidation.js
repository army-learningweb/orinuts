export default function adminValidation() {
    let timeout = null;

    $(document).on("input", "input, select, textarea", function () {
        let input_field = $(this).attr("name");
        let input_value = $(this).val();
        let data = {[input_field]: input_value };
        
        // Tắt validete php
        $(".php_error_" + input_field).remove();

        clearTimeout(timeout);

        timeout = setTimeout(() => {
            $.ajax({
                type: "post",
                url: "/admin/validation",
                data: data,
                dataType: "json",
                success: function (data) {
                    $(".ajax_error_" + input_field).addClass("hidden");
                    $(".ajax_error_" + input_field).html("");
                    $(".input_" + input_field).removeClass(
                        "border-red-700 ring-1 ring-red-700",
                    );
                    $(".select_" + input_field).removeClass(
                        "border-red-700 ring-1 ring-red-700",
                    );
                    $(".textarea_" + input_field).removeClass(
                        "border-red-700 ring-1 ring-red-700",
                    );
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        if (errors) {
                            $(`input[name=${input_field}]`).addClass(
                                "border-red-700 ring-1 ring-red-700",
                            );
                            $(".ajax_error_" + input_field).removeClass("hidden");
                            $(".ajax_error_" + input_field).html( `<i class="fa-solid fa-circle-exclamation"></i> ${errors[input_field][0]}`);
                        }
                    }
                },
            });
        }, 150);
    });
}
