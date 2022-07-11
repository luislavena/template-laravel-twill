<?php

namespace App\Transformers;

use Illuminate\Support\Collection;

/**
 * @property array|Collection $pages
 * @method array|Collection transformPage($page)
 * @method array transformMoleculePage()
 */
class HomePage extends Transformer
{
    public function transformData(array|null $data = null): array|Collection
    {
        return ['pages' => $this->pages->map(fn($page) => $this->transformMoleculePage($page))];
    }
}
