<x-client-app-layout>
    <div class="flex flex-col md:flex-row items-start mt-2 gap-2">
        {{-- category --}}
        <div class="w-full md:w-[16%] bg-white p-4 rounded-md shadow-sm md:sticky top-2">
            <h1 class="font-semibold text-lg ml-2 text-gray-500 select-none">Danh mục bài viết</h1>
            <hr class="mt-3">
            <ul class="mt-2">
                @foreach ($post_categories as $cat)
                    <li><a href="{{ url($cat->slug) }}"
                            class="font-semibold hover:text-green-600 flex items-center justify-between py-2 w-full mt-1 px-2 rounded-md truncate {{ 'bai-viet/' . session('category_active') == $cat->slug ? 'active' : '' }}">
                            <span>{{ $cat->name }}</span>
                        </a>
                    </li>
                @endforeach
                <hr class="my-2">
                <div class="p-2">
                    <h1 class="font-semibold text-lg text-gray-500 select-none">Cảm hứng</h1>
                    <p class="mt-2 select-none">"Sức khỏe không phải là thứ chúng ta có thể mua. Tuy nhiên, nó có thể là
                        một tài khoản tiết kiệm cực kỳ giá trị."</p>
                </div>
                <hr class="my-2">
                <div class="p-2">
                    <h1 class="font-semibold text-lg text-gray-500 select-none">Sống khỏe</h1>
                    <p class="mt-2 select-none">"Người có sức khỏe có hy vọng; và người có hy vọng có tất cả mọi thứ."
                    </p>
                </div>
            </ul>
        </div>
        {{-- post_details --}}
        <div class="post-details w-full md:flex-1 bg-white p-5 shadow-sm rounded-md overflow-y-auto animation_content_slide_up">
            <div><img src="{{ $post_details->media ? asset($post_details->media->url) : '' }}" alt="" class="w-full h-[350px] object-cover shadow-md"></div>
            <div class="title font-semibold text-xl mt-3">{{ $post_details->title }}</div>
            <div class="desc mt-1 text-md text-gray-500">{{ $post_details->desc }}</div>
            <hr class="my-3">
            <div class="details mt-2 leading-6">{!! $post_details->details !!}</div>
        </div>
        <div class="list-post w-full md:w-[25%] bg-white shadow-sm rounded-md p-5">
            <p class="font-semibold text-lg">Các bài viết khác</p>
            <hr class="my-3">
            <ul>
                @foreach ($posts as $post)
                    <li class="mt-3 flex gap-10 justify-between">
                        <a href="{{ url($post->slug).'.html' }}" class="inline-block truncate text-blue-600 hover:underline underline-offset-2">{{ $post->title }}</a>
                        <span>{{ $post->created_at->format('d/m/Y') }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-client-app-layout>
