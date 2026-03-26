<?php

function pagging_page($page, $num_page, $class = '')
{
    $str_pagging = '<div class="'.$class.' mt-4 flex justify-end items-center">';
    // Nút prev
    if ($page >= 1) {
        $prev = $page - 1;
        if ($page <= 1) {
            $prev = 1;
            $str_pagging .= '<a href="?page=' . $prev . '" rel="prev" class="prev inline-flex items-center px-2 py-2 text-sm font-medium text-gray-300 hover:text-gray-700"';
        } else {
            $str_pagging .= '<a href="?page=' . $prev . '" rel="prev" class="prev inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 hover:text-gray-700"';
        }
        $str_pagging .= '<a href="?page=' . $prev . '" rel="prev" class="prev inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 hover:text-gray-700";
            aria-label="' . __('pagination.previous') . '">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                    clip-rule="evenodd" />
            </svg>
        </a>';
    }


    // Số
    $str_pagging .= '<span>';
    $str_pagging .= '<a href="?page=' . $page . '"class="inline-flex items-center px-2 py-2 -ml-px font-medium cursor-default">' . $page . '</a>';
    $str_pagging .= '</span>';

    if ($page == $num_page) {
        $str_pagging .='';
    } else {
        $str_pagging .= '<span>';
        $str_pagging .= '<a href="?page=' . $page + 1 . '"class="inline-flex items-center px-2 py-2 -ml-px text-xs font-medium cursor-default leading-7 text-gray-300">' . $page + 1 . '</a>';
        $str_pagging .= '</span>';
    }



    // Nút Next
    if ($page <= $num_page) {
        $next = $page + 1;
        if ($page >= $num_page) {
            $next = $num_page;
        }
        if($page == $num_page){
            $str_pagging .= '<a href="?page=' . $next . '" rel="next" class="next inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-300 rounded-r-md hover:text-gray-700"
            aria-label="' . __('pagination.next') . '">';
        }else{
            $str_pagging .= '<a href="?page=' . $next . '" rel="next" class="next inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 rounded-r-md hover:text-gray-700"
            aria-label="' . __('pagination.next') . '">';
        }
        $str_pagging .='
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd" />
            </svg>
        </a>';
    }

    $str_pagging .= '</div>';

    return $str_pagging;
}
