export default function sliderBanner() {
    let img_width = $(".slider-imgs a").outerWidth() * 2;
    let index = 1;
    let num_of_img = $(".slider-imgs a").length;
    let img_of_per_slider = 2;
    let slider_turn = num_of_img / img_of_per_slider;
    $(".slider-dots:eq(0)").addClass("bg-green-600");
    setInterval(() => {
        $(".slider-dots").removeClass("bg-green-600");
        index++;
        if (index >= slider_turn) index = 0;
        $(`.slider-dots:eq(${index})`).addClass("bg-green-600");
        $(".slider-imgs").css({
            transform: `translateX(-${index * img_width}px)`,
        });
    }, 3000);
}
