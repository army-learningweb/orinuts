export default function toggleSideBar(){
    $(document).on('click','.toggle-sidebar',function(){
        $(this).next('ul.main-menu').slideToggle(250);
    })

    $(window).on('resize',function(){
        if($(window).width() > 768){
            $('ul.main-menu').show();
        }
    })
}