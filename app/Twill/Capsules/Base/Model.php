<?php

namespace App\Twill\Capsules\Base;

use Illuminate\Support\Str;
use A17\Twill\Models\Model as TwillModel;
use Illuminate\Database\Eloquent\Builder;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasTranslation;
use App\Twill\Capsules\Base\Scopes\MustBePublished;
use App\Twill\Capsules\Base\Scopes\MustHaveTranslation;

/**
 * @method Builder where($column, $operator = null, $value = null, $boolean = 'and');
 * @property string $moduleName;
 * @property string $slug;
 * @method string getSlug($locale)
 */
abstract class Model extends TwillModel
{
    use HasTranslation;
    use HasRevisions;

    public array $translatedAttributes = [];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new MustBePublished());
        static::addGlobalScope(new MustHaveTranslation());

        locale();
    }

    public function makeTranslatedLinks($route, $builder, $useOriginalLocale = false): array
    {
        return collect(locales())
            ->mapWithKeys(function ($locale) use ($builder, $route, $useOriginalLocale) {
                $parameters = $builder($locale);

                if (
                    collect($parameters)->count() !==
                    collect($parameters)
                        ->filter()
                        ->count()
                ) {
                    return [];
                }

                $parameters['locale'] = $locale;

                if ($locale == 'en' && !$useOriginalLocale) {
                    $locale = 'en-gb';
                }
                if ($locale == 'fr' && !$useOriginalLocale) {
                    $locale = 'fr-fr';
                }

                return [
                    $locale => _rf($route, $parameters),
                ];
            })
            ->filter()
            ->toArray();
    }

    public function getLinkAttribute(): ?string
    {
        if (blank($this->slug)) {
            return null;
        }

        return _rf($this->getModuleName() . '.show', [
            'locale' => locale(),
            'slug' => $this->slug,
        ]);
    }

    /**
     * Defaults to getting the capsule name
     */
    public function getModuleName(): string
    {
        return Str::camel(explode('\\', get_class($this))[3] ?? '');
    }

    public function getTranslatedLinksAttribute(): array
    {
        return $this->makeTranslatedLinks(
            'pages.show',
            fn($locale) => [
                'slug' => $this->getSlug($locale),
            ],
        );
    }
}
