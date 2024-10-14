<?php

return [
    // Navigation links
    'side_bar_links' => [
        [
            'menu_text' => 'HOME',
            'route_name' => 'admin.home',
            'menu_icon' => '<i class="fa-solid fa-house"></i>',
        ],
        [
            'menu_text' => 'POSTS',
            'route_name' => 'admin.posts.index',
            'menu_icon' => '<i class="fa-solid fa-window-restore"></i>',
        ],
        [
            'menu_text' => 'TYPES',
            'route_name' => 'admin.post-types.index',
            'menu_icon' => '<i class="fa-solid fa-flag"></i>',
        ],
        [
            'menu_text' => 'TAGS',
            'route_name' => 'admin.tags.index',
            'menu_icon' => '<i class="fa-solid fa-tags"></i>',
        ],
    ],
];
