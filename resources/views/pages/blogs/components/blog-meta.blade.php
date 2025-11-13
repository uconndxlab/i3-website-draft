@php
    $defaultDescription = $defaultDescription ?? 'Read the latest blogs from i3, UConn\'s hub of innovation and creativity.';
    $description = $post->subheader ?: $defaultDescription;
    $imageRaw = $post->best_featured_image_url ?? '';
    $image = $imageRaw ? (filter_var($imageRaw, FILTER_VALIDATE_URL) ? $imageRaw : url($imageRaw)) : null;
    
    // Determine image type
    $imageType = 'image/jpeg';
    if ($image) {
        $extension = strtolower(pathinfo(parse_url($image, PHP_URL_PATH), PATHINFO_EXTENSION));
        $imageTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'webp' => 'image/webp',
            'gif' => 'image/gif',
        ];
        $imageType = $imageTypes[$extension] ?? 'image/jpeg';
    }
    
    $blogUrl = url(route('blog.show', $post->url_friendly, false));
@endphp

<!-- Open Graph / Facebook -->
<meta property="og:type" content="article">
<meta property="og:url" content="{{ $blogUrl }}">
<meta property="og:title" content="{{ $post->title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:site_name" content="i3 - Internal Insights & Innovation">
<meta property="og:locale" content="en_US">
@if($image)
<meta property="og:image" content="{{ $image }}">
<meta property="og:image:secure_url" content="{{ $image }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{{ $post->title }}">
<meta property="og:image:type" content="{{ $imageType }}">
@endif
@if($post->published_at)
<meta property="article:published_time" content="{{ $post->published_at->toIso8601String() }}">
@endif
@if($post->author)
<meta property="article:author" content="{{ $post->author }}">
@endif
@if(is_array($post->tags) && count($post->tags))
    @foreach($post->tags as $tag)
<meta property="article:tag" content="{{ $tag }}">
    @endforeach
@endif

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ $blogUrl }}">
<meta name="twitter:title" content="{{ $post->title }}">
<meta name="twitter:description" content="{{ $description }}">
@if($image)
<meta name="twitter:image" content="{{ $image }}">
<meta name="twitter:image:alt" content="{{ $post->title }}">
@endif

<!-- Additional Meta -->
<link rel="canonical" href="{{ $blogUrl }}">

