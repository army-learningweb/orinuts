export default function imagesUpload() {
    $(document).on("change", "#file,#sub_file_1,#sub_file_2,#sub_file_3,#sub_file_4", function () {

        let file = this.files[0];
        let role = $(this).attr('role');
        let id = $(this).attr('data-id');
        let module = $(this).attr('data-module');
        
        let data = new FormData();
        data.append("file", file);
        data.append("role", role);
        data.append("id",id);
        data.append("module",module);

        $.ajax({
            type: "post",
            url: "/admin/uploadFile",
            processData: false,
            contentType: false,
            data: data,
            dataType: "json",
            success: (data) => {
                $(this).nextAll('.url_img_'+data.module).attr('src',data.img_url);
                $(this).nextAll('.id_img_'+data.module).val(data.img_id);
                $(this).nextAll('label').addClass('hidden');
                $(this).nextAll('.delete_img').removeClass('hidden');
                $(this).nextAll('.remove_img').removeClass('hidden');
                $(this).nextAll('.file_error').html('');
            },
            error: (xhr) => {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    if (errors.file) {
                        $(this).nextAll('img').attr('src','');
                        $(this).nextAll('.delete_img').addClass('hidden');
                        $(this).nextAll('.file_error').html(`<i class="fa-solid fa-file-circle-exclamation"></i> ${errors.file[0]}`);
                    }
                }
            },
        });
    });
}
