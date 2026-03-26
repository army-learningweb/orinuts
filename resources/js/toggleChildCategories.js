export default function toggleChildCategories(){
    $(document).on('click','.parent_cat',function(){
        $(this).find('i').toggleClass('fa-solid fa-folder');
        $(this).find('i').toggleClass('fa-solid fa-folder-open');
        $(this).parents('tr').nextUntil('.stop_open').toggleClass('hidden',300);
    });
}