export default function clientSearchProduct(){

    $(document).on('click','.open_search',function(){
        $('.search_box').removeClass('hidden');
    })

    $(document).on('click','.close_search',function(){
        $('.search_box').addClass('hidden');
    })

    $(document).on('input','.client_search_product',function(){
        let search_value = $(this).val();
        let data = {search_value:search_value}

        $.ajax({
            type: "post",
            url: "/tim-kiem",
            data: data,
            dataType: "json",
            success: function (data) {
                if(data.view != ''){
                    $('.client_list_search').html(data.view);
                }else{
                    $('.client_list_search').html(`Không có sản phẩm nào !`);
                }
                
            }
        });
    })
}