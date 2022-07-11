<?php

namespace App\Transformers;

use Illuminate\Support\Collection;

/**
 * @property string $title
 * @property string $slug
 * @method array transformMoleculePage()
 */
class Page extends Transformer
{
    public function transformData(array|null $data = null): array|Collection
    {
        return ['page' => $this->transformMoleculePage()];
    }
}
