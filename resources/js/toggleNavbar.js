export default function toggleNavbar(){

    $(document).on('click','.toggle_navbar',function(){
        $('.navbar').slideToggle(300);
    })
}