@extends('front.templates.app')

@section('body')
    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
        <img src="https://twill.io/dist/images/social_share.png" width="200">
    </div>

    <div class="mt-8">
        @if(filled($data['pages']))
            @foreach($data['pages'] as $page)
                <a class="mt-2" href="{{ $page['link']['url'] }}">{{ $page['link']['label'] }}</a> <br>
            @endforeach
        @endif
    </div>
@endsection
