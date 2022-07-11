<a17-fieldset title="{{__('SEO')}}" id="seo" :open="false">
    @if ($withEditorial ?? false)
        @formField('input', [
            'label' => __('Editorial title'),
            'name' => 'seo_editorial_title',
            'type' => 'text',
            'translated' => true
        ])

        @formField('input', [
            'label' => __('Editorial text'),
            'name' => 'seo_editorial_text',
            'rows' => 4,
            'type' => 'textarea',
            'translated' => true
        ])
    @endif

    @if ($withNoIndex ?? false)
        @formField('checkbox', [
            'name' => 'seo_noindex',
            'label' => 'Do not index that page'
        ])
    @endif

    @formField('input', [
        'label' => __('Meta title'),
        'name' => 'seo_title',
        'type' => 'text',
        'translated' => true
    ])

    @formField('input', [
        'label' => __('Meta description'),
        'name' => 'seo_description',
        'rows' => 4,
        'type' => 'textarea',
        'translated' => true
    ])
</a17-fieldset>
