<?php

namespace App\Transformers;

use Illuminate\Support\Collection;

class Languages extends Transformer
{
    public function transform(array|Collection|null $data = null): array|Collection
    {
        return locales()
            ->map(fn($locale) => $this->transformLocale($locale))
            ->filter();
    }

    private function transformLocale(string $locale): array
    {
        return !empty(($url = $this->getUrl($this->getTransformerData(), $locale)))
            ? [
                'label' => $locale,
                'locale' => $locale,
                'url' => $url,
                'is_active' => locale() === $locale,
            ]
            : [];
    }

    private function getTransformerData(): mixed
    {
        $data = $this->getData() ?? ($this->__data ?? null);

        return filled($data['data'] ?? null) ? $data['data'] : $data;
    }

    private function getUrl(mixed $object, string $locale): ?string
    {
        $url = null;

        if ($object && isset($object->translatedLinks)) {
            foreach ($object->translatedLinks as $language => $link) {
                if (substr($language, 0, 2) == $locale) {
                    $url = $link;

                    break;
                }
            }
        }

        return !empty($url) ? $url : null;
    }
}
