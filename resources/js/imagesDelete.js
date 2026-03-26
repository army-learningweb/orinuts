export default function imagesDelete() {
    $(document).on("click", ".delete_img", function () {
        let role = $(this).prev('input').attr('role');
        let id = $(this).prev('input').attr('data-id');
        let module = $(this).attr('data-module');
        let id_media = $(this).nextAll(".id_img_"+module).val();

        let data = {
            role:role,
            id:id,
            id_media:id_media,
            module:module
        }
        
        $(this).addClass('hidden');
        $(this).siblings('.url_img_'+module).attr('src','');
        $(this).siblings('.id_img_'+module).val('');
        $(this).siblings('label').removeClass('hidden');
        $(this).siblings('.file_error').html('');

        $.ajax({
            type: "post",
            url: "/admin/deleteFile",
            data: data,
            dataType: "json",
            success: function (data) {
                
            }
        });
    });
}
