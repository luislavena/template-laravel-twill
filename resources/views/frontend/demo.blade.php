@extends('frontend.layouts.main', [
    'body_classes' => 'min-h-screen flex flex-col',
    'main_classes' => 'flex-grow',
])

@section('body')
    <div class="container f-body relative pt-40" data-behavior="dummy">
        <div class="max-w-600">
            <h1><strong>Welcome</strong></h1>
            <p class="mt-20">You are ready to build your new beautiful products! Here are some documentations links
                related to technologies shipped inside this template:
            </p>
            <ul class="mt-12">
                <li class="mt-4 underline hover:no-underline"><a href="https://laravel.com/docs/9.x"
                        target="_blank">Laravel</a></li>
                <li class="mt-4 underline hover:no-underline"><a href="https://twill.io/" target="_blank">Twill</a></li>
                <li class="mt-4 underline hover:no-underline"><a href="https://tailwindcss.com/" target="_blank">Tailwind
                        CSS</a></li>
                <li class="mt-4 underline hover:no-underline"><a href="http://tailwind-plugins.dev.area17.com/"
                        target="_blank">A17 Tailwind
                        plugins</a></li>
                <li class="mt-4 underline hover:no-underline"><a href="https://github.com/area17/js-helpers/wiki"
                        target="_blank">A17 JS
                        helpers</a>
                </li>
                <li class="mt-4 underline hover:no-underline"><a href="https://github.com/area17/a17-behaviors/wiki"
                        target="_blank">A17
                        Behaviors</a>
                </li>
            </ul>
        </div>
    </div>
@endsection
