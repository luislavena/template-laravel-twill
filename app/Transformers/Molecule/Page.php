<?php

namespace App\Transformers\Molecule;

use App\Transformers\Transformer;

/**
 * @property string $title
 * @property string $slug
 * @property string $link
 * @property string $description
 */
class Page extends Transformer
{
    public function transform(): array
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
