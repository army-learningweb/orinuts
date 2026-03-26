export default function imagesRemove() {
    $(document).on("click", ".remove_img", function () {

        let module = $(this).attr('data-module');
        
        $(this).addClass('hidden');
        $(this).siblings('.url_img_'+module).attr('src','');
        $(this).siblings('.id_img_'+module).val('');
        $(this).siblings('label').removeClass('hidden');
        $(this).siblings('.file_error').html('');

    });
}
