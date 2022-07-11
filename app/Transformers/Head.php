<?php

namespace App\Transformers;

use Illuminate\Support\Collection;

class Head extends Transformer
{
    /**
     * @var mixed
     */
    private $transformedData;

    private $__this;

    public function transform(array|null $data = null): array|Collection
    {
        $this->transformedData = $this->getData()['transformedData'];

        $this->__this = $this->getData()['__this'];

        return [
            'seo' => [
                'title' => $this->__this->seo_title,

                'description' => $this->__this->seo_description,
            ],

            'urls' => $this->transformSeoUrls(),

            'image' => ['url' => $this->transformSeoImage()['src'] ?? null],

            'twitter' => $this->transformTwitter(),

            'og' => $this->transformOpenGraph(),
        ] + ($this->__this->seo_noindex ?? false ? ['robots' => 'noindex'] : []);
    }

    public function transformSeoUrls(): array
    {
        return [
            'canonical' => $this->__this->link,

            'hreflang' => $this->__this->translatedLinks,
        ];
    }

    private function transformSeoImage()
    {
        $image = $this->transformMedia();

        if (blank($image)) {
            try {
                $image =
                    $this->transformedData['image'] ??
                    ($this->transformedData['cover_image'] ??
                        ($this->transformedData['page']['image'] ?? $this->transformedData['page']['cover_image']));
            } catch (\Exception $exception) {
                $image = [];
            }
        }

        return $image;
    }

    private function transformTwitter(): array
    {
        return [
            'handle' => '@Accor',
        ];
    }

    public function transformOpenGraph()
    {
        return [
            'title' => $this->seo_title ?? ($this->title ?? null),

            'site-name' => config('app.site_name'),

            'locale' => ['current' => 'fr'],

            'type' => null,

            'description' => $this->seo_description,

            'url' => $this->link,

            'image' => [
                'url' => $image['src'] ?? null,

                'secure-url' => $image['src'] ?? null,

                'alt' => $image['caption'] ?? ($image['caption'] ?? null),

                'type' => '', //image_mime_type($image['src'] ?? null),

                'width' => $image['width'] ?? null,

                'height' => $image['height'] ?? null,
            ],
        ];
    }
}
