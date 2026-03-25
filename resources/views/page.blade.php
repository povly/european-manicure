@extends('layouts.app')

@php
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
    }
@endphp

@section('head')
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
    @if(!empty($blockScripts))
        @vite($blockScripts)
    @endif
@endsection
