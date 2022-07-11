<?php

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Database\Schema\Blueprint;

if (!function_exists('is_running_on_frontend')) {
    function is_running_on_frontend(): bool
    {
        if (app()->runningInConsole()) {
            return false;
        }

        $name =
            request()
                ->route()
                ?->getName() ?? '';

        return blank($name) || Str::startsWith($name, ['front.', 'api.']);
    }
}

if (!function_exists('repository')) {
    function repository(string $moduleName): object
    {
        $repository = 'App\\Repositories\\' . ucfirst(Str::singular($moduleName)) . 'Repository';

        if (class_exists($repository)) {
            return app($repository);
        }

        $repository =
            'App\\Twill\\Capsules\\' .
            ucfirst(Str::plural($moduleName)) .
            '\Repositories\\' .
            ucfirst(Str::singular($moduleName)) .
            'Repository';

        return app($repository);
    }
}

if (!function_exists('create_seo_fields')) {
    function create_seo_fields(Blueprint $table): void
    {
        $table->string('seo_title')->nullable();

        $table->string('seo_description')->nullable();
    }
}

if (!function_exists('strip_tags_recursively')) {
    function strip_tags_recursively(Collection|array $subject, string $tags = ''): array
    {
        $subject = (new Collection($subject))->map(function ($value, $key) use ($tags) {
            if (is_traversable($value)) {
                return strip_tags_recursively($value, $tags);
            }

            if (!is_string($value)) {
                return $value;
            }

            return strip_tags($value, $tags);
        });

        return $subject->toArray();
    }
}
