<?php

$blockDependencies = [];

$dependencyCss = [];
$dependencyJs = [];
$blockStyles = [];
$blockScripts = [];

foreach ($page->content as $block) {
    $blockName = $block->getName();
    
    $cssPath = resource_path("css/blocks/{$blockName}.css");
    $jsPath = resource_path("js/blocks/{$blockName}.js");
    
    if (file_exists($cssPath)) {
        $blockStyles[] = "resources/css/blocks/{$blockName}.css";
    }
    if (file_exists($jsPath)) {
        $blockScripts[] = "resources/js/blocks/{$blockName}.js";
    }

    if (isset($blockDependencies[$blockName])) {
        if (isset($blockDependencies[$blockName]['css'])) {
            foreach ($blockDependencies[$blockName]['css'] as $url) {
                $dependencyCss[$url] = true;
            }
        }
        if (isset($blockDependencies[$blockName]['js'])) {
            foreach ($blockDependencies[$blockName]['js'] as $url) {
                $dependencyJs[$url] = true;
            }
        }
    }
}

$dependencyCss = array_keys($dependencyCss);
$dependencyJs = array_keys($dependencyJs);
?>

@extends('layouts.app')

@section('head')
    @foreach($dependencyCss as $url)
        <link rel="stylesheet" href="{{ $url }}">
    @endforeach
    @if(!empty($blockStyles))
        @vite($blockStyles)
    @endif
@endsection

@section('header')
    @include('includes.header')
@endsection

@section('content')
    @foreach($page->content as $block)
        <livewire:dynamic-component :is="'blocks.' . $block->getName()" :data="$block->getValues() ?? []" :wire:key="$block->key ?? $loop->index" />
    @endforeach
@endsection

@section('footer')
    @include('includes.footer')
@endsection

@section('scripts')
    @foreach($dependencyJs as $url)
        <script src="{{ $url }}"></script>
    @endforeach
    @foreach($blockScripts as $script)
        <script src="{{ Vite::asset($script) }}" type="module"></script>
    @endforeach
@endsection
