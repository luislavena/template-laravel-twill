<?php

namespace App\Twill\Capsules\Pages\Repositories;

use App\Twill\Capsules\Base\Templates;
use App\Twill\Capsules\Base\ModuleRepository;
use App\Twill\Capsules\Pages\Models\Page;
use App\Transformers\Page as PageTransformer;
use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\Behaviors\HandleTranslations;

class PageRepository extends ModuleRepository
{
    use HandleBlocks;
    use HandleTranslations;
    use HandleSlugs;
    use HandleRevisions;

    protected string $templateName = Templates::PAGE;

    protected string $transformerClass = PageTransformer::class;

    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param array $scopes
     * @return \Illuminate\Database\Query\Builder
     */
    public function filter($query, array $scopes = [])
    {
        parent::filter($query, $scopes);

        if (filled($title = $scopes['title'] ?? null)) {
            $scope = 'title';
            $query->orWhereHas('translations', function ($q) use ($scope, $title) {
                $q->where($scope, 'ilike', "%{$title}%");
            });
        }

        return $query;
    }
}
