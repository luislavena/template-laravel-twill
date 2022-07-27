<?php

namespace App\Twill\Capsules\Base;

use A17\TwillTransformers\RepositoryTrait;
use A17\Twill\Repositories\ModuleRepository as TwillModuleRepository;

/**
 * @method mixed forSlug($slug)
 */
abstract class ModuleRepository extends TwillModuleRepository
{
    use RepositoryTrait;
}
