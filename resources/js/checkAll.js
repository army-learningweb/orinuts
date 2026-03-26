export default function checkAll(){
    $(document).on("click",".check_all",function(){
        let checked = $(this).prop("checked");
        $(".check_single").prop("checked",checked);
    })
}