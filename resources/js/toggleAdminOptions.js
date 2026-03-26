export default function toggleAminOptions(){
    
    $(document).on('click','.admin-info',function(){
        $('.admin-options').toggleClass('opacity-0 pointer-events-none');
    })
}