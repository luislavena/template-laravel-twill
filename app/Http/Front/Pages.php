<?php

namespace App\Http\Front;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use A17\TwillTransformers\ControllerTrait;
use App\Twill\Capsules\Pages\Repositories\PageRepository;

class Pages extends Controller
{
    use ControllerTrait;

    protected string|null $repositoryClass = PageRepository::class;

    public function index(): View
    {
        return $this->view(['pages' => $this->repository()->get()]);
    }

    public function setTemplate($name)
    {
        $this->templateName = $name;
    }
}
