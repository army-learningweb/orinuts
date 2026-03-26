export default function sliderProduct(){

    let index = 0;
    let product_per_slide = 5;
    let windowWidth = $(window).width();
    if(windowWidth < 500){
        product_per_slide = 1;
    }

    $(document).on('click','.btn-next',function(){

        index++;
        
        let product_length = $(this).parent().parent().next('.box').find('.slider-item').length;
        let slider_turn = Math.ceil(product_length/product_per_slide);
        
        if(index >= slider_turn) index = 0;
        console.log(index);
        let product_width = $(this).parent().parent().next('.box').find('.slider-item').outerWidth();
        let translate_value = index*product_width;

        $(this).parent().parent().next('.box').find('.slider').css({
            'transform':`translateX(-${translate_value}px)`
        });
    })

    $(document).on('click','.btn-prev',function(){

        index--;
        
        let product_length = $(this).parent().parent().next('.box').find('.slider-item').length;
        let slider_turn = Math.ceil(product_length/product_per_slide);

        if(index < 0) index = 0;

        let product_width = $(this).parent().parent().next('.box').find('.slider-item').outerWidth();
        let translate_value = index*product_width;

        $(this).parent().parent().next('.box').find('.slider').css({
            'transform':`translateX(${translate_value}px)`
        });
    })
}