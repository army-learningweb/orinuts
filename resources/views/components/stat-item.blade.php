@props([
    'stat_name',
    'number',
    'link_name' => '',
    'href' => '#'
])

<div {{$attributes->merge(['class' => 'stat-item bg-white w-full mt-2 md:mt-0 rounded-md shadow-md p-5 box-border'])}}>
    <div class="flex justify-between items-end">
        <div>
            <p class="select-none">{{$stat_name}}</p>
            <p class="text-3xl font-semibold select-none mt-2">{{$number}}</p>
        </div>
        <div>
            {{$slot}}
        </div>
    </div>
    <a href="{{$href}}" class="text-blue-600 text-sm hover:underline underline-offset-2 mt-2 inline-block">{{$link_name}}</a>
</div>
