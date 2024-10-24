<?php

return [
    // Navigation links
    'side_bar_links' => [
        [
            'menu_text' => 'HOME',
            'route_name' => 'admin.villains.index',
            'menu_icon' => '<i class="fa-solid fa-house"></i>',
        ],
        // [
        //     'menu_text' => 'SKILLS',
        //     'route_name' => 'admin.skills.index',
        //     'menu_icon' => '<i class="fa-solid fa-book-skull"></i>',
        // ],
        [
            'menu_text' => 'MESSAGES',
            'route_name' => 'admin.messages.index',
            'menu_icon' => '<i class="fa-solid fa-envelope"></i>',
        ],
        [
            'menu_text' => 'SPONSORSHIPS',
            'route_name' => 'admin.sponsorship.index',
            'menu_icon' => '<i class="fa-solid fa-hand-holding-dollar"></i>',
        ],
        [
            'menu_text' => 'RATINGS',
            'route_name' => 'admin.ratings.index',
            'menu_icon' => '<i class="fa-solid fa-star"></i>',
        ],
    ],
];
