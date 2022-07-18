<?php

namespace App\Transformers;

/**
 * @property string $title
 * @property string $slug
 * @method array transformMoleculePage()
 */
class Page extends Transformer
{
    public function transformData(array|null $data = null): array
    {
        return ['page' => $this->transformMoleculePage()];
    }
}
