<div class="w-full h-full fixed z-50 search_box hidden bg-gray-800/50">
    <div class="w-[50%] mt-14 bg-white shadow-md rounded-md border p-3 px-5 translate-x-[50%]">
        <div class="flex justify-between items-center border-b">
            <div class="w-full">
                <form action="" method="post" class="w-full flex items-center">
                    @csrf
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" name="" id=""
                        class="client_search_product w-full border-none focus:ring-0 text-sm"
                        placeholder="Nhập tên sản phẩm...">
                </form>
            </div>
            <div><i class="fa-solid fa-xmark text-lg cursor-pointer text-gray-400 hover:text-gray-700 close_search"></i>
            </div>
        </div>
        <div class="mt-3 client_list_search">
            @if ($products_info->count() > 0)
                @include('client.partials.list_search')
            @else
                Không có sản phẩm nào !
            @endif
        </div>
        
    </div>
</div>
