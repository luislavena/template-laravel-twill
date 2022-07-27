<?php

namespace App\Transformers;

/**
 * @property array $translations
 * @property array $page
 */
class A17 extends Transformer
{
    public function transform(): array
    {
        $a17 = $this->page['a17'] ?? [];

        return to_array($a17) + [
            'l11n' => $this->translations,

            'page' => $this->page,

            'auth' => [],

            'config' => [],
        ];
    }
}
