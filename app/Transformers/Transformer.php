<?php

namespace App\Transformers;

use App\Twill\Capsules\Base\Crops;
use Illuminate\Support\Collection;
use App\Twill\Capsules\Base\Behaviors\HasImage;
use A17\TwillTransformers\Transformer as TwillTransformer;

/**
 * @method transformLanguages()
 * @method transformHead($data)
 * @method transformA17($data)
 */
abstract class Transformer extends TwillTransformer
{
    use HasImage;

    /**
     * @var array
     */
    protected $globalMediaParams = Crops::BLOCK_EDITOR;

    /**
     * @param array|Collection|null $data
     * @return array
     * @throws \A17\TwillTransformers\Exceptions\Transformer
     */
    public function transform(array|Collection|null $data = null): array
    {
        if (filled($data)) {
            $this->setData($data);
        }

        // Do the page transformation before everything else
        $transformedData = $this->transformData();

        $transformedData = [
            'data' => $transformedData,

            'locale' => $this->transformLocale(),

            'layout_name' => $this->makeTemplateName(),

            'fe' => ($translations = __('fe')),

            'global' => $this->global ?? [],

            'languages' => $this->transformLanguages(),

            'a17' => json_encode($this->transformA17(['page' => $transformedData, 'translations' => $translations])),
        ];

        $seo = [
            'head' => $this->transformHead([
                '__this' => $this,
                'transformedData' => $transformedData,
            ]),
        ];

        return $this->sanitize(collect($transformedData)->merge($seo));
    }

    /**
     * @return array
     */
    private function transformLocale(): array
    {
        return [
            'current' => locale(),

            'current_internal' => localization()->getLocale(),

            'matrix' => localization()->getLocaleMatrix(),
        ];
    }
}
