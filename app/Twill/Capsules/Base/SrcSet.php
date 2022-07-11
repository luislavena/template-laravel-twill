<?php

namespace App\Twill\Capsules\Base;

class SrcSet
{
    const EXTRA_PARAMS = [
        'auto' => 'format',
        'q' => 85,
        'fit' => 'max',
    ];

    const EXTRA_PARAMS_Q20 = [
        'q' => 20,
        'fit' => 'max',
    ];

    const SRCSET = [
        [
            '__glue' => ', ',
            '__items' => [
                self::EXTRA_PARAMS + [
                    'w' => '182 182w',
                ],
                self::EXTRA_PARAMS + [
                    'w' => '200 200w',
                ],
                self::EXTRA_PARAMS + [
                    'w' => '400 400w',
                ],
                self::EXTRA_PARAMS + [
                    'w' => '800 800w',
                ],
                self::EXTRA_PARAMS + [
                    'w' => '1000 1000w',
                ],
                self::EXTRA_PARAMS + [
                    'w' => '1400 1400w',
                ],
                self::EXTRA_PARAMS + [
                    'w' => '1800 1800w',
                ],
                self::EXTRA_PARAMS + [
                    'w' => '2200 2200w',
                ],
                self::EXTRA_PARAMS + [
                    'w' => '2600 2600w',
                ],
            ],
        ],
    ];

    const SRCSET_Q20 = [
        [
            '__glue' => ', ',
            '__items' => [
                self::EXTRA_PARAMS_Q20 + [
                    'w' => '182 182w',
                ],
                self::EXTRA_PARAMS_Q20 + [
                    'w' => '200 200w',
                ],
                self::EXTRA_PARAMS_Q20 + [
                    'w' => '400 400w',
                ],
                self::EXTRA_PARAMS_Q20 + [
                    'w' => '800 800w',
                ],
                self::EXTRA_PARAMS_Q20 + [
                    'w' => '1000 1000w',
                ],
                self::EXTRA_PARAMS_Q20 + [
                    'w' => '1400 1400w',
                ],
                self::EXTRA_PARAMS_Q20 + [
                    'w' => '1800 1800w',
                ],
            ],
        ],
    ];
}
