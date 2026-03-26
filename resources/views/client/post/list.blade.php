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
        <div class="w-full md:w-[84%] animation_content_slide_up">
            @if ($posts->count() > 0)
                <div class="bg-white p-3 rounded-md shadow-sm">
                    <div class="">
                        @foreach ($posts as $parent_cat => $posts)
                            <p class="font-semibold text-lg select-none flex items-center gap-4 px-2 mt-2">
                                <span>{{ $parent_cat }}</span>
                                @if ($posts->count() > 5)
                                    <span>
                                        <a href=""
                                            class="text-blue-600 text-sm font-normal underline underline-offset-2">Xem
                                            tất
                                            cả</a>
                                    </span>
                                @endif
                            </p>
                            <ul class="flex flex-wrap">
                                @php
                                    $count = 0;
                                @endphp
                                @foreach ($posts as $post)
                                    @php
                                        $count += 1;
                                    @endphp
                                    <li class="w-full md:w-[50%] mt-1">
                                        <a href="{{ url($post->slug).'.html' }}" class="inline-block w-full p-2">
                                            <div class="flex mt-2 gap-3">
                                                <div class="w-[40%]">
                                                    <img src="{{ asset($post->media->url) }}" alt=""
                                                        class="w-full md:h-[150px] shadow-sm">
                                                </div>
                                                <div class="flex-1">
                                                    <div class="title font-semibold line-clamp-2 md:list-none">{!! $post->title !!}</div>
                                                    <div class="desc mt-1 line-clamp-1 md:line-clamp-none">{!! $post->desc !!}</div>
                                                    <div class="author text-xs text-gray-500 my-2 flex gap-2">
                                                        <span>{{ $post->user->name }}</span>
                                                        <span>{{ $post->created_at->format('d/m/Y') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    @if ($count == 4)
                                        @break
                                    @endif
                                @endforeach
                            </ul>
                            <hr class="my-5">
                        @endforeach
                    </div>
                </div>
            @else
               @include('client.layouts.404')
            @endif
        </div>
    </div>
</x-client-app-layout>
