export default function toggleSubmenu() {

    $(document).on("click",".main-menu a", function () {
        $(this).find("i.arrow-down").stop().toggleClass("rotate-90");
        $(this).next(".sub-menu").stop().slideToggle(250);

        $(this).parent().nextAll().find(".sub-menu").stop().slideUp();
        $(this).parent().prevAll().find(".sub-menu").stop().slideUp();

        $(this).parent().nextAll().find("a i.arrow-down").removeClass("rotate-90");
        $(this).parent().prevAll().find("a i.arrow-down").removeClass("rotate-90");
    });
}
