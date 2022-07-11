<?php

namespace App\Http\Front;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use A17\TwillTransformers\ControllerTrait;
use App\Transformers\HomePage as HomepageTransformer;
use App\Twill\Capsules\Pages\Repositories\PageRepository;

class Homepage extends Controller
{
    use ControllerTrait;

    protected string $transformerClass = HomepageTransformer::class;

    protected string|null $repositoryClass = PageRepository::class;

    public function index(): View
    {
        $this->setTemplate('front.homepage.index');

        return $this->view(['pages' => $this->repository()->get()]);
    }

    public function setTemplate($name)
    {
        $this->templateName = $name;
    }

    public function redirectToLocalizedHomepage(): RedirectResponse
    {
        return redirect()->to('/en');
    }
}
