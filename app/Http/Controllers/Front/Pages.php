<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use A17\TwillTransformers\ControllerTrait;
use Illuminate\View\View as IlluminateView;
use App\Twill\Capsules\Pages\Repositories\PageRepository;
use Illuminate\Contracts\View\Factory as IlluminateViewFactory;

class Pages extends Controller
{
    use ControllerTrait;

    protected string|null $repositoryClass = PageRepository::class;

    public function index(): IlluminateViewFactory|IlluminateView|string|array|null
    {
        return $this->view(['pages' => $this->repository()->get()]);
    }

    public function show(mixed $_, string $slug): IlluminateViewFactory|IlluminateView|string|array|null
    {
        return $this->view($this->repository()->forSlug($slug));
    }
}
