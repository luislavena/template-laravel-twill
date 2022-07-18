<?php

namespace App\Transformers\Molecule;

use App\Transformers\Transformer;
use Illuminate\Support\Collection;

/**
 * @property string $title
 * @property string $slug
 * @property string $link
 * @property string $description
 */
class Page extends Transformer
{
    public function transform(array|Collection|null $data = null): array|Collection
    {
        return [
            'title' => $this->title,

            'description' => $this->description,

            'link' => [
                'label' => $this->title,
                'url' => $this->link,
            ],
        ];
    }
}
