export default function modalDeleteAccount(){
    $(document).on("click",".open-modal",function(){
        $(".modal-delete-account").toggleClass("opacity-0 pointer-events-none")
        $(".modal-slide-down").addClass("animation_slide_down")
    })
    $(document).on("click",".close-modal",function(){
        $(".modal-delete-account").toggleClass("opacity-0 pointer-events-none")
        $(".modal-slide-down").removeClass("animation_slide_down")
        $(".error-field").remove()
        $(".input-password-destroy").removeClass("border-red-700 ring-1 ring-red-700")
    })

    let modal_error = $(".modal-delete-account").attr("password-error");
    if(modal_error){
        $(".modal-delete-account").toggleClass("opacity-0 pointer-events-none")
    }
}