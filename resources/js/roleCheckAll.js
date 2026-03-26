export default function roleCheckAll(){
    $(document).on('input','.check-all',function(){
        let checked = $(this).prop('checked');
        $(this).parents('tr').next('tr').find('.permission').prop('checked',checked);
    })
}