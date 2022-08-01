@props([
    'title' => '',
    'description' => '',
    'cover' => null,
    'copyright' => null,
    'url' => null,
    'canonical_url' => null,
    'site_name' => null,
    'twitter_domain' => null,
    'twitter_creator' => null,
    'twitter_site' => null,
])

@if ($title)
    <meta property="og:title" content="{{ $title }}" />
    <meta itemprop="name" content="{{ $title }}">
@endif

@if ($description)
    <meta name="description" content="{{ $description }}">
    <meta property="og:description" content="{{ $description }}" />
    <meta itemprop="description" content="{{ $description }}">
@endif

<meta property="og:type" content="website" />
@if (!$cover)
    <meta name="twitter:card" content="summary" />
@endif

@if ($canonical_url ?? $url)
    <link rel="canonical" href="{{ $canonical_url ?? $url }}" />
    <meta property="og:url" content="{{ $canonical_url ?? $url }}" />
@endif

@if ($cover)
    <meta property="og:image" content="{{ $cover }}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="600" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta itemprop="image" content="{{ $cover }}">
@endif

@if ($copyright)
    <meta name="copyright" content="{{ $copyright }}" />
@endif

@if ($site_name)
    <meta property="og:site_name" content="{{ $site_name }}" />
@endif

@if ($twitter_site)
    <meta name="twitter:site" content="{{ $twitter_site }}" />
@endif

@if ($twitter_creator)
    <meta name="twitter:creator" content="{{ $twitter_creator }}" />
@endif

@if ($twitter_domain)
    <meta name="twitter:domain" content="{{ $twitter_domain }}" />
@endif
