<?php

namespace App\Twill\Capsules\Base;

class Crops
{
    // Block editor

    const BLOCK_EDITOR = self::BLOCK_IMAGE_GRID;

    // Extra Params

    const EXTRA_PARAMS = [
        'extra' => ['lqip' => self::LQIP, 'srcset' => SrcSet::SRCSET],
    ];

    const LQIP = ['w' => 5, 'fit' => 'max', 'auto' => 'format'];

    // Modules

    const BLOCK_IMAGE_GRID = [
        'role-block-image-grid' => self::_1_1,
    ];

    const ARTICLES = [
        'role-article-cover' => self::_16_9 + self::_3_2 + self::_6_5 + self::_4_3 + self::_3_2_q20,
    ];

    // Base crops definition

    const _1_1 = [
        '1:1' => [
            [
                'name' => '1:1',
                'ratio' => 1 / 1,
            ] + self::EXTRA_PARAMS,
        ],
    ];

    const _4_3 = [
        '4:3' => [
            [
                'name' => '4:3',
                'ratio' => 4 / 3,
            ] + self::EXTRA_PARAMS,
        ],
    ];

    const _16_9 = [
        '16:9' => [
            [
                'name' => '16:9',
                'ratio' => 16 / 9,
            ] + self::EXTRA_PARAMS,
        ],
    ];

    const _3_2 = [
        '3:2' => [
            [
                'name' => '3:2',
                'ratio' => 3 / 2,
            ] + self::EXTRA_PARAMS,
        ],
    ];

    const _3_2_q20 = [
        '3:2-q20' => [
            [
                'name' => '3:2',
                'ratio' => 3 / 2,
            ] + [
                'extra' => [
                    'lqip' => self::LQIP,
                    'srcset' => SrcSet::SRCSET_Q20,
                ],
            ],
        ],
    ];

    const _6_5 = [
        '6:5' => [
            [
                'name' => '6:5',
                'ratio' => 6 / 5,
            ] + self::EXTRA_PARAMS,
        ],
    ];
}
