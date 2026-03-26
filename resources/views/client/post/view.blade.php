<x-client-app-layout>
    <div class="flex flex-col md:flex-row items-start mt-2 gap-2">
        {{-- category --}}
        <div class="w-full md:w-[16%] bg-white p-4 rounded-md shadow-sm md:sticky top-2">
            <h1 class="font-semibold text-lg ml-2 text-gray-500 select-none">Danh mục bài viết</h1>
            <hr class="mt-3">
            <ul class="mt-2">
                @foreach ($post_categories as $cat)
                    <li><a href="{{ url($cat->slug) }}"
                            class="font-semibold hover:text-green-600 flex items-center justify-between py-2 w-full mt-1 px-2 rounded-md truncate">
                            <span>{{ $cat->name }}</span>
                        </a>
                    </li>
                @endforeach

                <hr class="my-2">
                <div class="p-2">
                    <h1 class="font-semibold text-lg text-gray-500 select-none">Cảm hứng</h1>
                    <p class="mt-2 select-none">"Sức khỏe không phải là thứ chúng ta có thể mua. Tuy nhiên, nó có thể là một tài khoản tiết kiệm cực kỳ giá trị."</p>
                </div>

                <hr class="my-2">
                <div class="p-2">
                    <h1 class="font-semibold text-lg text-gray-500 select-none">Sống khỏe</h1>
                    <p class="mt-2 select-none">"Người có sức khỏe có hy vọng; và người có hy vọng có tất cả mọi thứ."</p>
                </div>
            </ul>
        </div>
        <div class="w-full md:w-[84%] animation_content_slide_up">
            {{-- banner slider --}}
            <div class="w-full bg-white shadow-sm rounded-md p-3">
                <div class="px-3">
                    <p class="select-none font-semibold text-lg">Mới nhất</p>
                    <hr class="my-2">
                </div>

                <div class="box overflow-hidden">
                    <div class="slider-imgs w-full h-full rounded-md flex transtion-all duration-300">
                        @foreach ($new_posts as $post)
                            <a href="{{ url($post->slug).'.html' }}" class="inline-block w-full md:w-[50%] shrink-0 h-full relative p-2 rounded-md">
                                <img src="{{ asset($post->media->url) }}" alt=""
                                    class="w-full h-[300px] object-cover rounded-md">
                                <div class="absolute left-10 top-12 z-10 p-5 text-white bg-black/70  w-[80%] rounded-md">
                                    <div class="title text-xl font-bold line-clamp-2 md:line-clamp-none">{{ $post->title }}</div>
                                    <div class="desc mt-2 line-clamp-2 md:line-clamp-none">{{ $post->desc }}</div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="text-xs w-full flex justify-center">
                    @for ($i = 1; $i <= $new_posts->count() / 2; $i++)
                        <div class="slider-dots w-[8px] h-[8px] rounded-full bg-gray-700 mx-[1px]"></div>
                    @endfor
                </div>
            </div>
            {{-- all post --}}
            <div class="bg-white p-5 rounded-md shadow-sm mt-2">
                <div class="bg-white shadow-sm rounded-md">
                    <p class="select-none font-semibold text-lg">Tất cả bài viết</p>
                    <hr class="my-2">
                    <div class="flex flex-wrap">
                        @foreach ($posts as $post)
                            <a href="{{ url($post->slug).'.html' }}" class="inline-block w-full md:w-[50%] p-2">
                                <div class="flex mt-2 gap-3">
                                    <div class="w-[40%]">
                                        <img src="{{ $post->media->url }}" alt="" class="w-full md:h-[150px] shadow-sm">
                                    </div>
                                    <div class="flex-1">
                                        <div class="title font-semibold line-clamp-1 md:line-clamp-none">{!! $post->title !!}</div>
                                        <div class="desc line-clamp-2 mt-1">{!! $post->desc !!}</div>
                                        <div class="cat mt-2 text-xs hidden md:block"><span class="underline underline-offset-2">Danh
                                                mục:</span> {{ $post->category->name }}</div>
                                        <div class="author text-xs text-gray-500 my-2 flex gap-2">
                                            <span class="hidden md:block">{{ $post->user->name }}</span>
                                            <span class="hidden md:block">{{ $post->created_at->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    {{ $posts->links('pagination::tailwind',['class'=>'client_post_pagination'])}}
                </div>
            </div>

        </div>
    </div>

</x-client-app-layout>
