<a17-fieldset title="{{__('SEO')}}" id="seo" :open="false">
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
