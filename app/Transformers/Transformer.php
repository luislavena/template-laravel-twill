<?php

namespace App\Transformers;

use App\Support\Constants;
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

    public static array $memory = [];

    private function createContainer(array $transformed): array
    {
        app()->singleton('__transformed_data', fn() => $transformed);

        return $transformed;
    }

    /**
     * @throws \A17\TwillTransformers\Exceptions\Transformer
     */
    public function __invoke(array|null $data = null): array|Collection
    {
        return $this->transform($data);
    }

    /**
     * @throws \A17\TwillTransformers\Exceptions\Transformer
     */
    public function transform(array|null $data = null): array|Collection
    {
        if (filled($data)) {
            $this->setData($data);
        }

        // Do the page transformation before everything else
        $page = $this->transformData();

        $transformedData = [
            'locale' => [
                'current' => locale(),

                'current_internal' => localization()->getLocale(),

                'matrix' => localization()->getLocaleMatrix(),
            ],

            'layout_name' => $this->makeTemplateName(),

            'page' => $page,

            'fe' => ($translations = __('fe')),

            'global' => $this->global ?? [],

            'languages' => $this->transformLanguages(),

            'a17' => json_encode($this->transformA17(['page' => $page, 'translations' => $translations])),
        ];

        $seo = [
            'head' => $this->transformHead([
                '__this' => $this,
                'transformedData' => $transformedData,
            ]),
        ];

        return $this->createContainer($this->sanitize(to_array(collect($transformedData)->merge($seo))));
    }

    public function transformData(array|null $data = null): array|Collection
    {
        return (array) $data;
    }

    /**
     * @param array|\Illuminate\Support\Collection $array
     * @return array
     */
    protected function sanitize($array): array
    {
        return parent::sanitize(strip_tags_recursively($array, Constants::WYSIWYG_ALLOWED_TAGS));
    }
}
