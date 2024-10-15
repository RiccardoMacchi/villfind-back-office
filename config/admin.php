<?php

return [
    // Navigation links
    'side_bar_links' => [
        // [
        //     'menu_text' => 'HOME',
        //     'route_name' => 'admin.home',
        //     'menu_icon' => '<i class="fa-solid fa-house"></i>',
        // ],
        [
            'menu_text' => 'HOME',
            'route_name' => 'admin.villains.index',
            'menu_icon' => '<i class="fa-solid fa-house"></i>',
        ],
        [
            'menu_text' => 'SKILLS',
            'route_name' => 'admin.skills.index',
            'menu_icon' => '<i class="fa-solid fa-book-skull"></i>',
        ],
        [
            'menu_text' => 'MESSAGES',
            'route_name' => 'admin.messages.index',
            'menu_icon' => '<i class="fa-solid fa-envelope"></i>',
        ],
    ],
];
