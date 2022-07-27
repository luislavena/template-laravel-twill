@extends('twill::layouts.form', [ 'disableContentFieldset' => true ])

@section('formClass', 'notranslate')

@section('fieldsets')
    <a17-fieldset title="{{__('Texts')}}" id="block_editor" :open="true">
        @formField('block_editor', [
            'blocks' => [
                'text',
            ]
        ])
    </a17-fieldset>

    @include('admin._components.seo')
@stop
