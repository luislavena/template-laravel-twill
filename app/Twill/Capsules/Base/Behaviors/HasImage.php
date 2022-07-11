<?php

namespace App\Twill\Capsules\Base\Behaviors;

use Illuminate\Support\Str;
use App\Twill\Capsules\Base\Crops;

trait HasImage
{
    protected function makeImageUrl($src): ?string
    {
        if (filled($src) || !$this->debugging()) {
            return $src;
        }

        return 'https://picsum.photos/800/600/?random=' . rand(1, 5000);
    }

    public function transformImageWithSrcSet($item, string $role, string $crop): array
    {
        if (!$item->hasImage($role, $crop)) {
            if ($this->debugging()) {
                return $this->makeSrcSet($this->makeImageUrl(''));
            } else {
                return [];
            }
        }

        $image = $this->transformImage($item, $role, $crop);

        if (!is_array($image)) {
            return $image;
        }

        return $image + $this->makeSrcSet($this->makeImageUrl($image['src']));
    }

    public function makeSrcSet($src): array
    {
        return collect(Crops::EXTRA_PARAMS)
            ->map(fn($definitions) => $this->makeExtraParamsString($definitions, $src))
            ->map(function ($param, $key) use ($src) {
                $isSpecial = isset(Crops::EXTRA_PARAMS[$key][0]['__items']);

                return $isSpecial ? $param : $this->addParamsToUrl($src, $param);
            })
            ->toArray();
    }

    public function makeExtraParamsString($definitions, $src = null): string
    {
        return collect($definitions)
            ->map(fn($definition, $key) => $this->buildParamDefinition($definition, $key, $src))
            ->values()
            ->implode('&');
    }

    public function buildParamDefinition($definition, $key, $src): string
    {
        if (isset($definition['__items'])) {
            return $this->buildParamDefinitionSpecial($definition, $src);
        }

        try {
            return "$key=$definition";
        } catch (\Throwable $exception) {
            return "$key=$definition";
        }

        return "$key=$definition";
    }

    public function addParamsToUrl($src, $params): string
    {
        $glue = Str::contains($src, '?') ? '&' : '?';

        return "{$src}{$glue}{$params}";
    }

    public function buildParamDefinitionSpecial($definition, $src): string
    {
        $glue = $definition['__glue'] ?? '&';

        return collect($definition['__items'])
            ->map(fn($definitions) => $this->makeExtraParamsString($definitions))
            ->map(fn($string) => $this->addParamsToUrl($src, $string))
            ->implode($glue);
    }

    protected function debugging(): bool
    {
        return config('app.debug') && app()->environment('local');
    }

    protected function makeTwillMediaFromSrc($object, $src, $w, $h, $role, $crop)
    {
        $uuid = parse_url($src, PHP_URL_PATH);

        $media = \A17\Twill\Models\Media::make([
            'uuid' => $uuid,
            'filename' => basename($uuid),
            'width' => $w,
            'height' => $h,
        ]);

        $pivot = $media->newPivot(
            $object,
            [
                'crop_x' => 0,
                'crop_y' => 0,
                'crop_w' => $w,
                'crop_h' => $h,
                'role' => $role,
                'crop' => $crop,
            ],
            config('twill.mediables_table', 'twill_mediables'),
            true,
        );

        $media->setRelation('pivot', $pivot);

        return $media;
    }
}
