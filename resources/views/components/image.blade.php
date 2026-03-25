@php
    $src = $attributes->get('src');
    $alt = $attributes->get('alt', '');
    $width = $attributes->get('width');
    $height = $attributes->get('height');
    $lazy = $attributes->get('lazy', true);
    $class = $attributes->get('class', '');
    $pictureClass = $attributes->get('pictureClass', '');
    $from = $attributes->get('from', 'storage');

    $getImageUrl = function($path) use ($from) {
        if (empty($path)) {
            return null;
        }
        if (str_starts_with($path, 'http')) {
            return $path;
        }
        if ($from === 'public') {
            return asset($path);
        }
        return \Illuminate\Support\Facades\Storage::disk('public')->url($path);
    };

    $getConvertedPath = function($path, $format) {
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        return str_replace(".{$extension}", ".{$format}", $path);
    };

    $fileExists = function($path) use ($from) {
        if ($from === 'public') {
            return file_exists(public_path($path));
        }
        return \Illuminate\Support\Facades\Storage::disk('public')->exists($path);
    };

    $getWebpUrl = function($path) use ($from, $getConvertedPath, $fileExists) {
        if (empty($path) || str_starts_with($path, 'http')) {
            return null;
        }
        $webpPath = $getConvertedPath($path, 'webp');
        return $fileExists($webpPath) 
            ? ($from === 'public' ? asset($webpPath) : \Illuminate\Support\Facades\Storage::disk('public')->url($webpPath))
            : null;
    };

    $getAvifUrl = function($path) use ($from, $getConvertedPath, $fileExists) {
        if (empty($path) || str_starts_with($path, 'http')) {
            return null;
        }
        $avifPath = $getConvertedPath($path, 'avif');
        return $fileExists($avifPath)
            ? ($from === 'public' ? asset($avifPath) : \Illuminate\Support\Facades\Storage::disk('public')->url($avifPath))
            : null;
    };

    $hasAnyModernFormat = function($path) use ($getConvertedPath, $fileExists) {
        if (empty($path) || str_starts_with($path, 'http')) {
            return false;
        }
        return $fileExists($getConvertedPath($path, 'webp'))
            || $fileExists($getConvertedPath($path, 'avif'));
    };

    $avifUrl = $getAvifUrl($src);
    $webpUrl = $getWebpUrl($src);
    $fallbackUrl = $getImageUrl($src);
    $lazyClass = $lazy ? 'lazy' : '';
    $imgClass = trim($class . ' ' . $lazyClass);
@endphp

<picture class="{{ $pictureClass }}">
    @if($src && $hasAnyModernFormat($src))
        @if($avifUrl)
            <source @if($lazy) data-srcset="{{ $avifUrl }}" @else srcset="{{ $avifUrl }}" @endif type="image/avif">
        @endif
        @if($webpUrl)
            <source @if($lazy) data-srcset="{{ $webpUrl }}" @else srcset="{{ $webpUrl }}" @endif type="image/webp">
        @endif
    @endif

    @if($fallbackUrl)
        <img
            @if($lazy) 
                src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                data-src="{{ $fallbackUrl }}"
            @else
                src="{{ $fallbackUrl }}"
            @endif
            alt="{{ $alt }}"
            @if($width) width="{{ $width }}" @endif
            @if($height) height="{{ $height }}" @endif
            @if($imgClass) class="{{ $imgClass }}" @endif
        >
    @endif
</picture>
