<?php

namespace App\Twill\Capsules\Base\Behaviors;

trait HasRelatedContent
{
    public function getRelatedContentAttribute()
    {
        $objects = $this->getRelated('related_content');

        if (is_running_on_frontend()) {
            $objects = $objects->filter(fn($restaurant) => filled($restaurant) && $restaurant->published);
        }

        return $objects;
    }

    public function getFeaturedContentAttribute()
    {
        $objects = $this->getRelated('featured_content');

        if (is_running_on_frontend()) {
            $objects = $objects->filter(fn($restaurant) => filled($restaurant) && $restaurant->published);
        }

        return $objects;
    }

    public function getFormFieldsForRelatedItems($fields, $object, $type = 'related_content'): array
    {
        $fields['browsers'][$type] = $this->getFormFieldsForRelatedBrowser($object, $type);

        return $fields;
    }

    public function preventRelatedContentRecursion($object, $fields): array
    {
        if (blank($fields['browsers']['related_content'] ?? null)) {
            return $fields;
        }

        $fields['browsers']['related_content'] = collect($fields['browsers']['related_content'])
            ->filter(fn($related) => $related['endpointType'] !== 'articles' || $related['id'] !== $object->id)
            ->toArray();

        return $fields;
    }
}
