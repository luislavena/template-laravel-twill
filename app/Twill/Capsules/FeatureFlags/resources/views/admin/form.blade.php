@extends('twill::layouts.form')

@section('contentFields')
    @formField('input', [
        'label' => 'Code',
        'name' => 'code',
        'type' => 'text'
    ])

    @formField('checkbox', [
        'name' => 'publicly_available',
        'label' => 'Publicly available',
    ])

    @formField('input', [
        'translated' => true,
        'name' => 'ip_addresses',
        'rows' => 2,
        'label' => 'Publicly available to those IP addresses',
        'required' => false,
        'note' => 'Use comma as a delimiter',
        'placeholder' => 'Placeholder goes here',
        'type' => 'textarea',
        'translated' => false,
    ])

    @formField('input', [
        'label' => 'Description',
        'name' => 'description',
        'rows' => 4,
        'type' => 'textarea'
    ])
@stop
