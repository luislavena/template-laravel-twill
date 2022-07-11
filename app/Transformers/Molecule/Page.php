<?php

namespace App\Transformers\Molecule;

use App\Transformers\Transformer;
use Illuminate\Support\Collection;

/**
 * @property string $title
 * @property string $slug
 * @property string $link
 */
class Page extends Transformer
{
    public function transform(array|null $data = null): array|Collection
    {
        return [
            'link' => ['label' => $this->title, 'url' => $this->link],
        ];
    }
}
