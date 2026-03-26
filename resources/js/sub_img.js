export default function sub_img(){
    let sub_img = $('.sub_img');

    sub_img.first().addClass('opacity-100');
    sub_img.first().removeClass('opacity-70');

    $(document).on('click','.sub_img',function(){
        let this_img = $(this).attr('src');
        $('.feature_img').attr('src',this_img);

        $('.sub_img').addClass('opacity-70');
        $('.sub_img').removeClass('opacity-100');  

        $(this).addClass('opacity-100');
        $(this).removeClass('opacity-70');
    })

    $(document).on('click','.btn-next-img',function(){

        if(sub_img.last().hasClass('opacity-100')){
            $(sub_img).first().click();
        }else{
            $(this).parents('.feature').next().find('.sub_img.opacity-100').next().click();
        }
       
    })

    $(document).on('click','.btn-prev-img',function(){

        if(sub_img.first().hasClass('opacity-100')){
            $(sub_img).last().click();
        }else{
            $(this).parents('.feature').next().find('.sub_img.opacity-100').prev().click();
        }
       
    })
}