@props(['selector'])
<div>
    <script>
        tinymce.init({
            selector: '{{ $selector }}',
            plugins: 'image link media table code wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | alignleft aligncenter alignright lineheight | image media table | code',
            path_absolute: "/",
            file_picker_callback: function(callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document
                    .getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight;

                // Bỏ phần check meta.filetype, chỉ dùng URL cơ bản
                var cmsURL = '/laravel-filemanager?editor=' + meta.fieldname;

                tinyMCE.activeEditor.windowManager.openUrl({
                    url: cmsURL,
                    title: 'Trình quản lý ảnh',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        });
    </script>

</div>
