<?php

namespace App\Twill\Capsules\Base;

use Illuminate\Http\Request;
use A17\TwillTransformers\ControllerTrait;
use Illuminate\Contracts\Foundation\Application;
use A17\Twill\Http\Controllers\Admin\ModuleController as TwillModuleController;

class ModuleController extends TwillModuleController
{
    use ControllerTrait;

    /**
     * @var \App\Twill\Capsules\Base\ModuleRepository
     */
    protected $repository;

    public function __construct(Application $app, Request $request)
    {
        parent::__construct($app, $request);
    }

    protected function previewData($item): array
    {
        return $this->repository->makeViewData($item);
    }
}
