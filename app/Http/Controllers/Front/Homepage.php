<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use A17\TwillTransformers\ControllerTrait;
use Illuminate\View\View as IlluminateView;
use App\Transformers\HomePage as HomepageTransformer;
use App\Twill\Capsules\Pages\Repositories\PageRepository;
use Illuminate\Contracts\View\Factory as IlluminateViewFactory;

class Homepage extends Controller
{
    use ControllerTrait;

    protected string $transformerClass = HomepageTransformer::class;

    protected string|null $repositoryClass = PageRepository::class;

    public function index(): IlluminateViewFactory|IlluminateView|string|array|null
    {
        $this->setTemplate('front.homepage.index');

        return $this->view(['pages' => $this->repository()->get()]);
    }

    public function redirectToLocalizedHomepage(): RedirectResponse
    {
        return redirect()->to('/en');
    }
}
