<x-client-app-layout>
    <div class="flex flex-col md:flex-row items-start mt-2 gap-2">
        {{-- category --}}
        <div class="w-full md:w-[15%] bg-white p-4 rounded-md shadow-sm md:sticky top-2">
            <h1 class="font-semibold text-lg ml-2 text-gray-500 select-none">Danh mục sản phẩm</h1>
            <hr class="mt-3">
            <x-categories-product />
        </div>
        <div class="w-full md:w-[85%] animation_content_slide_up bg-white p-5 rounded-md overflow-hidden">
            <div class="px-2 flex flex-col md:flex-row justify-between items-start md:items-center">
                <div class="text-lg font-semibold select-none">Tất cả sản phẩm</div>

                <div class="flex flex-col md:flex-row gap-3 md:gap-2 mt-2 md:mt-0">
                    {{-- Tìm kiếm --}}
                    <div class="w-[300px]">
                        <form action="" method="POST" class="border-b w-full">
                            @csrf
                            <input type="text" placeholder="Nhập tên tìm kiếm..."
                                class="client_search_product text-sm border-0 outline-none ring-0 focus:border-0 focus:outline-none focus:ring-0 pl-0 w-[270px]" />
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </form>
                    </div>

                    {{-- Lọc --}}
                    <div class="flex flex-col md:flex-row items-center gap-1">
                        <form action="" method="post" class="w-full md:w-auto">
                            @csrf
                            <select name="client_filter_price" id="client_filter_price" class="py-[4px] font-semibold rounded-md text-sm border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 w-full">
                                <option value="">- Sắp xếp theo giá -</option>
                                <option value="high-to-low">Từ cao đến thấp</option>
                                <option value="low-to-high">Từ thấp đến cao</option>
                            </select>
                        </form>
                        <x-a-reset class="w-full md:w-auto text-center mt-1 md:mt-0"><i class="fa-solid fa-arrow-rotate-left"></i> Reset</x-a-reset>
                    </div>
                </div>
                
            </div>
            {{-- list-product --}}
            <div class="client_list_product mt-3">
                @include('client.product.partials.list_product')
            </div>
        </div>
    </div>
</x-client-app-layout>
