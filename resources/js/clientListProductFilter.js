export default function clientListProductFilter(){

    let time;
    // Lọc sản phẩm
    $(document).on('input','#client_filter_price',function(){
        let filter_value = $(this).val();
        let data = {filter_value:filter_value}
        
        ajax_action_with_blade(data);
    })

    //Tìm kiếm
    $(document).on('input','.client_search_product',function(){
        let filter_search = $(this).val();
        let data = {filter_search:filter_search}

        clearTimeout(time)
        
        time = setTimeout(()=>{
            ajax_action_with_blade(data);
        },500)
        
    })

    $(document).on('click','.all_product_pagination a',function(e){
        e.preventDefault();
        let link = $(this).attr('href');
        let filter_value = $('#client_filter_price').val();
        let data = {filter_value:filter_value}

        ajax_action_with_blade(data,link);
    })

    function ajax_action_with_blade(data,link = '/san-pham'){
        $.ajax({
            type: "post",
            url: link,
            data: data,
            dataType: "json",
            success: function (data) {
                $('.client_list_product').html(data.view);
            }
        });
    }


}