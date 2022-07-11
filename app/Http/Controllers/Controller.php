<?php

namespace App\Http\Controllers;

use App\Twill\Capsules\Base\ModuleRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected string|null $repositoryClass = null;

    /**
     * @throws \Exception
     */
    public function repository(): ModuleRepository
    {
        if (!isset($this->repositoryClass)) {
            throw new \Exception('Repository class not defined');
        }

        return app($this->repositoryClass);
    }
}
